<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Creando nueva Asignatura') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('subject.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name_subject" class="form-label">Nombre Asignatura</label>
                <input type="text" name="name_subject" id="name_subject" class="form-control" value="{{ old('name_subject') }}" required>
            </div>

            <div class="mb-3">
                <label for="subject_credit" class="form-label">Créditos Asignatura</label>
                <select name="subject_credit" id="subject_credit" class="form-control" required>
                    <option value="">Escoge cantidad de créditos</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('subject_credit') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="mb-3">
                <label for="subject_code" class="form-label">Código Asignatura</label>
                <input type="text" name="subject_code" id="subject_code" class="form-control" value="{{ old('subject_code') }}" required>
            </div>

            <div class="mb-3">
                <label for="id_program" class="form-label">Programa</label>
                <select name="id_program" id="id_program" class="form-control" required>
                    <option value="">Seleccione un programa</option>
                    @foreach($programs as $program)
                        <option value="{{ $program->id }}" {{ old('id_program') == $program->id ? 'selected' : '' }}>{{ $program->name_program }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="id_curriculum_semester" class="form-label">Número de semestre</label>
                <select name="id_curriculum_semester" id="id_curriculum_semester" class="form-control" required>
                    <option value="">Seleccione un semestre</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_area" class="form-label">Área</label>
                <select name="id_area" id="id_area" class="form-control" required>
                    <option value="">Seleccione un área</option>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ old('id_area') == $area->id ? 'selected' : '' }}>{{ $area->description_area }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-success">Registrar</button>
                <a href="{{ url('dashboard/subject') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const programSelect = document.getElementById('id_program');
            const semesterSelect = document.getElementById('id_curriculum_semester');

            const loadSemesters = (programId, selectedId = null) => {
                semesterSelect.innerHTML = '<option value="">Seleccione un semestre</option>';
                if (programId) {
                    fetch(`/api/programs/${programId}/curriculum-semesters`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(sem => {
                                const option = document.createElement('option');
                                option.value = sem.id;
                                option.text = sem.semester_number;
                                if (selectedId && selectedId == sem.id) option.selected = true;
                                semesterSelect.appendChild(option);
                            });
                        });
                }
            };

            // Cargar si se había seleccionado antes
            const oldProgram = '{{ old("id_program") }}';
            const oldSemester = '{{ old("id_curriculum_semester") }}';
            if (oldProgram) loadSemesters(oldProgram, oldSemester);

            programSelect.addEventListener('change', function () {
                loadSemesters(this.value);
            });
        });
    </script>
</x-app-layout>
