<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Curriculum') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('curriculum.update', $curriculum->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="id_academic_program" class="form-label">Programa académico</label>
                <select name="id_academic_program" class="form-control" required>
                    @foreach ($programs as $program)
                        <option value="{{ $program->id }}" {{ $program->id == $curriculum->id_academic_program ? 'selected' : '' }}>
                            {{ $program->name_program }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="version" class="form-label">Versión</label>
                <input type="text" name="version" class="form-control" value="{{ old('version', $curriculum->version) }}" required>
            </div>

            <div class="mb-3">
                <label for="date_pass" class="form-label">Fecha de aprobación</label>
                <input type="date" name="date_pass" class="form-control" value="{{ old('date_pass', $curriculum->date_pass) }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        </form>
    </div>
</x-app-layout>
