<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class SignInController extends Controller
{
    public function show()
    {
        return view('auth-sign-in');
    }

    public function do(Request $request)
    {
        $this->validate($request, [
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $credential = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credential)) {
            return redirect(route('dashboard'));
        } else {
            return back()->with('error', 'Incorrect username or password.')->withInput();
        }
    }
}
