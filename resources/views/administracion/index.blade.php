@extends('layouts.app')

@section('titulo', 'Administración')

@section('content')

@session('exito')
    <div
        role="status"
        style="
            margin-bottom: 20px;
            padding: 12px;
            border-radius: 8px;
            background-color: #f0fdf4;
            color: #14532d;
        "
    >
        {{ $value }}
    </div>
@endsession

    <section class="py-10">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">
                Panel administrativo
            </h1>

            <p class="mt-2 text-slate-600">
                Selecciona un módulo para consultar o capturar información.
            </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            <!-- Módulo de usuarios -->
            <a
                href="#"
                class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm hover:border-green-700 hover:shadow-md"
            >
                <div class="text-4xl">👥</div>

                <h2 class="mt-4 text-xl font-bold text-slate-900">
                    Usuarios
                </h2>

                <p class="mt-2 text-slate-600">
                    Consulta y registra usuarios del sistema.
                </p>

                <span class="mt-4 inline-block rounded-full bg-amber-100 px-3 py-1 text-sm font-semibold text-amber-900">
                    Próximamente
                </span>
            </a>

            <!-- Módulo de huertos -->
            <a
                href="{{ route('admin.huertos.index') }}"
                class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm hover:border-green-700 hover:shadow-md"
            >
                <div class="text-4xl">🌱</div>

                <h2 class="mt-4 text-xl font-bold text-slate-900">
                    Huertos
                </h2>

                <p class="mt-2 text-slate-600">
                    @can('crear')
                        Consulta, registra y administra huertos urbanos.
                    @else
                        Consulta la informacion de los huertos urbanos.
                    @endcan
                </p>

                <span class="mt-4 inline-block rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-900">
                    Disponible
                </span>
            </a>

            <!-- Módulo de productos -->
            <a
                href="#"
                class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm hover:border-green-700 hover:shadow-md"
            >
                <div class="text-4xl">🥕</div>

                <h2 class="mt-4 text-xl font-bold text-slate-900">
                    Productos
                </h2>

                <p class="mt-2 text-slate-600">
                    Consulta y registra productos disponibles.
                </p>

                <span class="mt-4 inline-block rounded-full bg-amber-100 px-3 py-1 text-sm font-semibold text-amber-900">
                    Próximamente
                </span>
            </a>

        </div>

    </section>

@endsection