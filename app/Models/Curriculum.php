<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums'; // 👈 importante

    protected $fillable = [
        'id_academic_program',
        'version',
        'date_pass',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'id_academic_program');
    }
}
