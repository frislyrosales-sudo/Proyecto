<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortalPacienteController extends Controller
{
    // Ver mis citas agendadas
    public function misCitas()
    {
        $user = Auth::user();
        $paciente = Paciente::where('user_id', $user->id)->first();

        $citas = $paciente 
            ? Cita::with(['medico.user', 'medico.especialidad'])->where('paciente_id', $paciente->id)->get()
            : collect();

        return view('portal.mis_citas', compact('citas'));
    }

    // Formulario para reservar cita
    public function crearCita()
    {
        $medicos = Medico::with(['user', 'especialidad'])->get();
        return view('portal.crear_cita', compact('medicos'));
    }

    // Guardar cita y redirigir al pago
    public function guardarCita(Request $request)
    {
        $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'motivo' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        // Buscar o crear el perfil de paciente vinculado al usuario
        $paciente = Paciente::firstOrCreate(
            ['user_id' => $user->id],
            ['telefono' => 'Sin registrar']
        );

        $cita = Cita::create([
            'paciente_id' => $paciente->id,
            'medico_id' => $request->medico_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'motivo' => $request->motivo,
            'estado' => 'pendiente',
            'monto' => 150.00, // Tarifa fija por consulta
            'estado_pago' => 'pendiente',
        ]);

        return redirect()->route('paciente.pago', $cita->id);
    }

    // Mostrar pantalla de pago
    public function mostrarPago($id)
    {
        $cita = Cita::with(['medico.user', 'medico.especialidad'])->findOrFail($id);
        return view('portal.pago', compact('cita'));
    }

    // Procesar Pago
   public function procesarPago(Request $request, $id)
{
    // Validar que los campos no estén vacíos
    $request->validate([
        'nombre_tarjeta' => 'required|string',
        'numero_tarjeta' => 'required|string',
        'expiracion'     => 'required|string',
        'cvv'            => 'required|string',
    ]);

    $cita = Cita::findOrFail($id);
    $cita->update([
        'estado_pago' => 'pagado',
        'metodo_pago' => 'Tarjeta de Crédito/Débito',
        'estado'      => 'confirmada',
    ]);

    // Redireccionar directamente a la lista de citas del paciente
    return redirect()->route('paciente.citas.index')->with('success', '¡Pago realizado con éxito! Tu cita ha sido confirmada.');
}
}
