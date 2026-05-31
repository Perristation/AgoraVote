<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Resultado de verificación
            </h2>
            <p class="text-sm text-gray-500">
                Estado del código de verificación consultado
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-8 text-center">
                <div class="mb-6">
                    <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-800 text-sm font-semibold">
                        Voto registrado correctamente
                    </span>
                </div>

                <h3 class="text-2xl font-bold text-gray-800 mb-3">
                    El código de verificación es válido
                </h3>

                <p class="text-gray-600 mb-6">
                    El sistema ha encontrado una participación registrada con el código introducido.
                </p>

                <div class="bg-gray-100 border rounded-lg p-6 mb-6">
                    <p class="text-sm text-gray-500 mb-2">
                        Código consultado
                    </p>

                    <p class="text-3xl font-bold tracking-widest text-gray-900">
                        {{ $participation->verification_code }}
                    </p>
                </div>

                <div class="text-left bg-gray-50 rounded-lg p-4 mb-6">
                    <p class="text-sm text-gray-700">
                        <strong>Votación:</strong> {{ $participation->election->title }}
                    </p>

                    <p class="text-sm text-gray-700">
                        <strong>Categoría:</strong> {{ $participation->category->name }}
                    </p>

                    <p class="text-sm text-gray-700">
                        <strong>Fecha de emisión:</strong> {{ $participation->voted_at }}
                    </p>

                    <p class="text-sm text-gray-700">
                        <strong>Estado:</strong> Registrado
                    </p>
                </div>

                <div class="flex flex-wrap justify-center gap-3">
                    <a href="{{ route('votes.verify.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                        Verificar otro código
                    </a>

                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Volver al inicio
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>