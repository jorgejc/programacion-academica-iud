<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Semestre') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <h1 class="mb-4">Editar Semestre</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('curriculum_semester.update', $curriculum_semester->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="id_curriculum">Currículo</label>
                <select name="id_curriculum" class="form-control" required>
                    <option value="">Seleccione un currículo</option>
                    @foreach ($curriculums as $curriculum)
                        <option value="{{ $curriculum->id }}" {{ $curriculum->id == $curriculum_semester->id_curriculum ? 'selected' : '' }}>
                            {{ $curriculum->name ?? 'Curriculum #' . $curriculum->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="semester_number">Número del Semestre</label>
                <input type="text" name="semester_number" class="form-control" value="{{ $curriculum_semester->semester_number }}" required>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('curriculum_semester.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</x-app-layout>
