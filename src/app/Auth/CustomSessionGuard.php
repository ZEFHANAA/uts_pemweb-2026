<?php

namespace App\Auth;

use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Auth\UserProvider;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Timebox;

/**
 * SessionGuard tanpa session->migrate(true) saat login.
 *
 * Root cause bug login Filament uts_pemweb:
 *   Auth::attempt() → SessionGuard::login() → updateSession()
 *   → $session->migrate(true) (session ID BARU).
 *   Browser redirect fetch /admin bawa cookie ID lama sebelum
 *   Set-Cookie ID baru tersimpan → 302 login ulang → flaky.
 *
 * Override updateSession: put login ID saja, skip migrate().
 * Session ID tetap → cookie konsisten → redirect /admin authenticated.
 *
 * ponytail: security trade-off = tidak ada session-fixation protection
 * via ID rotation saat login. Upgrade: kembalikan migrate(true) kalau
 * sudah pakai full-page reload (bukan Livewire SPA) atau pasang
 * double-submit cookie + same-site strict.
 */
class CustomSessionGuard extends SessionGuard
{
    public function __construct(
        $name,
        UserProvider $provider,
        Session $session,
        ?Request $request = null,
        ?Timebox $timebox = null,
        bool $rehashOnLogin = true,
    ) {
        parent::__construct($name, $provider, $session, $request, $timebox, $rehashOnLogin);
    }

    protected function updateSession($id)
    {
        $this->session->put($this->getName(), $id);

        // Skip $this->session->migrate(true) — pertahankan session ID lama.
        $this->session->save();
    }
}
