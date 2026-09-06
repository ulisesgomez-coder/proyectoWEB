@extends('layouts.app')

@section('titulo', 'Administración de huertos')

@section('content')

    <section class="py-10">

        <!-- Encabezado -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">
                    Huertos registrados
                </h1>

                <p class="mt-2 text-slate-600">
                    Lista simulada de los huertos urbanos del sistema.
                </p>
            </div>

            <a
                href="{{ route('admin.huertos.nuevo') }}"
                class="inline-flex items-center justify-center rounded-lg bg-green-800 px-5 py-3 font-semibold text-white hover:bg-green-900 focus:outline-none focus:ring-4 focus:ring-yellow-300"
            >
                + Nuevo huerto
            </a>
        </div>

        <!-- Tabla -->
        <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-sm">
            <table class="w-full text-left text-sm text-slate-700">

                <thead class="bg-slate-900 text-xs uppercase text-white">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Nombre</th>
                        <th class="px-6 py-4">Ciudad</th>
                        <th class="px-6 py-4">Responsable</th>
                        <th class="px-6 py-4">Estado</th>
                        <th class="px-6 py-4 text-center">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="border-b border-slate-200 hover:bg-slate-50">
                        <td class="px-6 py-4">1</td>
                        <td class="px-6 py-4 font-semibold text-slate-900">
                            Huerto Las Flores
                        </td>
                        <td class="px-6 py-4">Guadalajara</td>
                        <td class="px-6 py-4">María López</td>
                        <td class="px-6 py-4">
                            <span class="rounded-full bg-green-100 px-3 py-1 font-semibold text-green-900">
                                Activo
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap justify-center gap-2">
                                <button
                                    type="button"
                                    class="rounded-lg bg-blue-800 px-3 py-2 text-white hover:bg-blue-900"
                                >
                                    Consultar
                                </button>

                                <a
                                    href="{{ route('admin.huertos.editar', 1) }}"
                                    class="rounded-lg bg-amber-500 px-3 py-2 font-semibold text-slate-950 hover:bg-amber-600"
                                >
                                    Editar
                                </a>

                                <button
                                    type="button"
                                    class="rounded-lg bg-red-700 px-3 py-2 text-white hover:bg-red-800"
                                >
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="border-b border-slate-200 hover:bg-slate-50">
                        <td class="px-6 py-4">2</td>
                        <td class="px-6 py-4 font-semibold text-slate-900">
                            Huerto Comunitario Norte
                        </td>
                        <td class="px-6 py-4">Zapopan</td>
                        <td class="px-6 py-4">Carlos Ramírez</td>
                        <td class="px-6 py-4">
                            <span class="rounded-full bg-slate-200 px-3 py-1 font-semibold text-slate-800">
                                Inactivo
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap justify-center gap-2">
                                <button
                                    type="button"
                                    class="rounded-lg bg-blue-800 px-3 py-2 text-white hover:bg-blue-900"
                                >
                                    Consultar
                                </button>

                                <a
                                    href="{{ route('admin.huertos.editar', 2) }}"
                                    class="rounded-lg bg-amber-500 px-3 py-2 font-semibold text-slate-950 hover:bg-amber-600"
                                >
                                    Editar
                                </a>

                                <button
                                    type="button"
                                    class="rounded-lg bg-red-700 px-3 py-2 text-white hover:bg-red-800"
                                >
                                    Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </section>

@endsection