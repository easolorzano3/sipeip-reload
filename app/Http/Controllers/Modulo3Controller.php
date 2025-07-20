<?php

namespace App\Http\Controllers;
use App\Models\PlanInstitucional;

use Illuminate\Http\Request;

class Modulo3Controller extends Controller
{
    public function dashboard()
    {
        return view('modulo3.dashboard');
    }

    public function index()
    {
        $planes = PlanInstitucional::with('estado') // 🔧 importante para que funcione
            ->whereHas('estado', function ($q) {
                $q->where('nombre', 'publicado');
            })
            ->get()
            ->filter(function ($plan) {
                return $plan->requiereInversion();
            });

        return view('modulo3.dashboard', compact('planes'));
    }
}
