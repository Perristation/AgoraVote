<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Votaciones disponibles
            </h2>
            <p class="text-sm text-gray-500">
                Procesos de votación activos en los que puedes participar
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-gray-800">
                    Mis votaciones
                </h3>
                <p class="text-gray-600 mt-1">
                    Aquí aparecen las votaciones activas asociadas a tus categorías de usuario.
                </p>
            </div>

            <div class="space-y-4">
                @forelse ($elections as $election)
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                            <div>
                                <h4 class="text-lg font-bold text-gray-800">
                                    {{ $election->title }}
                                </h4>

                                <p class="text-gray-600 mt-1">
                                    {{ $election->description ?? 'Sin descripción.' }}
                                </p>

                                <div class="mt-3 flex flex-wrap gap-2">
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        Activa
                                    </span>

                                    <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                        {{ $election->is_anonymous ? 'Anónima' : 'No anónima' }}
                                    </span>

                                    <span class="px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-700">
                                        Tipo: {{ $election->voting_type }}
                                    </span>
                                </div>
                            </div>

                            <a href="{{ route('votes.show', $election) }}"
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                Acceder
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white shadow-sm sm:rounded-lg p-10 text-center">
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">
                            No tienes votaciones disponibles
                        </h4>
                        <p class="text-gray-600">
                            Actualmente no existe ninguna votación activa asociada a tus categorías.
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Volver al inicio
                </a>
            </div>

        </div>
    </div>
</x-app-layout>