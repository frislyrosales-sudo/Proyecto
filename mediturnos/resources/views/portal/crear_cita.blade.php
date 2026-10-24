@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="m-0">Agendar Cita Médica</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('paciente.citas.guardar') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="medico_id" class="form-label">Seleccione Médico / Especialidad</label>
                        <select name="medico_id" id="medico_id" class="form-select" required>
                            <option value="">-- Seleccionar --</option>
                            @foreach($medicos as $medico)
                                <option value="{{ $medico->id }}">
                                    {{ $medico->user->name ?? 'Médico' }} - Especialidad: {{ $medico->especialidad->nombre ?? 'General' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha" class="form-label">Fecha de la Cita</label>
                            <input type="date" name="fecha" id="fecha" class="form-control" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" name="hora" id="hora" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="motivo" class="form-label">Motivo de la Consulta</label>
                        <textarea name="motivo" id="motivo" class="form-control" rows="3" placeholder="Síntomas o razón de la consulta..."></textarea>
                    </div>

                    <div class="alert alert-info">
                        <strong>Costo de la Consulta:</strong> Q150.00 (El pago se realiza en el siguiente paso).
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('paciente.citas.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">Continuar al Pago →</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection