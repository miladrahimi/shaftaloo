<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

/**
 * Class UsersController
 *
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{
    public function getProfile()
    {
        return view('users-profile', [
            'u' => Auth::user(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postProfile(Request $request)
    {
        $this->validate($request, [
            'password' => 'nullable|confirmed|min:6|max:16',
        ]);

        $user = User::find(Auth::id());

        if ($password = $request->input('password')) {
            $user->password = Hash::make($password);
        }

        $user->save();

        return back()->with('success', 'Your profile updated.');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getSignOut()
    {
        if (Auth::hasUser()) {
            Auth::logout();
        }

        return redirect(route('auth.sign-in'));
    }
}