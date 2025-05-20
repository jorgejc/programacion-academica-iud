<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Semestres del Currículo') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <h1 class="mb-4">Listado de Semestres</h1>
        <a href="{{ route('curriculum_semester.create') }}" class="btn btn-primary mb-3">Crear Nuevo</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Currículo</th>
                    <th>Semestre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($semesters as $semester)
                    <tr>
                        <td>{{ $semester->id }}</td>
                        <td>{{ $semester->curriculum->name ?? 'Curriculum #' . $semester->curriculum->id }}</td>
                        <td>{{ $semester->semester_number }}</td>
                        <td>
                            <a href="{{ route('curriculum_semester.edit', $semester->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('curriculum_semester.destroy', $semester->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminarlo?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

