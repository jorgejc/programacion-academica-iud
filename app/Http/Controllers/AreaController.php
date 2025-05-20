<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Program;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::with(['program', 'teacher'])->paginate(10);
        return view('dashboard.area.index', compact('areas'));
    }

    public function create()
    {
        $programs = Program::all();
        $teachers = Teacher::all();
        return view('dashboard.area.create', compact('programs', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_academic_program' => 'required|exists:programs,id',
            'description_area' => 'required|string|max:100',
            'id_teacher' => 'required|exists:teachers,id',
        ]);

        Area::create($request->all());

        return redirect()->route('area.index')->with('success', 'Área creada con éxito.');
    }

    public function edit(Area $area)
    {
        $programs = Program::all();
        $teachers = Teacher::all();
        return view('dashboard.area.edit', compact('area', 'programs', 'teachers'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'id_academic_program' => 'required|exists:programs,id',
            'description_area' => 'required|string|max:100',
            'id_teacher' => 'required|exists:teachers,id',
        ]);

        $area->update($request->all());

        return redirect()->route('area.index')->with('success', 'Área actualizada con éxito.');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('area.index')->with('success', 'Área eliminada.');
    }
}
