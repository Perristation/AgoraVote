<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Añadir sección y opciones
            </h2>
            <p class="text-sm text-gray-500">
                Configuración de opciones para la votación: {{ $election->title }}
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.elections.sections.store', $election) }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            Título de la sección
                        </label>
                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ old('title') }}"
                               placeholder="Ejemplo: Representantes del alumnado"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               required>

                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">
                            Descripción
                        </label>
                        <textarea name="description"
                                  id="description"
                                  rows="3"
                                  placeholder="Ejemplo: Selección de representantes para el consejo escolar."
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="max_selections" class="block text-sm font-medium text-gray-700">
                            Número máximo de selecciones
                        </label>
                        <input type="number"
                               name="max_selections"
                               id="max_selections"
                               min="1"
                               value="{{ old('max_selections', 1) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               required>

                        @error('max_selections')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <p class="block text-sm font-medium text-gray-700 mb-2">
                            Opciones de voto
                        </p>

                        <p class="text-sm text-gray-500 mb-4">
                            Introduce al menos dos opciones. Pueden ser candidatos, respuestas o alternativas de votación.
                        </p>

                        <div class="space-y-3">
                            <input type="text"
                                   name="options[]"
                                   value="{{ old('options.0') }}"
                                   placeholder="Opción 1"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   required>

                            <input type="text"
                                   name="options[]"
                                   value="{{ old('options.1') }}"
                                   placeholder="Opción 2"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                   required>

                            <input type="text"
                                   name="options[]"
                                   value="{{ old('options.2') }}"
                                   placeholder="Opción 3"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                            <input type="text"
                                   name="options[]"
                                   value="{{ old('options.3') }}"
                                   placeholder="Opción 4"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        @error('options')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        @error('options.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a href="{{ route('admin.elections.show', $election) }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            Guardar sección
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>