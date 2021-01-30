<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    public function show()
    {
        return view('auth.sign-in.show');
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
            return redirect(route('transactions.index'));
        } else {
            return back()->with('error', 'Incorrect username or password.')->withInput();
        }
    }
}
