<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Profesor') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teacher.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block font-medium text-sm text-gray-700">Nombre</label>
                <input type="text" name="name" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('name') }}" required>
            </div>

            <div>
                <label for="last_name" class="block font-medium text-sm text-gray-700">Apellido</label>
                <input type="text" name="last_name" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('last_name') }}" required>
            </div>

            <div>
                <label for="document_type" class="block font-medium text-sm text-gray-700">Tipo de Documento</label>
                <select name="document_type" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                    <option value="">Selecciona un tipo de documento</option>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="CE">Cédula de Extranjería</option>
                    <option value="PS">Pasaporte</option>
                    <option value="RC">Registro Civil</option>
                </select>
            </div>

            <div>
                <label for="id_number" class="block font-medium text-sm text-gray-700">Número de Identificación</label>
                <input type="text" name="id_number" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('id_number') }}" required>
            </div>

            <div>
                <label for="personal_email" class="block font-medium text-sm text-gray-700">Correo Personal</label>
                <input type="email" name="personal_email" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('personal_email') }}" required>
                @error('personal_email')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div>
                <label for="institutional_email" class="block font-medium text-sm text-gray-700">Correo Institucional</label>
                <input type="email" name="institutional_email" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('institutional_email') }}" required>
            </div>

            <div>
                <label for="adress" class="block font-medium text-sm text-gray-700">Dirección</label>
                <input type="text" name="adress" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('adress') }}" required>
            </div>

            <div>
                <label for="phone_number" class="block font-medium text-sm text-gray-700">Teléfono</label>
                <input type="text" name="phone_number" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('phone_number') }}" required>
            </div>

            <div>
                <label for="number_mobile" class="block font-medium text-sm text-gray-700">Móvil</label>
                <input type="text" name="number_mobile" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('number_mobile') }}" required>
            </div>

            <div>
                <label for="diplom" class="block font-medium text-sm text-gray-700">¿Tiene Diplomado?</label>
                <select name="diplom" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                    <option value="1" {{ old('diplom') == '1' ? 'selected' : '' }}>Sí</option>
                    <option value="0" {{ old('diplom') == '0' ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div>
                <label for="id_vinculation_type" class="block font-medium text-sm text-gray-700">Tipo de Vinculación</label>
                <select name="id_vinculation_type" class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                    @foreach($TypeVinculation as $type)
                        <option value="{{ $type->id }}" {{ old('id_vinculation_type') == $type->id ? 'selected' : '' }}>
                            {{ $type->description }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</x-app-layout>
