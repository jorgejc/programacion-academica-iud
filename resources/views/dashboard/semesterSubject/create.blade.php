<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear semestre por asignatura') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('semesterSubject.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="id_subject" class="form-label">Asignatura</label>
                <select name="id_subject" class="form-control" required>
                    <option value="">Seleccione una asignatura</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name_subject }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="id_block" class="form-label">Bloque</label>
                <select name="id_block" class="form-control" required>
                    <option value="">Seleccione un bloque</option>
                    @foreach($blocks as $block)
                        <option value="{{ $block->id }}">{{ $block->description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="students_number" class="form-label">Cantidad de estudiantes</label>
                <input type="number" class="form-control" name="students_number" min="1" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</x-app-layout>

