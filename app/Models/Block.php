<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'id_academic_semester',
    ];

    public function academicSemester()
    {
        return $this->belongsTo(AcademicSemester::class, 'id_academic_semester');
    }
}
