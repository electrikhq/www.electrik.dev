<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsletterController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email:rfc', 'max:255'],
        ]);

        // Honeypot — bots fill this; humans leave empty.
        if (filled($request->input('company_website'))) {
            return response()->json([
                'ok' => true,
                'message' => 'You are on the list. Watch for Electrik updates.',
            ]);
        }

        $base = rtrim((string) config('services.listmonk.url'), '/');
        $user = config('services.listmonk.username');
        $token = config('services.listmonk.token');
        $listId = (int) config('services.listmonk.list_id');

        if ($base === '' || ! filled($user) || ! filled($token) || $listId < 1) {
            return response()->json([
                'ok' => false,
                'message' => 'Newsletter is not configured.',
            ], 503);
        }

        $email = strtolower(trim($validated['email']));
        $name = strstr($email, '@', true) ?: 'Subscriber';

        $http = Http::withBasicAuth($user, $token)->acceptJson();

        $create = $http->post("{$base}/api/subscribers", [
            'email' => $email,
            'name' => $name,
            'status' => 'enabled',
            'lists' => [$listId],
            'preconfirm_subscriptions' => true,
            'attribs' => ['source' => 'electrik.dev'],
        ]);

        if ($create->successful()) {
            return response()->json([
                'ok' => true,
                'message' => 'You are on the list. Watch for Electrik updates.',
            ]);
        }

        $alreadyExists = $create->status() === 409
            || preg_match('/already exists|duplicate|unique/i', $create->body());

        if (! $alreadyExists) {
            report('Listmonk create subscriber failed: '.$create->body());

            return response()->json([
                'ok' => false,
                'message' => 'Could not subscribe right now. Try again in a moment.',
            ], 502);
        }

        $query = "subscribers.email = '".str_replace("'", "''", $email)."'";
        $find = $http->get("{$base}/api/subscribers", [
            'query' => $query,
            'page' => 1,
            'per_page' => 1,
        ]);

        $sub = $find->json('data.results.0');
        if (! is_array($sub)) {
            return response()->json([
                'ok' => true,
                'message' => 'You are on the list. Watch for Electrik updates.',
            ]);
        }

        $existingIds = collect($sub['lists'] ?? [])->pluck('id')->map(fn ($id) => (int) $id)->all();
        if (in_array($listId, $existingIds, true)) {
            return response()->json([
                'ok' => true,
                'message' => 'You are on the list. Watch for Electrik updates.',
            ]);
        }

        $attach = $http->put("{$base}/api/subscribers/{$sub['id']}", [
            'email' => $sub['email'] ?? $email,
            'name' => $sub['name'] ?? $name,
            'status' => $sub['status'] ?? 'enabled',
            'lists' => [...$existingIds, $listId],
            'preconfirm_subscriptions' => true,
        ]);

        if ($attach->failed()) {
            $bulk = $http->put("{$base}/api/subscribers/lists", [
                'ids' => [(int) $sub['id']],
                'action' => 'add',
                'target_list_ids' => [$listId],
                'status' => 'confirmed',
            ]);

            if ($bulk->failed()) {
                report('Listmonk attach list failed: '.$bulk->body());

                return response()->json([
                    'ok' => false,
                    'message' => 'Could not subscribe right now. Try again in a moment.',
                ], 502);
            }
        }

        return response()->json([
            'ok' => true,
            'message' => 'You are on the list. Watch for Electrik updates.',
        ]);
    }
}
