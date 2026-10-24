@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h4 class="m-0">Editar Médico</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('medicos.update', $medico->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h5 class="text-primary mb-3">Datos de Cuenta</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nombre Completo</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $medico->user->name ?? '') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $medico->user->email ?? '') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <hr>
                    <h5 class="text-primary mb-3">Información Profesional</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="especialidad_id" class="form-label">Especialidad</label>
                            <select name="especialidad_id" id="especialidad_id" class="form-select @error('especialidad_id') is-invalid @enderror" required>
                                @foreach($especialidades as $especialidad)
                                    <option value="{{ $especialidad->id }}" {{ $medico->especialidad_id == $especialidad->id ? 'selected' : '' }}>
                                        {{ $especialidad->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('especialidad_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="colegiado" class="form-label">No. Colegiado</label>
                            <input type="text" name="colegiado" id="colegiado" class="form-control @error('colegiado') is-invalid @enderror" value="{{ old('colegiado', $medico->colegiado) }}" required>
                            @error('colegiado') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $medico->telefono) }}" required>
                            @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('medicos.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar Médico</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection