<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumSemester extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_curriculum',
        'semester_number',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'id_curriculum');
    }
}
