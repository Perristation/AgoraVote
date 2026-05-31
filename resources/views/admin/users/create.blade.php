<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Nuevo usuario
            </h2>
            <p class="text-sm text-gray-500">
                Alta de usuario con rol y categorías dentro de AgoraVote
            </p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Nombre completo
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               required>

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Correo electrónico
                        </label>
                        <input type="email"
                               name="email"
                               id="email"
                               value="{{ old('email') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               required>

                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Contraseña inicial
                        </label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               required>

                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <p class="mt-1 text-sm text-gray-500">
                            La contraseña debe tener al menos 8 caracteres.
                        </p>
                    </div>

                    <div>
                        <p class="block text-sm font-medium text-gray-700 mb-2">
                            Rol del usuario
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            @foreach ($roles as $role)
                                <label class="flex items-start gap-3 border rounded-lg p-4 cursor-pointer hover:bg-gray-50">
                                    <input type="checkbox"
                                           name="roles[]"
                                           value="{{ $role->id }}"
                                           class="mt-1 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                           @checked(in_array($role->id, old('roles', [])))>

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ ucfirst($role->name) }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $role->description }}
                                        </p>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        @error('roles')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <p class="block text-sm font-medium text-gray-700 mb-2">
                            Categorías del usuario
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @foreach ($categories as $category)
                                <label class="flex items-start gap-3 border rounded-lg p-4 cursor-pointer hover:bg-gray-50">
                                    <input type="checkbox"
                                           name="categories[]"
                                           value="{{ $category->id }}"
                                           class="mt-1 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                           @checked(in_array($category->id, old('categories', [])))>

                                    <div>
                                        <p class="font-semibold text-gray-800">
                                            {{ $category->name }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $category->description }}
                                        </p>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        @error('categories')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            Guardar usuario
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>