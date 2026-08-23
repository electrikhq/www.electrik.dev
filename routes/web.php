<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::redirect('docs/slate/{any?}', 'https://slate.electrik.dev')->where('any', '.*');
Route::redirect('demo/slate/{any?}', 'https://slate.electrik.dev')->where('any', '.*');
Route::redirect('docs', '/install');
Route::redirect('about', '/');
Route::redirect('faqs', '/faq');

Route::get('/', fn () => view('pages.home'))->name('home');
Route::get('/install', fn () => view('pages.install'))->name('install');
Route::get('/license', fn () => view('pages.license'))->name('license');
Route::get('/pricing', fn () => view('pages.pricing'))->name('pricing');
Route::get('/faq', fn () => view('pages.faq'))->name('faq');
