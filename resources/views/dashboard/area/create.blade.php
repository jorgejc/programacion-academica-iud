<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Área') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <h1 class="mb-4">Formulario de Registro de Área</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('area.store') }}" method="POST">
            @csrf

            <!-- Programa académico -->
            <div class="mb-3">
                <label for="id_academic_program" class="form-label">Programa Académico</label>
                <select name="id_academic_program" class="form-control" required>
                    <option value="">Seleccione un programa</option>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}">{{ $program->name_program }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Nombre del área -->
            <div class="mb-3">
                <label for="description_area" class="form-label">Nombre del Área</label>
                <input type="text" name="description_area" class="form-control" required>
            </div>

            <!-- Profesor responsable -->
            <div class="mb-3">
                <label for="id_teacher" class="form-label">Profesor Responsable</label>
                <select name="id_teacher" class="form-control" required>
                    <option value="">Seleccione un profesor</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }} {{ $teacher->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        </form>
    </div>
</x-app-layout>
