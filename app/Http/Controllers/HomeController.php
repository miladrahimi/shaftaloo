<?php

namespace App\Http\Controllers;

use Auth;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getHome()
    {
        if (Auth::hasUser()) {
            return redirect(route('transactions.index'));
        } else {
            return redirect(route('auth.sign-in'));
        }
    }
}