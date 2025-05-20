<?php

namespace App\Http\Controllers;

use App\Models\CurriculumSemester;
use App\Models\Curriculum;
use Illuminate\Http\Request;

class CurriculumSemesterController extends Controller
{
    public function index()
    {
        $semesters = CurriculumSemester::with('curriculum')->get();
        return view('dashboard.curriculum_semester.index', compact('semesters'));
    }

    public function create()
    {
        $curriculums = Curriculum::all();
        return view('dashboard.curriculum_semester.create', compact('curriculums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_curriculum' => 'required|exists:curriculums,id',
            'semester_number' => 'required|string|max:100',
        ]);

        CurriculumSemester::create($request->all());

        return redirect()->route('curriculum_semester.index')->with('success', 'Semestre creado correctamente');
    }

    public function edit(CurriculumSemester $curriculum_semester)
    {
        $curriculums = Curriculum::all();
        return view('dashboard.curriculum_semester.edit', compact('curriculum_semester', 'curriculums'));
    }

    public function update(Request $request, CurriculumSemester $curriculum_semester)
    {
        $request->validate([
            'id_curriculum' => 'required|exists:curriculums,id',
            'semester_number' => 'required|string|max:100',
        ]);

        $curriculum_semester->update($request->all());

        return redirect()->route('curriculum_semester.index')->with('success', 'Semestre actualizado correctamente');
    }

    public function destroy(CurriculumSemester $curriculum_semester)
    {
        $curriculum_semester->delete();
        return redirect()->route('curriculum_semester.index')->with('success', 'Semestre eliminado correctamente');
    }
}
