<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Voto registrado
            </h2>
            <p class="text-sm text-gray-500">
                Confirmación de participación en AgoraVote
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-8 text-center">
                <h3 class="text-2xl font-bold text-gray-800 mb-3">
                    Tu voto se ha registrado correctamente
                </h3>

                <p class="text-gray-600 mb-6">
                    Guarda el siguiente código de verificación. Este código permite comprobar que tu participación ha sido registrada en el sistema.
                </p>

                <div class="bg-gray-100 border rounded-lg p-6 mb-6">
                    <p class="text-sm text-gray-500 mb-2">
                        Código de verificación
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
                        <strong>Fecha:</strong> {{ $participation->voted_at }}
                    </p>
                </div>

                <a href="{{ route('votes.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                    Volver a mis votaciones
                </a>
            </div>

        </div>
    </div>
</x-app-layout>