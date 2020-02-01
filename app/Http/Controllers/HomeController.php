<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return RedirectResponse|Redirector
     */
    public function getHome()
    {
        return redirect(route('auth.sign-in'));
    }
}
