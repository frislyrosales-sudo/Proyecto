@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="m-0">Gestión de Citas Médicas</h4>
        <a href="{{ route('citas.create') }}" class="btn btn-primary btn-sm">Agendar Cita</a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Especialidad</th>
                    <th>Fecha y Hora</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($citas as $cita)
                <tr>
                    <td>{{ $cita->id }}</td>
                    <td>{{ $cita->paciente->user->name ?? 'N/A' }}</td>
                    <td>{{ $cita->medico->user->name ?? 'N/A' }}</td>
                    <td>{{ $cita->medico->especialidad->nombre ?? 'N/A' }}</td>
                    <td>{{ $cita->fecha }} {{ $cita->hora }}</td>
                    <td>
                        <span class="badge bg-{{ $cita->estado == 'pendiente' ? 'warning' : ($cita->estado == 'completada' ? 'success' : 'danger') }}">
                            {{ ucfirst($cita->estado) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('citas.edit', $cita->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('citas.destroy', $cita->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Deseas cancelar/eliminar esta cita?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No hay citas programadas aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection