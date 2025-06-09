<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use App\Models\Group;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with('group')->paginate(10);
        return view('dashboard.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = Group::all();
        return view('dashboard.schedules.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'group_id' => 'required|exists:groups,id',
        'day_of_week' => 'required|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
        'type' => 'required|in:Encuentro Sincrónico,Encuentro AAA',
    ]);

    // Verificar si hay cruce de horarios con otros grupos
    $conflict = Schedule::where('day_of_week', $request->day_of_week)
        ->where('group_id', '!=', $request->group_id) // que sea de otro grupo
        ->where(function ($query) use ($request) {
            $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                  ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                  ->orWhere(function ($q) use ($request) {
                      $q->where('start_time', '<=', $request->start_time)
                        ->where('end_time', '>=', $request->end_time);
                  });
        })
        ->exists();

    if ($conflict) {
        return back()->withErrors(['error' => 'Este horario se cruza con otro grupo en el mismo día y hora.'])->withInput();
    }

    Schedule::create($request->all());

    return redirect()->route('schedules.index')->with('success', 'Horario creado con éxito.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $schedule = Schedule::with('group')->findOrFail($id);
    return view('dashboard.schedules.show', compact('schedule'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $schedule = Schedule::findOrFail($id);
    $groups = Group::all();
    return view('dashboard.schedules.edit', compact('schedule', 'groups'));
}


    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id)
{
    $request->validate([
        'group_id' => 'required|exists:groups,id',
        'day_of_week' => 'required|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
        'start_time' => 'required|date_format:H:i',
        'end_time' => 'required|date_format:H:i|after:start_time',
        'type' => 'required|in:Encuentro Sincrónico,Encuentro AAA',
    ]);

    // Verificar si hay cruce de horarios con otros grupos
    $conflict = Schedule::where('id', '!=', $id)
        ->where('day_of_week', $request->day_of_week)
        ->where('group_id', '!=', $request->group_id)
        ->where(function ($query) use ($request) {
            $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                ->orWhere(function ($q) use ($request) {
                    $q->where('start_time', '<=', $request->start_time)
                        ->where('end_time', '>=', $request->end_time);
                });
        })
        ->exists();

    if ($conflict) {
        return back()->withErrors(['error' => 'Este horario se cruza con otro grupo en el mismo día y hora.'])->withInput();
    }

    $schedule = Schedule::findOrFail($id);
    $schedule->update($request->all());

    return redirect()->route('schedules.index')->with('success', 'Horario actualizado correctamente.');
}





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $schedule = Schedule::findOrFail($id);
    $schedule->delete();

    return redirect()->route('schedules.index')->with('success', 'Horario eliminado con éxito.');
}

}
