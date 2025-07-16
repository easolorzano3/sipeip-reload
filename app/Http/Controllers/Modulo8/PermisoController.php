<?php

namespace App\Http\Controllers\Modulo8;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\Modulo; // Asegúrate de importar el modelo

class PermisoController extends Controller
{
    // Mostrar listado de permisos
    public function index()
    {
        $permisos = Permission::with('modulos')->get();
        return view('modulo8.permisos.index', compact('permisos'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $modulos = \App\Models\Modulo::all(); // Obtener todos los módulos
        return view('modulo8.permisos.create', compact('modulos'));
    }

    // Guardar nuevo permiso
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'modulo_id' => 'required|array|min:1|max:8',
            'modulo_id' => 'nullable|exists:modulos,id',
        ]);
            $permiso = Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);
             
        $permiso->modulos()->sync($request->modulo_id);


        return redirect()->route('permisos.index')->with('success', 'Permiso creado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Permission $permiso)
    {
            $modulos = Modulo::all();
            return view('modulo8.permisos.edit', compact('permiso', 'modulos'));
    }

    // Actualizar permiso existente
    public function update(Request $request, Permission $permiso)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permiso->id,
            'modulo_id' => 'required|array|min:1|max:8',
            'modulo_id.*' => 'exists:modulos,id',
        ]);

        $permiso->name = $request->name;
        $permiso->save();

        $permiso->modulos()->sync($request->modulo_id);

        return redirect()->route('permisos.index')->with('success', 'Permiso actualizado correctamente.');
    }

    // Eliminar permiso
    public function destroy(Permission $permiso)
    {
        $permiso->delete();

        return redirect()->route('permisos.index')->with('success', 'Permiso eliminado correctamente.');
    }
}
