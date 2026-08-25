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
                'message' => 'Check your inbox to confirm your subscription.',
            ]);
        }

        $apiKey = config('services.kit.key');
        $formId = config('services.kit.form_id');

        if (! filled($apiKey) || ! filled($formId)) {
            return response()->json([
                'ok' => false,
                'message' => 'Newsletter is not configured.',
            ], 503);
        }

        $email = strtolower(trim($validated['email']));
        $referrer = $request->headers->get('referer') ?: config('app.url');

        $create = Http::withHeaders([
            'X-Kit-Api-Key' => $apiKey,
            'Accept' => 'application/json',
        ])->post('https://api.kit.com/v4/subscribers', [
            'email_address' => $email,
        ]);

        // Created, or already exists — still add to form.
        if ($create->failed() && ! in_array($create->status(), [409, 422], true)) {
            report('Kit create subscriber failed: '.$create->body());

            return response()->json([
                'ok' => false,
                'message' => 'Could not subscribe right now. Try again in a moment.',
            ], 502);
        }

        $add = Http::withHeaders([
            'X-Kit-Api-Key' => $apiKey,
            'Accept' => 'application/json',
        ])->post("https://api.kit.com/v4/forms/{$formId}/subscribers", [
            'email_address' => $email,
            'referrer' => $referrer,
        ]);

        if ($add->failed() && $add->status() !== 200) {
            report('Kit add to form failed: '.$add->body());

            return response()->json([
                'ok' => false,
                'message' => 'Could not subscribe right now. Try again in a moment.',
            ], 502);
        }

        return response()->json([
            'ok' => true,
            'message' => 'You are on the list. Watch for Electrik updates.',
        ]);
    }
}
