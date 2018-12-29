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
            'old_password' => 'required',
            'new_password' => 'nullable|min:6|max:16',
        ]);

        $user = User::find(Auth::id());

        if (Hash::check($request->input('old_password'), $user->password) == false) {
            return back()->with('error', 'Old password is incorrect.');
        }

        if ($request->input('new_password')) {
            $user->password = Hash::make($request->input('new_password'));
        }

        $user->save();

        return back()->with('success', 'User updated.');
    }
}