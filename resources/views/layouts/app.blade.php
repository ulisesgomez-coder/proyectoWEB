<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>@yield('titulo', 'Inicio') | HuertiCUT</title>

    <link
        href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css"
        rel="stylesheet"
    >

    <style>
        .marca-huerticut {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .marca-icono {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: 50%;
            background-color: #166534;
            font-size: 22px;
        }

        .marca-nombre {
            color: #166534;
            font-family: Arial, sans-serif;
            font-size: 26px;
            font-weight: 800;
            white-space: nowrap;
        }

        .marca-cut {
            color: #0e7490;
        }

        .enlace-navegacion {
            display: block;
            padding: 8px 12px;
            border-radius: 6px;
            color: #334155;
            text-decoration: none;
        }

        .enlace-navegacion:hover {
            background-color: #f0fdf4;
            color: #166534;
            text-decoration: underline;
        }

        .enlace-navegacion.activo {
            color: #166534;
            font-weight: 700;
            text-decoration: underline;
            text-underline-offset: 5px;
        }

        .enlace-pie {
            color: #334155;
            text-decoration: none;
        }

        .enlace-pie:hover {
            color: #166534;
            text-decoration: underline;
        }

        a:focus-visible,
        button:focus-visible,
        .cuenta-admin summary:focus-visible {
            outline: 3px solid #0e7490;
            outline-offset: 4px;
        }

        .cuenta-admin {
            position: relative;
        }

        .cuenta-admin summary {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 10px;
            cursor: pointer;
            list-style: none;
            color: #0f172a;
            background: #f0fdf4;
        }

        .cuenta-admin summary::-webkit-details-marker {
            display: none;
        }

        .cuenta-avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #166534;
            color: #ffffff;
            font-size: 18px;
            font-weight: 700;
        }

        .cuenta-desplegable {
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            width: 280px;
            max-width: calc(100vw - 48px);
            z-index: 50;
            overflow: hidden;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .cuenta-datos {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
            overflow-wrap: anywhere;
        }

        .cuenta-opciones {
            padding: 8px;
        }

        .cuenta-opcion {
            display: block;
            width: 100%;
            padding: 10px 12px;
            border-radius: 6px;
            text-align: left;
            text-decoration: none;
            background: transparent;
            color: #334155;
            font: inherit;
            cursor: pointer;
            border: none;
        }

        .cuenta-opcion:hover {
            background: #f1f5f9;
        }

        .cuenta-salir {
            color: #991b1b;
            font-weight: 700;
        }

        .cuenta-salir:hover {
            background: #fef2f2;
        }

        @media (max-width: 767px) {
            .cuenta-desplegable {
                position: static;
                margin-top: 8px;
                width: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>

<body class="flex min-h-screen flex-col bg-gray-100">

    {{-- Encabezado y navegación --}}
    <header>
        <nav
            class="border-b border-gray-200 bg-white shadow-sm"
            aria-label="Navegación principal"
        >
            <div class="mx-auto flex max-w-screen-xl flex-wrap items-center justify-between p-4">

                <a
                    href="{{ route('principal') }}"
                    class="marca-huerticut"
                    aria-label="HuertiCUT, página principal"
                >
                    <span class="marca-icono" aria-hidden="true">
                        🌱
                    </span>

                    <span class="marca-nombre">
                        Huerti<span class="marca-cut">CUT</span>
                    </span>
                </a>

                {{-- Botón del menú para celulares --}}
                <button
                    data-collapse-toggle="menu-principal"
                    type="button"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 md:hidden"
                    aria-controls="menu-principal"
                    aria-expanded="false"
                >
                    <span class="sr-only">Abrir menú principal</span>

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

                <div
                    id="menu-principal"
                    class="hidden w-full md:block md:w-auto"
                >
                    <ul class="mt-4 flex flex-col gap-2 font-medium md:mt-0 md:flex-row md:items-center">

                        <li>
                            <a
                                href="{{ route('principal') }}"
                                class="enlace-navegacion {{ request()->routeIs('principal') ? 'activo' : '' }}"
                                @if (request()->routeIs('principal'))
                                    aria-current="page"
                                @endif
                            >
                                Principal
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('huertos') }}"
                                class="enlace-navegacion {{ request()->routeIs('huertos') ? 'activo' : '' }}"
                                @if (request()->routeIs('huertos'))
                                    aria-current="page"
                                @endif
                            >
                                Huertos
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('principal') }}#acerca-de"
                                class="enlace-navegacion"
                            >
                                Acerca de
                            </a>
                        </li>

                        <li>
                            <a
                                href="{{ route('principal') }}#contacto"
                                class="enlace-navegacion"
                            >
                                Contacto
                            </a>
                        </li>

                        {{-- Cuenta administrativa --}}
                        @auth('admin')
                            @php
                                $administradorActual = auth('admin')->user();

                                // Se usa explícitamente el administrador,
                                // incluso cuando estamos en páginas públicas.
                                $permisosAdmin = \Illuminate\Support\Facades\Gate::forUser(
                                    $administradorActual
                                );
                            @endphp

                            <li>
                                <details class="cuenta-admin">
                                    <summary>
                                        <span class="cuenta-avatar" aria-hidden="true">
                                            {{ mb_strtoupper(mb_substr($administradorActual->nombre_completo, 0, 1)) }}
                                        </span>

                                        <span>
                                            <span style="display: block; font-weight: 700;">
                                                Mi cuenta
                                            </span>

                                            <span style="display: block; font-size: 12px; color: #475569;">
                                                Nivel {{ $administradorActual->nivel }}
                                            </span>
                                        </span>

                                        <span aria-hidden="true">▾</span>
                                    </summary>

                                    <div class="cuenta-desplegable">

                                        <div class="cuenta-datos">
                                            <p style="margin: 0; font-weight: 700; color: #0f172a;">
                                                {{ $administradorActual->nombre_completo }}
                                            </p>

                                            <p style="margin: 4px 0 0; font-size: 14px; color: #475569;">
                                                Usuario: {{ $administradorActual->usuario }}
                                            </p>

                                            <p style="margin: 4px 0 0; font-size: 14px; color: #475569;">
                                                {{ $administradorActual->email }}
                                            </p>
                                        </div>

                                        <div class="cuenta-opciones">

                                            @if ($permisosAdmin->allows('consultar'))
                                                <a
                                                    href="{{ route('administracion') }}"
                                                    class="cuenta-opcion"
                                                >
                                                    Panel administrativo
                                                </a>

                                                <a
                                                    href="{{ route('admin.huertos.index') }}"
                                                    class="cuenta-opcion"
                                                >
                                                    Administrar huertos
                                                </a>

                                                <a
                                                    href="{{ route('admin.huertos.papelera') }}"
                                                    class="cuenta-opcion"
                                                >
                                                    Papelera de huertos
                                                </a>
                                            @endif

                                            @if ($permisosAdmin->allows('crear'))
                                                <a
                                                    href="{{ route('admin.huertos.nuevo') }}"
                                                    class="cuenta-opcion"
                                                >
                                                    Nuevo huerto
                                                </a>
                                            @endif

                                            {{-- Disponible aunque la cuenta pierda permisos --}}
                                            <form
                                                action="{{ route('admin.logout') }}"
                                                method="POST"
                                                style="margin: 8px 0 0; border-top: 1px solid #e2e8f0; padding-top: 8px;"
                                            >
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="cuenta-opcion cuenta-salir"
                                                >
                                                    Cerrar sesión
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </details>
                            </li>
                        @endauth

                        {{-- Acceso para visitantes sin sesión administrativa --}}
                        @guest('admin')
                            <li>
                                <a
                                    href="{{ route('admin.login') }}"
                                    class="enlace-navegacion {{ request()->routeIs('admin.login') ? 'activo' : '' }}"
                                    @if (request()->routeIs('admin.login'))
                                        aria-current="page"
                                    @endif
                                >
                                    Acceso administrativo
                                </a>
                            </li>
                        @endguest

                    </ul>
                </div>

            </div>
        </nav>
    </header>

    {{-- Contenido de cada página --}}
    <main class="mx-auto w-full max-w-screen-xl flex-grow px-6 py-10">
        @yield('content')
    </main>

    {{-- Pie de página --}}
    <footer class="mt-auto border-t border-gray-200 bg-white shadow-sm">
        <div class="mx-auto w-full max-w-screen-xl p-6">

            <div class="md:flex md:items-center md:justify-between">

                <div class="mb-6 md:mb-0">
                    <a
                        href="{{ route('principal') }}"
                        class="marca-huerticut"
                        aria-label="HuertiCUT, página principal"
                    >
                        <span class="marca-icono" aria-hidden="true">
                            🌱
                        </span>

                        <span class="marca-nombre">
                            Huerti<span class="marca-cut">CUT</span>
                        </span>
                    </a>

                    <p class="mt-3 max-w-md text-sm text-gray-600">
                        Plataforma para la gestión de huertos urbanos
                        compartidos y distribución de cosechas.
                    </p>
                </div>

                <ul class="flex flex-wrap items-center gap-6 text-sm font-medium">
                    <li>
                        <a
                            href="{{ route('principal') }}"
                            class="enlace-pie"
                        >
                            Principal
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('huertos') }}"
                            class="enlace-pie"
                        >
                            Huertos
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('principal') }}#acerca-de"
                            class="enlace-pie"
                        >
                            Acerca de
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ route('principal') }}#contacto"
                            class="enlace-pie"
                        >
                            Contacto
                        </a>
                    </li>
                </ul>

            </div>

            <hr class="my-6 border-gray-200">

            <p class="text-center text-sm text-gray-600">
                © {{ date('Y') }}

                <a
                    href="{{ route('principal') }}"
                    style="color: #166534; font-weight: 700;"
                >
                    HuertiCUT
                </a>.

                Todos los derechos reservados.
            </p>

        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>

</body>
</html>