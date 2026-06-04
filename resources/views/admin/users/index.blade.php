<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Gestión de usuarios
            </h2>
            <p class="text-sm text-gray-500">
                Listado de usuarios registrados en AgoraVote
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

            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">
                            Usuarios
                        </h3>
                        <p class="text-gray-600 mt-1">
                            Desde esta sección se gestionan los usuarios, roles y categorías asignadas.
                        </p>
                    </div>

                    <a href="{{ route('admin.users.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        Nuevo usuario
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">
                    @if ($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            DNI
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Roles
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Categorías
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha alta
                                        </th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="px-4 py-4">
                                                <p class="font-semibold text-gray-800">
                                                    {{ $user->name }}
                                                </p>
                                            </td>

                                            <td class="px-4 py-4 text-sm text-gray-700">
                                                {{ $user->dni ?? 'Sin DNI' }}
                                            </td>

                                            <td class="px-4 py-4 text-sm text-gray-700">
                                                {{ $user->email }}
                                            </td>

                                            <td class="px-4 py-4">
                                                <div class="flex flex-wrap gap-2">
                                                    @forelse ($user->roles as $role)
                                                        <span class="px-2 py-1 text-xs rounded-full bg-indigo-100 text-indigo-700">
                                                            {{ $role->name }}
                                                        </span>
                                                    @empty
                                                        <span class="text-sm text-gray-500">
                                                            Sin rol
                                                        </span>
                                                    @endforelse
                                                </div>
                                            </td>

                                            <td class="px-4 py-4">
                                                <div class="flex flex-wrap gap-2">
                                                    @forelse ($user->categories as $category)
                                                        <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                                            {{ $category->name }}
                                                        </span>
                                                    @empty
                                                        <span class="text-sm text-gray-500">
                                                            Sin categoría
                                                        </span>
                                                    @endforelse
                                                </div>
                                            </td>

                                            <td class="px-4 py-4 text-sm text-gray-700">
                                                {{ $user->created_at->format('d/m/Y') }}
                                            </td>

                                            <td class="px-4 py-4 text-sm text-gray-700">
                                                <div class="flex flex-wrap gap-2">
                                                    <a href="{{ route('admin.users.edit', $user) }}"
                                                        class="inline-flex items-center px-3 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                                             Editar
                                                    </a>

                                                    @if ($user->id !== auth()->id())
                                                        <form method="POST"
                                                        action="{{ route('admin.users.destroy', $user) }}"
                                                        onsubmit="return confirm('¿Seguro que quieres eliminar este usuario? Esta acción no se puede deshacer.');">
                                                    @csrf
                                                    @method('DELETE')

                                                        <button type="submit"
                                                        class="inline-flex items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                                            Eliminar
                                                        </button>
                                                        </form>
                                                    @else
                                                        <span class="inline-flex items-center px-3 py-2 bg-gray-200 rounded-md font-semibold text-xs text-gray-600 uppercase tracking-widest">
                                                            Usuario actual
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-10">
                            <h4 class="text-lg font-semibold text-gray-800 mb-2">
                                Todavía no hay usuarios registrados
                            </h4>
                            <p class="text-gray-600 mb-6">
                                Crea usuarios para asignarles roles y categorías de votación.
                            </p>
                            <a href="{{ route('admin.users.create') }}"
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                Crear primer usuario
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