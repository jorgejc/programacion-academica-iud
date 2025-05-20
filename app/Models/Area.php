<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente

    protected $fillable = [
        'id_academic_program',
        'description_area',
        'id_teacher',
    ];

    // Relación con Program (programa académico)

    public function program()
    {
        return $this->belongsTo(Program::class, 'id_academic_program');
    }

    // Relación con Teacher (profesor responsable)

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_teacher');
    }
}

