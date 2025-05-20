<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Profesores') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <a href="{{ route('teacher.create') }}" class="btn btn-primary mb-3">Nuevo Docente</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo Documento</th>
                    <th>Número Documento</th>
                    <th>Email Personal</th>
                    <th>Email Institucional</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->last_name }}</td>
                        <td>{{ $teacher->document_type }}</td>
                        <td>{{ $teacher->id_number }}</td>
                        <td>{{ $teacher->personal_email }}</td>
                        <td>{{ $teacher->institutional_email }}</td>
                        <td>
                            <a href="{{ route('teacher.show', $teacher->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('teacher.destroy', $teacher->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este profesor?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
