<?php

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class HttpLoginResponse implements LoginResponseContract
{
    public function toResponse($request): RedirectResponse | Redirector
    {
        return redirect()->intended(Filament::getUrl());
    }
}
