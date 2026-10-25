<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>@yield('titulo', 'Huertos Urbanos')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-gray-100">

    <!-- Encabezado -->
    <nav class="border-gray-200 bg-white shadow">
        <div class="mx-auto flex max-w-screen-xl items-center justify-between p-4">
            <a
                href="{{ route('principal') }}"
                class="text-2xl font-bold text-green-700"
            >
                Huertos Urbanos
            </a>

            <div class="flex gap-6">
                <a
                    href="{{ route('principal') }}"
                    class="text-gray-700 hover:text-green-700"
                >
                    Principal
                </a>

                <a
                    href="{{ route('huertos') }}"
                    class="text-gray-700 hover:text-green-700"
                >
                    Huertos
                </a>
            </div>
        </div>
    </nav>

    <!--Contenido (carrusel) -->
    <main class="mx-auto min-h-screen max-w-screen-xl p-6">
        @yield('content')
    </main>

    
    
<!-- Pie de página -->
<footer class="m-4 rounded-lg border border-gray-200 bg-white shadow-sm">
    <div class="mx-auto w-full max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
        <span class="text-sm text-gray-600 sm:text-center">
            © {{ date('Y') }}

            <a
                href="{{ route('principal') }}"
                class="font-semibold text-green-700 hover:underline"
            >
                Huertos Urbanos
            </a>.

            Todos los derechos reservados.
        </span>

        <ul class="mt-3 flex flex-wrap items-center text-sm font-medium text-gray-600 sm:mt-0">
            <li>
                <a
                    href="{{ route('principal') }}"
                    class="me-4 hover:text-green-700 hover:underline md:me-6"
                >
                    Principal
                </a>
            </li>

            <li>
                <a
                    href="{{ route('huertos') }}"
                    class="me-4 hover:text-green-700 hover:underline md:me-6"
                >
                    Huertos
                </a>
            </li>

            <li>
                <a
                    href="#acerca-de"
                    class="me-4 hover:text-green-700 hover:underline md:me-6"
                >
                    Acerca de
                </a>
            </li>

            <li>
                <a
                    href="#contacto"
                    class="hover:text-green-700 hover:underline"
                >
                    Contacto
                </a>
            </li>
        </ul>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>
</html>