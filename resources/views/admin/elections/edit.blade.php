<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar votación
            </h2>
            <p class="text-sm text-gray-500">
                Modificación de los datos principales de la votación
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.elections.update', $election) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">
                            Título de la votación
                        </label>
                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ old('title', $election->title) }}"
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
                                  rows="4"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $election->description) }}</textarea>

                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_at" class="block text-sm font-medium text-gray-700">
                                Fecha de inicio
                            </label>
                            <input type="datetime-local"
                                   name="start_at"
                                   id="start_at"
                                   value="{{ old('start_at', $election->start_at ? \Carbon\Carbon::parse($election->start_at)->format('Y-m-d\TH:i') : '') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                            @error('start_at')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_at" class="block text-sm font-medium text-gray-700">
                                Fecha de finalización
                            </label>
                            <input type="datetime-local"
                                   name="end_at"
                                   id="end_at"
                                   value="{{ old('end_at', $election->end_at ? \Carbon\Carbon::parse($election->end_at)->format('Y-m-d\TH:i') : '') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">

                            @error('end_at')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">
                                Estado
                            </label>
                            <select name="status"
                                    id="status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                <option value="draft" @selected(old('status', $election->status) === 'draft')>Borrador</option>
                                <option value="active" @selected(old('status', $election->status) === 'active')>Activa</option>
                                <option value="closed" @selected(old('status', $election->status) === 'closed')>Cerrada</option>
                                <option value="archived" @selected(old('status', $election->status) === 'archived')>Archivada</option>
                            </select>

                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="voting_type" class="block text-sm font-medium text-gray-700">
                                Tipo de votación
                            </label>
                            <select name="voting_type"
                                    id="voting_type"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                <option value="single" @selected(old('voting_type', $election->voting_type) === 'single')>
                                    Varias opciones: una selección
                                </option>
                                <option value="multiple" @selected(old('voting_type', $election->voting_type) === 'multiple')>
                                    Varias opciones: varias selecciones
                                </option>
                                <option value="category_single" @selected(old('voting_type', $election->voting_type) === 'category_single')>
                                    Varias categorías: una selección por categoría
                                </option>
                                <option value="category_multiple" @selected(old('voting_type', $election->voting_type) === 'category_multiple')>
                                    Varias categorías: varias selecciones por categoría
                                </option>
                            </select>

                            @error('voting_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="max_selections" class="block text-sm font-medium text-gray-700">
                            Número máximo de selecciones
                        </label>
                        <input type="number"
                               name="max_selections"
                               id="max_selections"
                               min="1"
                               value="{{ old('max_selections', $election->max_selections) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               required>

                        @error('max_selections')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="is_anonymous" class="block text-sm font-medium text-gray-700">
                                Tipo de anonimato
                            </label>
                            <select name="is_anonymous"
                                    id="is_anonymous"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                <option value="1" @selected(old('is_anonymous', (string) (int) $election->is_anonymous) == '1')>Anónima</option>
                                <option value="0" @selected(old('is_anonymous', (string) (int) $election->is_anonymous) == '0')>No anónima</option>
                            </select>

                            @error('is_anonymous')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="show_realtime_results" class="block text-sm font-medium text-gray-700">
                                Recuento
                            </label>
                            <select name="show_realtime_results"
                                    id="show_realtime_results"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                <option value="0" @selected(old('show_realtime_results', (string) (int) $election->show_realtime_results) == '0')>
                                    Mostrar al finalizar
                                </option>
                                <option value="1" @selected(old('show_realtime_results', (string) (int) $election->show_realtime_results) == '1')>
                                    Mostrar en tiempo real
                                </option>
                            </select>

                            @error('show_realtime_results')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <p class="block text-sm font-medium text-gray-700 mb-2">
                            Categorías autorizadas
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($categories as $category)
                                <label class="flex items-start gap-3 border rounded-lg p-4 cursor-pointer hover:bg-gray-50">
                                    <input type="checkbox"
                                           name="categories[]"
                                           value="{{ $category->id }}"
                                           class="mt-1 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                           @checked(in_array($category->id, old('categories', $election->categories->pluck('id')->toArray())))>

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $category->name }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $category->description }}
                                        </p>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        @error('categories')
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
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>