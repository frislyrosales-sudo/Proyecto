<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Especialidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MedicoController extends Controller
{
    public function index()
    {
        $medicos = Medico::with(['user', 'especialidad'])->get();
        return view('medicos.index', compact('medicos'));
    }

    public function create()
    {
        $especialidades = Especialidad::all();
        return view('medicos.create', compact('especialidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'especialidad_id' => 'required|exists:especialidades,id',
            'colegiado' => 'required|string|max:50',
            'telefono' => 'required|string|max:20',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => 'medico',
        ]);

        Medico::create([
            'user_id' => $user->id,
            'especialidad_id' => $request->especialidad_id,
            'colegiado' => $request->colegiado,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('medicos.index')->with('success', 'Médico registrado con éxito.');
    }

    public function edit($id)
    {
        $medico = Medico::with('user')->findOrFail($id);
        $especialidades = Especialidad::all();
        return view('medicos.edit', compact('medico', 'especialidades'));
    }

    public function update(Request $request, $id)
    {
        $medico = Medico::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $medico->user_id,
            'especialidad_id' => 'required|exists:especialidades,id',
            'colegiado' => 'required|string|max:50',
            'telefono' => 'required|string|max:20',
        ]);

        // Actualizar datos del Usuario
        $medico->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Actualizar datos del Médico
        $medico->update([
            'especialidad_id' => $request->especialidad_id,
            'colegiado' => $request->colegiado,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('medicos.index')->with('success', 'Médico actualizado con éxito.');
    }

    public function destroy($id)
    {
        $medico = Medico::findOrFail($id);
        // Al eliminar el usuario, la BD eliminará en cascada el registro del médico
        $medico->user->delete();

        return redirect()->route('medicos.index')->with('success', 'Médico eliminado con éxito.');
    }
}