<?php
namespace App\Http\Middleware;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
class VerifyCsrfTokenExceptLivewire extends VerifyCsrfToken
{
    protected $except = [
        'livewire/*',
    ];
}
