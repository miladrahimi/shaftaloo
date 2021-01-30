<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class SignOutController extends Controller
{
    public function do()
    {
        auth()->logout();

        return redirect(route('auth.sign-in.show'));
    }
}
