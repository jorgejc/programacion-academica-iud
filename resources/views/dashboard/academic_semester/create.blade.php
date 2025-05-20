<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Semestre Académico') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        <h1 class="mb-4">Formulario de Registro de Semestre</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('academic_semester.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <input type="text" name="description" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="academic_year" class="form-label">Año Académico</label>
                <input type="number" name="academic_year" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        </form>
    </div>
</x-app-layout>
