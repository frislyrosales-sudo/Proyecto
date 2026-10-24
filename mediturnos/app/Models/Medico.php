<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $table = 'medicos';

    protected $fillable = [
        'user_id',
        'especialidad_id',
        'colegiado',
        'telefono',
    ];

    // Relación: Un médico pertenece a un Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: Un médico pertenece a una Especialidad
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}