@extends('layouts.app')

@section('titulo', 'Página principal')

@section('content')

    <!-- Portada principal -->
    <section class="relative min-h-[650px] overflow-hidden rounded-2xl shadow-xl">

        <!-- Imagen de fondo -->
        <img
            src="{{ asset('images/principal/huertoportada.jpg') }}"
            alt="Huerto urbano comunitario"
            class="absolute inset-0 h-full w-full object-cover"
        >

        <!-- Capa oscura para mejorar la lectura -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/95 via-slate-950/75 to-slate-950/25"></div>

        <!-- Contenido de la portada -->
        <div class="relative z-10 flex min-h-[650px] items-center px-8 py-16 md:px-16 lg:px-24">
            <div class="max-w-3xl text-white">

                <span class="inline-block rounded-full bg-slate-950/80 px-4 py-2 text-sm font-bold uppercase tracking-wider">
                    Agricultura urbana y comunitaria
                </span>

                <h1 class="mt-6 text-4xl font-bold leading-tight md:text-6xl">
                    Plataforma de Gestión de Huertos Urbanos
                </h1>

                <p class="mt-6 max-w-2xl text-lg font-medium leading-8 text-slate-100 md:text-xl">
                    Descubre huertos comunitarios, consulta cosechas disponibles
                    y participa en una forma más sostenible de producir y
                    distribuir alimentos dentro de la ciudad.
                </p>

                <div class="mt-8">
                    <a
                        href="{{ route('huertos') }}"
                        class="inline-block rounded-lg bg-green-800 px-6 py-3 font-semibold text-white shadow-lg hover:bg-green-900 focus:outline-none focus:ring-4 focus:ring-yellow-300"
                    >
                        Ver catálogo de huertos
                    </a>
                </div>

            </div>
        </div>

    </section>

@endsection