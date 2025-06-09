<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Agregar Horario') }}
        </h2>
    </x-slot>

    <div class="container mt-4">

        {{-- Alerta de error por cruce de horario --}}
       @if ($errors->has('error'))
    <div class="bg-red-600 text-white px-4 py-3 rounded shadow-lg mb-4" role="alert">
        <div class="flex items-center">
            <svg class="w-6 h-6 mr-2 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M10 0C4.5 0 0 4.5 0 10s4.5 10 10 10 10-4.5 10-10S15.5 0 10 0zm1 15H9v-2h2v2zm0-4H9V5h2v6z"/>
            </svg>
            <span class="font-bold">¡Horario no disponible!</span>
        </div>
        <p class="ml-8">{{ $errors->first('error') }}</p>
    </div>
@endif


        <form action="{{ route('schedules.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="group_id" class="form-label">Grupo</label>
                <select id="group_id" name="group_id" class="form-control" required>
                    <option value="">Seleccione un grupo</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                            {{ $group->group_code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="day_of_week" class="form-label">Día de la Semana</label>
                <select id="day_of_week" name="day_of_week" class="form-control" required>
                    <option value="">Seleccione un día</option>
                    @foreach (['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'] as $dia)
                        <option value="{{ $dia }}" {{ old('day_of_week') == $dia ? 'selected' : '' }}>{{ $dia }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="start_time" class="form-label">Hora de Inicio</label>
                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time') }}" required>
            </div>

            <div class="mb-3">
                <label for="end_time" class="form-label">Hora de Fin</label>
                <input type="time" name="end_time" id="end_time" class="form-control" value="{{ old('end_time') }}" required>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tipo de Encuentro</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="">Seleccione un tipo</option>
                    <option value="Encuentro Sincrónico" {{ old('type') == 'Encuentro Sincrónico' ? 'selected' : '' }}>Encuentro Sincrónico</option>
                    <option value="Encuentro AAA" {{ old('type') == 'Encuentro AAA' ? 'selected' : '' }}>Encuentro AAA</option>
                </select>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Crear Horario</button>
                <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
