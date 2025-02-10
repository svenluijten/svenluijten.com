<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\RedirectResponse;

class AttemptLogin
{
    public function __invoke(LoginRequest $request, AuthManager $auth): RedirectResponse
    {
        $credentials = $request->only(['username', 'password']);

        if ($auth->attempt($credentials)) {
            return redirect()->intended('/admin');
        }

        return redirect()->back();
    }
}
