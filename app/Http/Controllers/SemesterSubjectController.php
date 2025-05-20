<?php

namespace App\Http\Controllers;

use App\Models\SemesterSubject;
use App\Models\Subject;
use App\Models\Block;
use Illuminate\Http\Request;

class SemesterSubjectController extends Controller
{
    public function index()
    {
        $semesterSubjects = SemesterSubject::with('subject', 'block')->get();
        return view('dashboard.semesterSubject.index', compact('semesterSubjects'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $blocks = Block::all();
        return view('dashboard.semesterSubject.create', compact('subjects', 'blocks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_subject' => 'required|exists:subjects,id',
            'id_block' => 'required|exists:blocks,id',
            'students_number' => 'required|integer|min:1',
        ]);
    

        SemesterSubject::create($request->all());

        return redirect()->route('semesterSubject.index')->with('success', 'Asignatura por semestre creada correctamente.');
    }
}
