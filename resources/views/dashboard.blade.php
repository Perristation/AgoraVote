<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                AgoraVote
            </h2>
            <p class="text-sm text-gray-500">
                Sistema digital de votaciones para centros educativos
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">
                        Bienvenido/a a AgoraVote
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        AgoraVote es una plataforma web diseñada para gestionar votaciones digitales
                        dentro de centros educativos. El sistema permite controlar usuarios,
                        categorías, procesos de votación, participación y resultados de forma segura.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">
                        Votaciones
                    </h4>
                    <p class="text-sm text-gray-600 mb-4">
                        Consulta las votaciones activas y participa en aquellas en las que tengas autorización.
                    </p>
                    <a href="{{ route('votes.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        Ver votaciones
                    </a>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">
                        Verificar voto
                    </h4>
                    <p class="text-sm text-gray-600 mb-4">
                        Comprueba que tu participación ha sido registrada mediante el código de verificación recibido.
                    </p>
                    <a href="{{ route('votes.verify.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Verificar código
                    </a>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">
                        Resultados
                    </h4>
                    <p class="text-sm text-gray-600 mb-4">
                        Accede al listado de votaciones para consultar los resultados y la participación de cada proceso.
                    </p>
                    <a href="{{ route('admin.elections.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Ver resultados
                    </a>
                </div>

                @if (auth()->user()->hasRole('admin'))
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">
                            Administración
                        </h4>
                        <p class="text-sm text-gray-600 mb-4">
                            Gestiona usuarios, categorías, votaciones, opciones y permisos del sistema.
                        </p>
                        <a href="{{ route('admin.dashboard') }}"
                           class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                            Panel admin
                        </a>
                    </div>
                @endif

            </div>

            <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
                <h4 class="text-lg font-semibold text-gray-800 mb-4">
                    Estado inicial del sistema
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="border rounded-lg p-4">
                        <p class="text-sm text-gray-500">Usuarios</p>
                        <p class="text-2xl font-bold text-gray-800">Inicializado</p>
                    </div>

                    <div class="border rounded-lg p-4">
                        <p class="text-sm text-gray-500">Roles</p>
                        <p class="text-2xl font-bold text-gray-800">Creados</p>
                    </div>

                    <div class="border rounded-lg p-4">
                        <p class="text-sm text-gray-500">Categorías</p>
                        <p class="text-2xl font-bold text-gray-800">Creadas</p>
                    </div>

                    <div class="border rounded-lg p-4">
                        <p class="text-sm text-gray-500">Base de datos</p>
                        <p class="text-2xl font-bold text-gray-800">Activa</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>