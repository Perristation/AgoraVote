<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Panel de administración
            </h2>
            <p class="text-sm text-gray-500">
                Gestión general del sistema AgoraVote
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">
                    Administración de AgoraVote
                </h3>

                <p class="text-gray-600">
                    Desde este panel se gestionarán los usuarios, roles, categorías,
                    votaciones, opciones y resultados de la plataforma.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('admin.users.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Gestionar usuarios
                    </a>

                    <a href="{{ route('admin.elections.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        Gestionar votaciones
                    </a>

                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Volver al inicio
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Usuarios registrados</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $usersCount }}
                    </p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Roles del sistema</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $roles->count() }}
                    </p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Categorías electorales</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">
                        {{ $categories->count() }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">
                        Roles disponibles
                    </h4>

                    <div class="space-y-3">
                        @forelse ($roles as $role)
                            <div class="border rounded-lg p-4">
                                <p class="font-semibold text-gray-800">
                                    {{ ucfirst($role->name) }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{ $role->description }}
                                </p>
                            </div>
                        @empty
                            <p class="text-gray-500">
                                No hay roles registrados.
                            </p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">
                        Categorías disponibles
                    </h4>

                    <div class="space-y-3">
                        @forelse ($categories as $category)
                            <div class="border rounded-lg p-4">
                                <p class="font-semibold text-gray-800">
                                    {{ $category->name }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    {{ $category->description }}
                                </p>
                            </div>
                        @empty
                            <p class="text-gray-500">
                                No hay categorías registradas.
                            </p>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>