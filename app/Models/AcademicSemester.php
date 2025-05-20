<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicSemester extends Model
{
    use HasFactory;

    // Especificar los campos que pueden ser asignados masivamente
    protected $fillable = [
        'description',
        'academic_year',
    ];

    // Si quieres evitar que se asignen columnas de tipo timestamp automáticamente
    // protected $timestamps = false;
}
