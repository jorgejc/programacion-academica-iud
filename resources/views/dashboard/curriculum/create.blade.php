<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Curriculum') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('curriculum.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="id_academic_program" class="form-label">Programa académico</label>
                <select name="id_academic_program" class="form-control" required>
                    @foreach ($programs as $program)
                    <option value="{{ $program->id }}">{{ $program->name_program }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="version" class="form-label">Versión</label>
                <input type="text" name="version" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="date_pass" class="form-label">Fecha de aprobación</label>
                <input type="date" name="date_pass" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        </form>
    </div>
</x-app-layout>
