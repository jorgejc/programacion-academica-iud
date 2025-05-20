<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\AcademicSemester;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function index()
    {
        $blocks = Block::with('academicSemester')->get();
        return view('dashboard.blocks.index', compact('blocks'));
    }

    public function create()
    {
        $semesters = AcademicSemester::all();
        return view('dashboard.blocks.create', compact('semesters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:100',
            'id_academic_semester' => 'required|exists:academic_semesters,id',
        ]);

        Block::create($request->all());

        return redirect()->route('blocks.index')->with('success', 'Bloque creado correctamente');
    }

    public function destroy($id)
    {
        Block::destroy($id);
        return back()->with('success', 'Bloque eliminado correctamente');
    }
}
