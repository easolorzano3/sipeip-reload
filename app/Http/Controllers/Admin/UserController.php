<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UnidadOrganizacional;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        $unidades = UnidadOrganizacional::all();
        return view('admin.usuarios.create', compact('unidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'unidad_organizacional_id' => 'required|exists:unidad_organizacionales,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'unidad_organizacional_id' => $request->unidad_organizacional_id,
            'estado' => 'activo',
        ]);

        return redirect()->route('usuarios.create')->with('success', 'Usuario creado correctamente.');
    }
}
