<?php

namespace App\Filament\Pages\Auth;

use DiogoGPinto\AuthUIEnhancer\Pages\Auth\AuthUiEnhancerLogin;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Models\Contracts\FilamentUser;

class CustomLogin extends AuthUiEnhancerLogin
{
    protected static string $view = 'filament.pages.auth.native-login';

    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        if (! Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            $this->throwFailureValidationException();
        }

        $user = Filament::auth()->user();

        if (($user instanceof FilamentUser) && (! $user->canAccessPanel(Filament::getCurrentPanel()))) {
            Filament::auth()->logout();
            $this->throwFailureValidationException();
        }

        // Keep session ID (CustomSessionGuard skips migrate). Persist auth + password hash
        // so AuthenticateSession middleware does not log the user out after redirect.
        $guardName = Filament::getAuthGuard() ?: config('auth.defaults.guard', 'web');
        session()->put('password_hash_'.$guardName, $user->getAuthPassword());
        session()->save();

        // Full page redirect (navigate:false) — avoids Livewire SPA race that drops auth.
        $this->redirect(Filament::getUrl(), navigate: false);

        return null;
    }
}
