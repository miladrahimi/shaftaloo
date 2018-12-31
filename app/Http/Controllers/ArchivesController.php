<?php

namespace App\Http\Controllers;

use App\Models\Archive;

class ArchivesController extends Controller
{
    public function getIndex()
    {
        $archives = Archive::all();

        return view('archives-index', [
            'archives' => $archives,
        ]);
    }
}