<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Horario') }}
        </h2>
    </x-slot>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li><strong>{{ $error }}</strong></li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="container py-4">
        <form action="{{ route('schedules.update', $schedule->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="group_id" class="form-label">Grupo</label>
                <select id="group_id" name="group_id" class="form-control" required>
                    <option value="">Seleccione un grupo</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" {{ $schedule->group_id == $group->id ? 'selected' : '' }}>
                            {{ $group->group_code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="day_of_week" class="form-label">Día de la Semana</label>
                <select id="day_of_week" name="day_of_week" class="form-control" required>
                    @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $day)
                        <option value="{{ $day }}" {{ $schedule->day_of_week == $day ? 'selected' : '' }}>
                            {{ $day }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Hora de Inicio</label>
                <input type="time" name="start_time" id="start_time" class="form-control"
                    value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}" required>
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">Hora de Fin</label>
                <input type="time" name="end_time" id="end_time" class="form-control"
                    value="{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}" required>
            </div>


            <div class="mb-3">
                <label for="type" class="form-label">Tipo de Encuentro</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="Encuentro Sincrónico" {{ $schedule->type == 'Encuentro Sincrónico' ? 'selected' : '' }}>Encuentro Sincrónico</option>
                    <option value="Encuentro AAA" {{ $schedule->type == 'Encuentro AAA' ? 'selected' : '' }}>Encuentro AAA</option>
                </select>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{url('dashboard/schedules')}}" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
    </div>
</x-app-layout>
