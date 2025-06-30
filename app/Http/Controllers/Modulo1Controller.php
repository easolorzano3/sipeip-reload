<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Modulo1Controller extends Controller
{
    public function dashboard()
    {
        return view('modulo1.dashboard');
    }
}
