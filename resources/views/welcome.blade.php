<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AgoraVote</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen flex flex-col items-center justify-center px-6">
        <div class="max-w-3xl w-full bg-white shadow-sm rounded-2xl p-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">
                AgoraVote
            </h1>

            <p class="text-lg text-gray-600 mb-6">
                Sistema digital de votaciones para centros educativos.
            </p>

            <p class="text-gray-600 mb-8">
                Plataforma web orientada a gestionar usuarios, categorías, votaciones,
                participación, verificación y resultados de forma segura y organizada.
            </p>

            <div class="flex justify-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="px-5 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700">
                        Entrar al panel
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="px-5 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700">
                        Iniciar sesión
                    </a>
                @endauth
            </div>
        </div>

        <p class="mt-6 text-sm text-gray-500">
            Proyecto final · 2º Desarrollo de Aplicaciones Web · IES Joan Coromines
        </p>
    </div>
</body>
</html>