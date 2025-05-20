<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Semestres Académicos') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <a href="{{ route('academic_semester.create') }}" class="btn btn-primary mb-3">Nuevo Semestre</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Año Académico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($semesters as $semester)
                <tr>
                    <td>{{ $semester->id }}</td>
                    <td>{{ $semester->description }}</td>
                    <td>{{ $semester->academic_year }}</td>
                    <td>
                        <a href="{{ route('academic_semester.edit', $semester->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('academic_semester.destroy', $semester->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Deseas eliminar este semestre?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
