<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestión de votaciones
            </h2>
            <p class="text-sm text-gray-500">
                Listado de procesos de votación registrados en AgoraVote
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">
                            Votaciones
                        </h3>
                        <p class="text-gray-600 mt-1">
                            Desde esta sección se gestionan las votaciones creadas en el sistema.
                        </p>
                    </div>

                    <a href="{{ route('admin.elections.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        Nueva votación
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    @if ($elections->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Título
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Estado
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tipo
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Recuento
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Creada por
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($elections as $election)
                                        <tr>
                                            <td class="px-4 py-4">
                                                <a href="{{ route('admin.elections.show', $election) }}"
                                                 class="font-semibold text-indigo-700 hover:text-indigo-900">
                                                     {{ $election->title }}
                                                </a>
                                                <p class="text-sm text-gray-500">
                                                    {{ $election->description }}
                                                </p>
                                            </td>

                                            <td class="px-4 py-4">
                                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                                    {{ ucfirst($election->status) }}
                                                </span>
                                            </td>

                                            <td class="px-4 py-4 text-sm text-gray-700">
                                                {{ $election->voting_type }}
                                            </td>

                                            <td class="px-4 py-4 text-sm text-gray-700">
                                                {{ $election->show_realtime_results ? 'Tiempo real' : 'Final' }}
                                            </td>

                                            <td class="px-4 py-4 text-sm text-gray-700">
                                                {{ $election->creator?->name ?? 'Sin usuario' }}
                                            </td>

                                            <td class="px-4 py-4 text-sm text-gray-700">
                                                {{ $election->created_at->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-10">
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">
                                Todavía no hay votaciones creadas
                            </h4>
                            <p class="text-gray-600 mb-6">
                                Cuando se creen votaciones desde el panel de administración, aparecerán en este listado.
                            </p>
                            <a href="{{ route('admin.elections.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                Crear primera votación
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.dashboard') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Volver al panel admin
                </a>
            </div>

        </div>
    </div>
</x-app-layout>