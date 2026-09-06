<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>@yield('titulo', 'Huertos Urbanos')</title>

    <!-- Estilos de Flowbite -->
    <link
        href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css"
        rel="stylesheet"
    >
</head>

<body class="flex min-h-screen flex-col bg-gray-100">

    <!-- Encabezado y menú de navegación -->
    <header>
        <nav class="border-b border-gray-200 bg-white shadow-sm">
            <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between p-4">

                <!-- Logotipo y nombre -->
                <a
                    href="{{ route('principal') }}"
                    class="flex items-center space-x-3 rtl:space-x-reverse"
                >
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-green-700 text-xl text-white">
                        🌱
                    </div>

                    <span class="self-center whitespace-nowrap text-2xl font-bold text-green-700">
                        Huertos Urbanos
                    </span>
                </a>

                <!-- Botón del menú móvil -->
                <button
                    data-collapse-toggle="menu-principal"
                    type="button"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 md:hidden"
                    aria-controls="menu-principal"
                    aria-expanded="false"
                >
                    <span class="sr-only">
                        Abrir menú principal
                    </span>

                    <svg
                        class="h-5 w-5"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 17 14"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15"
                        />
                    </svg>
                </button>

                <!-- Enlaces del menú -->
                <div
                    id="menu-principal"
                    class="hidden w-full md:block md:w-auto"
                >
                    <ul class="mt-4 flex flex-col rounded-lg border border-gray-100 bg-gray-50 p-4 font-medium md:mt-0 md:flex-row md:space-x-8 md:border-0 md:bg-white md:p-0 rtl:space-x-reverse">

                        <!-- Principal -->
                        <li>
                            <a
                                href="{{ route('principal') }}"
                                class="{{ request()->routeIs('principal')
                                    ? 'block rounded bg-green-700 px-3 py-2 text-white md:bg-transparent md:p-0 md:text-green-700'
                                    : 'block rounded px-3 py-2 text-gray-900 hover:bg-gray-100 md:border-0 md:p-0 md:hover:bg-transparent md:hover:text-green-700' }}"
                            >
                                Principal
                            </a>
                        </li>

                        <!-- Huertos -->
                        <li>
                            <a
                                href="{{ route('huertos') }}"
                                class="{{ request()->routeIs('huertos')
                                    ? 'block rounded bg-green-700 px-3 py-2 text-white md:bg-transparent md:p-0 md:text-green-700'
                                    : 'block rounded px-3 py-2 text-gray-900 hover:bg-gray-100 md:border-0 md:p-0 md:hover:bg-transparent md:hover:text-green-700' }}"
                            >
                                Huertos
                            </a>
                        </li>

                        <!-- Acerca de -->
                        <li>
                            <a
                                href="{{ route('principal') }}#acerca-de"
                                class="block rounded px-3 py-2 text-gray-900 hover:bg-gray-100 md:border-0 md:p-0 md:hover:bg-transparent md:hover:text-green-700"
                            >
                                Acerca de
                            </a>
                        </li>

                        <!-- Contacto -->
                        <li>
                            <a
                                href="{{ route('principal') }}#contacto"
                                class="block rounded px-3 py-2 text-gray-900 hover:bg-gray-100 md:border-0 md:p-0 md:hover:bg-transparent md:hover:text-green-700"
                            >
                                Contacto
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenido de cada página -->
    <main class="mx-auto w-full max-w-screen-xl flex-grow px-6 py-10">
        @yield('content')
    </main>

    <!-- Pie de página -->
    <footer class="mt-auto border-t border-gray-200 bg-white shadow-sm">
        <div class="mx-auto w-full max-w-screen-xl p-6">

            <div class="md:flex md:items-center md:justify-between">

                <!-- Información del proyecto -->
                <div class="mb-6 md:mb-0">
                    <a
                        href="{{ route('principal') }}"
                        class="flex items-center"
                    >
                        <div class="me-3 flex h-9 w-9 items-center justify-center rounded-full bg-green-700 text-lg text-white">
                            🌱
                        </div>

                        <span class="self-center whitespace-nowrap text-2xl font-semibold text-green-700">
                            Huertos Urbanos
                        </span>
                    </a>

                    <p class="mt-3 max-w-md text-sm text-gray-600">
                        Plataforma para la gestión de huertos urbanos
                        compartidos y distribución de cosechas.
                    </p>
                </div>

                <!-- Enlaces del pie de página -->
                <ul class="flex flex-wrap items-center text-sm font-medium text-gray-600">
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
                            href="{{ route('principal') }}#acerca-de"
                            class="me-4 hover:text-green-700 hover:underline md:me-6"
                        >
                            Acerca de
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('principal') }}#contacto"
                            class="hover:text-green-700 hover:underline"
                        >
                            Contacto
                        </a>
                    </li>
                </ul>
            </div>

            <hr class="my-6 border-gray-200">

            <!-- Derechos reservados -->
            <div class="text-center">
                <span class="text-sm text-gray-600">
                    © {{ date('Y') }}

                    <a
                        href="{{ route('principal') }}"
                        class="font-semibold text-green-700 hover:underline"
                    >
                        Huertos Urbanos
                    </a>.

                    Todos los derechos reservados.
                </span>
            </div>
        </div>
    </footer>

    <!-- JavaScript de Flowbite -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>
</html>