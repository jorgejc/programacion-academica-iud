<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\Program;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index()
    {
        $curriculums = Curriculum::with('program')->get();
        return view('dashboard.curriculum.index', compact('curriculums'));
    }

    public function create()
    {
        $programs = Program::all();
        return view('dashboard.curriculum.create', compact('programs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_academic_program' => 'required|exists:programs,id',
            'version' => 'required|string|max:100',
            'date_pass' => 'required|date',
        ]);

        Curriculum::create($request->all());

        return redirect()->route('curriculum.index')->with('success', 'Currículo creado correctamente.');
    }

    public function edit($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        $programs = Program::all();
        return view('dashboard.curriculum.edit', compact('curriculum', 'programs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_academic_program' => 'required|exists:programs,id',
            'version' => 'required|string|max:100',
            'date_pass' => 'required|date',
        ]);

        $curriculum = Curriculum::findOrFail($id);
        $curriculum->update($request->all());

        return redirect()->route('curriculum.index')->with('success', 'Currículo actualizado correctamente.');
    }

    public function destroy($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        $curriculum->delete();

        return redirect()->route('curriculum.index')->with('success', 'Currículo eliminado correctamente.');
    }
}
