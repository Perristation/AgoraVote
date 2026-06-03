<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Resultados en vivo
            </h2>
            <p class="text-sm text-gray-500">
                Resultados visibles para votantes autorizados
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-gray-800">
                    {{ $election->title }}
                </h3>

                <p class="text-gray-600 mt-2">
                    {{ $election->description ?? 'Sin descripción.' }}
                </p>

                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                        Resultados en vivo habilitados
                    </span>

                    <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                        Total de votos: {{ $totalVotes }}
                    </span>

                    <span class="px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-700">
                        Tipo: {{ $election->voting_type }}
                    </span>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">
                    Resultados por opción
                </h4>

                <div class="space-y-6">
                    @forelse ($results as $sectionResult)
                        <div class="border rounded-lg p-5">
                            <h5 class="text-md font-bold text-gray-800 mb-1">
                                {{ $sectionResult['section']->title }}
                            </h5>

                            <p class="text-sm text-gray-600 mb-4">
                                {{ $sectionResult['section']->description ?? 'Sin descripción.' }}
                            </p>

                            <div class="space-y-4">
                                @foreach ($sectionResult['options'] as $optionResult)
                                    <div>
                                        <div class="flex justify-between mb-1">
                                            <span class="font-medium text-gray-800">
                                                {{ $optionResult['option']->text }}
                                            </span>

                                            <span class="text-sm text-gray-600">
                                                {{ $optionResult['votes'] }} voto(s) · {{ $optionResult['percentage'] }}%
                                            </span>
                                        </div>

                                        <div class="w-full bg-gray-200 rounded-full h-3">
                                            <div class="bg-indigo-600 h-3 rounded-full"
                                                 style="width: {{ $optionResult['percentage'] }}%">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">
                            Esta votación no tiene secciones ni opciones configuradas.
                        </p>
                    @endforelse
                </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('votes.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Volver a votaciones
                </a>

                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    Volver al inicio
                </a>
            </div>

        </div>
    </div>
</x-app-layout>