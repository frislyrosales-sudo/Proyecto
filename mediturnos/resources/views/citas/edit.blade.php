@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h4 class="m-0">Editar Cita Médica</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('citas.update', $cita->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="paciente_id" class="form-label">Paciente</label>
                            <select name="paciente_id" id="paciente_id" class="form-select @error('paciente_id') is-invalid @enderror" required>
                                @foreach($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}" {{ $cita->paciente_id == $paciente->id ? 'selected' : '' }}>
                                        {{ $paciente->user->name ?? 'Paciente #' . $paciente->id }}
                                    </option>
                                @endforeach
                            </select>
                            @error('paciente_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="medico_id" class="form-label">Médico</label>
                            <select name="medico_id" id="medico_id" class="form-select @error('medico_id') is-invalid @enderror" required>
                                @foreach($medicos as $medico)
                                    <option value="{{ $medico->id }}" {{ $cita->medico_id == $medico->id ? 'selected' : '' }}>
                                        {{ $medico->user->name ?? 'Médico #' . $medico->id }} - {{ $medico->especialidad->nombre ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('medico_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', $cita->fecha) }}" required>
                            @error('fecha') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" name="hora" id="hora" class="form-control @error('hora') is-invalid @enderror" value="{{ old('hora', $cita->hora) }}" required>
                            @error('hora') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
                                <option value="pendiente" {{ $cita->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="completada" {{ $cita->estado == 'completada' ? 'selected' : '' }}>Completada</option>
                                <option value="cancelada" {{ $cita->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                            @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="motivo" class="form-label">Motivo de la Consulta</label>
                        <textarea name="motivo" id="motivo" class="form-control @error('motivo') is-invalid @enderror" rows="3">{{ old('motivo', $cita->motivo) }}</textarea>
                        @error('motivo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('citas.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar Cita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection