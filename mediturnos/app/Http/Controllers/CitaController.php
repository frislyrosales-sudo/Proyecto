<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CitaController extends Controller
{
    // Listar todas las citas
    public function index()
    {
        $citas = Cita::with(['paciente.user', 'medico.user', 'medico.especialidad'])->get();
        return view('citas.index', compact('citas'));
    }

    // Formulario para crear cita
    public function create()
    {
        $pacientes = Paciente::with('user')->get();
        $medicos = Medico::with(['user', 'especialidad'])->get();

        return view('citas.create', compact('pacientes', 'medicos'));
    }

    // Guardar una nueva cita
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id'   => 'required|exists:medicos,id',
            'motivo'      => 'nullable|string|max:500',

            'fecha' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'hora' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->fecha === Carbon::today()->toDateString()) {
                        $horaCita = Carbon::parse($request->fecha . ' ' . $value);
                        if ($horaCita->isPast()) {
                            $fail('Usted no puede hacer una cita médica si quiere crear una cita para ayer o una hora pasada.');
                            return;
                        }
                    }

                    $citaExistente = Cita::where('medico_id', $request->medico_id)
                        ->where('fecha', $request->fecha)
                        ->where('hora', $value)
                        ->exists();

                    if ($citaExistente) {
                        $fail('El médico ya tiene una cita agendada para esa misma fecha y hora.');
                    }
                },
            ],
        ], [
            'fecha.after_or_equal' => 'Usted no puede hacer una cita médica si quiere crear una cita para ayer o una fecha pasada.',
        ]);

        Cita::create([
            'paciente_id' => $request->paciente_id,
            'medico_id'   => $request->medico_id,
            'fecha'       => $request->fecha,
            'hora'        => $request->hora,
            'motivo'      => $request->motivo,
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita agendada exitosamente.');
    }

    // Formulario para editar una cita existente
    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $pacientes = Paciente::with('user')->get();
        $medicos = Medico::with(['user', 'especialidad'])->get();

        return view('citas.edit', compact('cita', 'pacientes', 'medicos'));
    }

    // Actualizar cita existente
    public function update(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);

        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id'   => 'required|exists:medicos,id',
            'motivo'      => 'nullable|string|max:500',

            'fecha' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'hora' => [
                'required',
                function ($attribute, $value, $fail) use ($request, $cita) {
                    if ($request->fecha === Carbon::today()->toDateString()) {
                        $horaCita = Carbon::parse($request->fecha . ' ' . $value);
                        if ($horaCita->isPast()) {
                            $fail('Usted no puede hacer una cita médica si quiere crear una cita para ayer o una hora pasada.');
                            return;
                        }
                    }

                    $citaExistente = Cita::where('medico_id', $request->medico_id)
                        ->where('fecha', $request->fecha)
                        ->where('hora', $value)
                        ->where('id', '!=', $cita->id)
                        ->exists();

                    if ($citaExistente) {
                        $fail('El médico ya tiene una cita agendada para esa misma fecha y hora.');
                    }
                },
            ],
        ], [
            'fecha.after_or_equal' => 'Usted no puede hacer una cita médica si quiere crear una cita para ayer o una fecha pasada.',
        ]);

        $cita->update([
            'paciente_id' => $request->paciente_id,
            'medico_id'   => $request->medico_id,
            'fecha'       => $request->fecha,
            'hora'        => $request->hora,
            'motivo'      => $request->motivo,
        ]);

        return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente.');
    }

    // Eliminar cita
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada correctamente.');
    }
}