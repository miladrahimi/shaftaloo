<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show', [
            'u' => Auth::user(),
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request)
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
}
