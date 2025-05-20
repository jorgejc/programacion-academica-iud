{{-- resources/views/dashboard/curriculum/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Currículos') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <a href="{{ route('curriculum.create') }}" class="btn btn-success mb-3">Nuevo Currículo</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Programa Académico</th>
                    <th>Versión</th>
                    <th>Fecha de Aprobación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($curriculums as $curriculum)
                    <tr>
                        <td>{{ $curriculum->id }}</td>
                        <td>{{ $curriculum->program->name_program ?? 'N/A' }}</td>
                        <td>{{ $curriculum->version }}</td>
                        <td>{{ $curriculum->date_pass }}</td>
                        <td>
                            <a href="{{ route('curriculum.edit', $curriculum->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('curriculum.destroy', $curriculum->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar este currículo?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
