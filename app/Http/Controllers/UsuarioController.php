<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UnidadOrganizacional;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    // Mostrar listado de usuarios
    public function index()
    {
        $usuarios = User::with('roles', 'permissions')->get();
        return view('modulo8.usuarios.index', compact('usuarios'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $unidades = UnidadOrganizacional::all();
        $roles = Role::all();

        return view('modulo8.usuarios.create', compact('unidades', 'roles'));
    }

    // Almacenar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'unidad_organizacional_id' => 'nullable|exists:unidad_organizacionales,id',
            'rol' => 'nullable|exists:roles,name',
        ]);

        $usuario = User::create([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'name' => $request->nombres . ' ' . $request->apellidos, // Generado automáticamente
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'unidad_organizacional_id' => $request->unidad_organizacional_id,
        ]);

        if ($request->rol) {
            $usuario->assignRole($request->rol);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(User $usuario)
    {
        $unidades = UnidadOrganizacional::all();
        $roles = Role::all();

        return view('modulo8.usuarios.edit', compact('usuario', 'unidades', 'roles'));
    }

    // Actualizar usuario existente
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $usuario->id,
            'password' => 'nullable|string|min:6|confirmed',
            'unidad_organizacional_id' => 'nullable|exists:unidad_organizacional,id',
            'rol' => 'nullable|exists:roles,name',
        ]);

        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->name = $request->nombres . ' ' . $request->apellidos;
        $usuario->email = $request->email;
        $usuario->unidad_organizacional_id = $request->unidad_organizacional_id;

        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
        }

        $usuario->save();

        if ($request->rol) {
            $usuario->syncRoles([$request->rol]);
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // Eliminar usuario
    public function destroy(User $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
