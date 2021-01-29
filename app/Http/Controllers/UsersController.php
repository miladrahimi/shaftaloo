<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;

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
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function postProfile(Request $request)
    {
        $this->validate($request, [
            'password' => 'nullable|confirmed|min:8|max:32',
        ]);

        $user = User::find(Auth::id());

        if ($password = $request->input('password')) {
            $user->password = Hash::make($password);
        }

        $user->save();

        return back()->with('success', 'Your profile updated.');
    }

    /**
     * @return RedirectResponse|Redirector
     */
    public function getSignOut()
    {
        if (Auth::hasUser()) {
            Auth::logout();
        }

        return redirect(route('auth.sign-in.show'));
    }
}
