<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detalle de votación
            </h2>
            <p class="text-sm text-gray-500">
                Configuración y opciones de la votación seleccionada
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">
                            {{ $election->title }}
                        </h3>

                        <p class="text-gray-600 mt-2">
                            {{ $election->description ?? 'Sin descripción.' }}
                        </p>

                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                Estado: {{ ucfirst($election->status) }}
                            </span>

                            <span class="px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-700">
                                Tipo: {{ $election->voting_type }}
                            </span>

                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                {{ $election->is_anonymous ? 'Anónima' : 'No anónima' }}
                            </span>

                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                {{ $election->show_realtime_results ? 'Recuento en tiempo real' : 'Recuento final' }}
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.elections.sections.create', $election) }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            Añadir sección/opciones
                        </a>

                        <a href="{{ route('admin.results.show', $election) }}"
                        class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                            Ver resultados
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">
                    Categorías autorizadas
                </h4>

                <div class="flex flex-wrap gap-2">
                    @forelse ($election->categories as $category)
                        <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-700">
                            {{ $category->name }}
                        </span>
                    @empty
                        <p class="text-gray-500">
                            No hay categorías asignadas.
                        </p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">
                    Secciones y opciones de voto
                </h4>

                <div class="space-y-6">
                    @forelse ($election->sections as $section)
                        <div class="border rounded-lg p-5">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3">
                                <div>
                                    <h5 class="text-md font-bold text-gray-800">
                                        {{ $section->title }}
                                    </h5>

                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $section->description ?? 'Sin descripción.' }}
                                    </p>

                                    <p class="text-xs text-gray-500 mt-2">
                                        Máximo de selecciones: {{ $section->max_selections }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <p class="text-sm font-semibold text-gray-700 mb-2">
                                    Opciones:
                                </p>

                                <ul class="list-disc list-inside space-y-1 text-gray-700">
                                    @foreach ($section->options as $option)
                                        <li>{{ $option->text }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10">
                            <h5 class="text-lg font-semibold text-gray-800 mb-2">
                                Esta votación todavía no tiene secciones ni opciones
                            </h5>
                            <p class="text-gray-600 mb-6">
                                Añade una sección para definir las opciones o candidatos que podrán votar los usuarios.
                            </p>

                            <a href="{{ route('admin.elections.sections.create', $election) }}"
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                Añadir primera sección
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.elections.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Volver al listado
                </a>
            </div>

        </div>
    </div>
</x-app-layout>