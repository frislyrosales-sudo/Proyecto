@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="m-0">Listado de Médicos</h4>
        <a href="{{ route('medicos.create') }}" class="btn btn-primary btn-sm">Nuevo Médico</a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Médico</th>
                    <th>Especialidad</th>
                    <th>No. Colegiado</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicos as $medico)
                <tr>
                    <td>{{ $medico->id }}</td>
                    <td>{{ $medico->user->name ?? 'Sin usuario' }}</td>
                    <td>{{ $medico->especialidad->nombre ?? 'Sin especialidad' }}</td>
                    <td>{{ $medico->colegiado }}</td>
                    <td>{{ $medico->telefono }}</td>
                    <td>
                        <a href="{{ route('medicos.edit', $medico->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar este médico?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No hay médicos registrados aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection