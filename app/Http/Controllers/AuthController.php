<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSignIn()
    {
        return view('auth-sign-in');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postSignIn(Request $request)
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
