<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Áreas') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <a href="{{ route('area.create') }}" class="btn btn-primary mb-3">Nueva Área</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Área</th>
                    <th>Programa Académico</th>
                    <th>Profesor Responsable</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($areas as $area)
                <tr>
                    <td>{{ $area->id }}</td>
                    <td>{{ $area->description_area }}</td>
                    <td>{{ $area->program->name_program ?? 'No asignado' }}</td>
                    <td>{{ $area->teacher->name ?? '' }} {{ $area->teacher->last_name ?? '' }}</td>
                    <td>
                        <a href="{{ route('area.edit', $area->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('area.destroy', $area->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Deseas eliminar esta área?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
