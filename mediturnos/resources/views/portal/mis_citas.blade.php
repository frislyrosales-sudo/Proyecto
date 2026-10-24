@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h4 class="m-0">Mis Citas Médicas</h4>
        <a href="{{ route('paciente.citas.crear') }}" class="btn btn-success btn-sm">+ Agendar Nueva Cita</a>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Fecha y Hora</th>
                    <th>Médico</th>
                    <th>Especialidad</th>
                    <th>Monto</th>
                    <th>Estado Cita</th>
                    <th>Estado Pago</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($citas as $cita)
                <tr>
                    <td>{{ $cita->fecha }} - {{ $cita->hora }}</td>
                    <td>{{ $cita->medico->user->name ?? 'N/A' }}</td>
                    <td>{{ $cita->medico->especialidad->nombre ?? 'N/A' }}</td>
                    <td>Q{{ number_format($cita->monto, 2) }}</td>
                    <td>
                        <span class="badge bg-{{ $cita->estado == 'completada' ? 'success' : 'warning' }}">
                            {{ ucfirst($cita->estado) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $cita->estado_pago == 'pagado' ? 'success' : 'danger' }}">
                            {{ ucfirst($cita->estado_pago) }}
                        </span>
                    </td>
                    <td>
                        @if($cita->estado_pago == 'pendiente')
                            <a href="{{ route('paciente.pago', $cita->id) }}" class="btn btn-sm btn-primary">Pagar Ahora</a>
                        @else
                            <span class="text-success fw-bold">✓ Pagado</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No tienes citas agendadas aún.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection