<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Crear Bloque') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6">
        <form method="POST" action="{{ route('blocks.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Descripción</label>
                <input type="text" name="description" class="form-input rounded-md shadow-sm mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700">Semestre Académico</label>
                <select name="id_academic_semester" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                    <option value="">Seleccione un semestre</option>
                    @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}">{{ $semester->description ?? $semester->id }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Guardar</button>
        </form>
    </div>
</x-app-layout>
