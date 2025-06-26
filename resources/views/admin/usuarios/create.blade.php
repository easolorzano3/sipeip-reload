@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Usuario Institucional</h2>

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf

        <div>
            <label>Nombre:</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label>Correo electrónico:</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label>Unidad Organizacional:</label>
            <select name="unidad_organizacional_id" required>
                <option value="">Seleccione una unidad</option>
                @foreach($unidades as $unidad)
                    <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Contraseña:</label>
            <input type="password" name="password" required>
        </div>

        <div>
            <label>Confirmar contraseña:</label>
            <input type="password" name="password_confirmation" required>
        </div>

        <button type="submit">Guardar</button>
    </form>
</div>
@endsection
