<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Projection;
use App\Models\CurriculumSemester;
use App\Models\SemesterSubject;
use App\Models\Group;
use App\Models\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    /**
     * Muestra el listado de grupos.
     */
    public function index()
    {
        $groups = Group::with('semesterSubject', 'teacher')->paginate(10);
        $programs = Program::all();
        return view('dashboard.group.index', compact('groups', 'programs'));
    }

    /**
     * Muestra el formulario para crear un grupo manualmente.
     */
    public function create()
    {
        $semesterSubjects = SemesterSubject::with('subject')->get();
        $teachers = Teacher::all();
        return view('dashboard.group.create', compact('semesterSubjects', 'teachers'));
    }

    /**
     * Almacena un grupo creado manualmente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_code' => 'required|string|max:100',
            'id_semester_subject' => 'required|exists:semester_subjects,id',
            'id_teacher' => 'nullable|exists:teachers,id',
        ]);

        Group::create($request->all());

        return redirect()->route('group.index')->with('success', 'Grupo creado con éxito.');
    }

    /**
     * Genera grupos automáticamente según el programa, año y semestre académico.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }
    public function autoGenerate(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'year' => 'required|integer',
            'academic_semester' => 'required|integer',
        ]);

        $programId = $request->input('program_id');
        $year = $request->input('year');
        $academicSemester = $request->input('academic_semester');

        // Obtener las proyecciones asociadas al programa, año y semestre
        $projections = Projection::whereHas('curriculum', function ($query) use ($programId) {
            $query->where('id_academic_program', $programId);
        })->where('year', $year)->where('academic_semester', $academicSemester)->get();

        if ($projections->isEmpty()) {
            return redirect()->route('group.index')->with('error', 'No se encontraron proyecciones para los parámetros seleccionados.');
        }

        $studentsPerGroup = 40; // Estudiantes por grupo

        foreach ($projections as $projection) {
            $semesterSubjects = SemesterSubject::where('id_curriculum', $projection->curriculum_id)->get();

            foreach ($semesterSubjects as $semesterSubject) {
                $totalStudents = $projection->projected_students;
                $numGroups = ceil($totalStudents / $studentsPerGroup);

                for ($i = 0; $i < $numGroups; $i++) {
                    Group::create([
                        'group_code' => strtoupper($semesterSubject->id . '-' . Str::random(4)),
                        'id_semester_subject' => $semesterSubject->id,
                        'id_teacher' => Teacher::inRandomOrder()->first()?->id,
                    ]);
                }
            }
        }

        return redirect()->route('group.index')->with('success', 'Grupos generados automáticamente con éxito.');
    }
}
