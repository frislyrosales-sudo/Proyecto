@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-primary">
            <div class="card-header bg-primary text-white">
                <h4 class="m-0">Pasarela de Pago</h4>
            </div>
            <div class="card-body">

                {{-- Muestra alertas si falta llenar algún campo --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-4 p-3 bg-light rounded">
                    <h5>Resumen de la Cita</h5>
                    <p class="mb-1"><strong>Médico:</strong> {{ $cita->medico->user->name ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Especialidad:</strong> {{ $cita->medico->especialidad->nombre ?? 'N/A' }}</p>
                    <p class="mb-1"><strong>Fecha:</strong> {{ $cita->fecha }} a las {{ $cita->hora }}</p>
                    <h4 class="text-success mt-2">Total a Pagar: Q{{ number_format($cita->monto, 2) }}</h4>
                </div>

                <form action="{{ route('paciente.pago.procesar', $cita->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre en la Tarjeta</label>
                        <input type="text" name="nombre_tarjeta" class="form-control" placeholder="Ej. Eduardo Arjona" value="{{ old('nombre_tarjeta') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Número de Tarjeta</label>
                        <input type="text" name="numero_tarjeta" class="form-control" placeholder="1234567891011121" value="{{ old('numero_tarjeta') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Expiración (MM/AA)</label>
                            <input type="text" name="expiracion" class="form-control" placeholder="12/28" value="{{ old('expiracion') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">CVV</label>
                            <input type="password" name="cvv" class="form-control" placeholder="123" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between gap-2 mt-3">
                        <a href="{{ route('paciente.citas.index') }}" class="btn btn-outline-secondary">Volver a Mis Citas</a>
                        <button type="submit" class="btn btn-success flex-grow-1">
                            Pagar Q{{ number_format($cita->monto, 2) }} y Confirmar Cita
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection