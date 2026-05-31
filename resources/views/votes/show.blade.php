<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Emitir voto
            </h2>
            <p class="text-sm text-gray-500">
                Selección de opciones para la votación elegida
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-gray-800">
                    {{ $election->title }}
                </h3>

                <p class="text-gray-600 mt-2">
                    {{ $election->description ?? 'Sin descripción.' }}
                </p>

                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                        Activa
                    </span>

                    <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                        {{ $election->is_anonymous ? 'Votación anónima' : 'Votación no anónima' }}
                    </span>

                    <span class="px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-700">
                        Máximo de selecciones: {{ $election->max_selections }}
                    </span>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('votes.store', $election) }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">
                            Categoría con la que participas
                        </label>

                        <select name="category_id"
                                id="category_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            @foreach ($userCategories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-6">
                        @foreach ($election->sections as $section)
                            <div class="border rounded-lg p-5">
                                <h4 class="text-lg font-bold text-gray-800">
                                    {{ $section->title }}
                                </h4>

                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $section->description ?? 'Sin descripción.' }}
                                </p>

                                <p class="text-xs text-gray-500 mt-2">
                                    Máximo de selecciones en esta sección: {{ $section->max_selections }}
                                </p>

                                <div class="mt-4 space-y-3">
                                    @foreach ($section->options as $option)
                                        <label class="flex items-center gap-3 border rounded-lg p-4 cursor-pointer hover:bg-gray-50">
                                            @if ($election->max_selections > 1 || $section->max_selections > 1)
                                                <input type="checkbox"
                                                       name="options[]"
                                                       value="{{ $option->id }}"
                                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                            @else
                                                <input type="radio"
                                                       name="options[]"
                                                       value="{{ $option->id }}"
                                                       class="border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                       required>
                                            @endif

                                            <span class="text-gray-800">
                                                {{ $option->text }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        @error('options')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        @error('options.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a href="{{ route('votes.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            Confirmar voto
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>