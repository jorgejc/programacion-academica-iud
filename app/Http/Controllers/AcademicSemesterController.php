<?php

namespace App\Http\Controllers;

use App\Models\AcademicSemester;
use Illuminate\Http\Request;

class AcademicSemesterController extends Controller
{
    // Mostrar la lista de semestres académicos
    public function index()
    {
        $semesters = AcademicSemester::all();
        return view('dashboard.academic_semester.index', compact('semesters'));
    }

    // Mostrar el formulario para crear un nuevo semestre
    public function create()
    {
        return view('dashboard.academic_semester.create');
    }

    // Almacenar un nuevo semestre
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:100',
            'academic_year' => 'required|integer',
        ]);

        AcademicSemester::create($request->all());

        return redirect()->route('academic_semester.index')
                         ->with('success', 'Semester created successfully.');
    }

    // Mostrar un semestre específico
    public function show($id)
    {
        $semester = AcademicSemester::findOrFail($id);
        return view('dashboard.academic_semester.show', compact('semester'));
    }

    // Mostrar el formulario para editar un semestre
    public function edit($id)
    {
        $semester = AcademicSemester::findOrFail($id);
        return view('dashboard.academic_semester.edit', compact('semester'));
    }

    // Actualizar un semestre específico
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|string|max:100',
            'academic_year' => 'required|integer',
        ]);

        $semester = AcademicSemester::findOrFail($id);
        $semester->update($request->all());

        return redirect()->route('academic_semester.index')
                         ->with('success', 'Semester updated successfully.');
    }

    // Eliminar un semestre
    public function destroy($id)
    {
        $semester = AcademicSemester::findOrFail($id);
        $semester->delete();

        return redirect()->route('academic_semester.index')
                         ->with('success', 'Semester deleted successfully.');
    }
}
