<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Listado de Bloques') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-6">
        <a href="{{ route('blocks.create') }}" class="btn btn-success mb-4">Crear Bloque</a>

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Semestre Académico</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blocks as $block)
                    <tr>
                        <td>{{ $block->description }}</td>
                        <td>{{ $block->academicSemester->description ?? $block->id_academic_semester }}</td>
                        <td>
                            <form action="{{ route('blocks.destroy', $block->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('¿Seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
