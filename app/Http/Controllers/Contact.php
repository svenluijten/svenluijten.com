<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class Contact
{
    public function __invoke(): View
    {
        return view('contact');
    }
}
