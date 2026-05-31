<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Verificar voto
            </h2>
            <p class="text-sm text-gray-500">
                Comprobación de participación mediante código de verificación
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-3">
                    Introduce tu código de verificación
                </h3>

                <p class="text-gray-600 mb-6">
                    Después de emitir un voto, AgoraVote genera un código único. Este código permite comprobar que la participación ha quedado registrada correctamente en el sistema.
                </p>

                <form method="POST" action="{{ route('votes.verify.check') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="verification_code" class="block text-sm font-medium text-gray-700">
                            Código de verificación
                        </label>

                        <input type="text"
                               name="verification_code"
                               id="verification_code"
                               value="{{ old('verification_code') }}"
                               placeholder="Ejemplo: A1B2C3D4E5F6"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 uppercase"
                               required>

                        @error('verification_code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Volver al inicio
                        </a>

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            Verificar
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>