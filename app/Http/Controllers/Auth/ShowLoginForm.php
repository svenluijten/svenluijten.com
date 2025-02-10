<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;

class ShowLoginForm
{
    public function __invoke(): View
    {
        return view('auth.login');
    }
}
