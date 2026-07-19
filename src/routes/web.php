<?php

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/

Livewire::setUpdateRoute(function ($handle) {
    // Serialize concurrent Livewire requests for the same session. Without this,
    // lazy dashboard widgets can write an older session payload after login and
    // erase the authentication key (last-write-wins on the database driver).
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle)
        ->block(lockSeconds: 10, waitSeconds: 10);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});

// Authenticate through a normal full-page POST. Running authentication inside
// Livewire allowed concurrent component requests to overwrite the new session.
Route::post('/admin/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ]);

    if (! Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
        return back()
            ->withErrors(['email' => __('filament-panels::pages/auth/login.messages.failed')])
            ->onlyInput('email');
    }

    // Keep the established cookie/session ID to avoid the reverse-proxy race,
    // but rotate the CSRF token so the pre-login token cannot be reused.
    $request->session()->regenerateToken();
    $request->session()->put(
        'password_hash_web',
        Auth::guard('web')->user()->getAuthPassword(),
    );

    return redirect()->intended('/admin');
})->middleware('guest')->name('admin.login.native');
/*
/ END
*/

// Portfolio Routes
Route::get('/', [PortfolioController::class, 'home'])->name('portfolio.home');
Route::get('/projects', [PortfolioController::class, 'projects'])->name('portfolio.projects');
Route::get('/projects/{project}', [PortfolioController::class, 'projectDetail'])->name('portfolio.project');
Route::get('/contact', [PortfolioController::class, 'contact'])->name('portfolio.contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

