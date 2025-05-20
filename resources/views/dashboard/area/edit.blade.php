<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Área') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <h1 class="mb-4">Editar Área</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('area.update', $area->id) }}">
            @csrf
            @method('PUT')

            <!-- Programa académico -->
            <div class="mb-3">
                <label for="id_academic_program" class="form-label">Programa Académico</label>
                <select name="id_academic_program" class="form-control" required>
                    <option value="">Seleccione un programa</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}" {{ $area->id_academic_program == $program->id ? 'selected' : '' }}>
                            {{ $program->name_program }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nombre del área -->
            <div class="mb-3">
                <label for="description_area" class="form-label">Nombre del Área</label>
                <input type="text" name="description_area" class="form-control" value="{{ $area->description_area }}" required>
            </div>

            <!-- Profesor responsable -->
            <div class="mb-3">
                <label for="id_teacher" class="form-label">Profesor Responsable</label>
                <select name="id_teacher" class="form-control" required>
                    <option value="">Seleccione un profesor</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ $area->id_teacher == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }} {{ $teacher->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('area.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</x-app-layout>
