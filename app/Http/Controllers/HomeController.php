<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function show()
    {
        return redirect()->route('transactions.index');
    }
}
