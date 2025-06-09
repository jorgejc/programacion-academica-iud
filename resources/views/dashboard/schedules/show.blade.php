<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Horario') }}
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow p-4">
            <h4 class="mb-4">Información del Horario</h4>

            <div class="mb-3">
                <strong>Grupo:</strong> {{ $schedule->group->group_code }}
            </div>

            <div class="mb-3">
                <strong>Día de la Semana:</strong> {{ $schedule->day_of_week }}
            </div>

            <div class="mb-3">
                <strong>Hora de Inicio:</strong> {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
            </div>

            <div class="mb-3">
                <strong>Hora de Fin:</strong> {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}
            </div>

            <div class="mb-3">
                <strong>Tipo de Encuentro:</strong> {{ $schedule->type }}
            </div>

            <div class="mt-4">
                <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</x-app-layout>
