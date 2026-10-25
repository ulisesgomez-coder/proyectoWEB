@extends('layouts.app')

@section('titulo', 'Catálogo de huertos')

@section('content')

    <section class="mb-8 border-b border-gray-300 pb-6">
        <p class="mb-2 text-sm font-semibold uppercase tracking-wider text-green-700">
            Explora nuestros espacios
        </p>

        <h1 class="text-4xl font-bold text-gray-900">
            Catálogo de huertos
        </h1>

        <p class="mt-3 text-lg text-gray-600">
            Conoce nuestros huertos urbanos.
        </p>
    </section>

    @if ($huertos->isNotEmpty())

        <div
            id="custom-controls-gallery"
            class="relative w-full"
            @if ($huertos->count() > 1)
                data-carousel="slide"
            @endif
        >
        <div
            class="relative overflow-hidden rounded-lg"
            style="height: 420px; background-color: #e5e7eb;"
        >
                @foreach ($huertos as $huerto)

                    <div
                        class="{{ $loop->first ? '' : 'hidden' }} duration-700 ease-in-out"
                        style="position: absolute; inset: 0;"
                        data-carousel-item="{{ $loop->first ? 'active' : '' }}"
                    >
                        <img
                            src="{{ asset('storage/'.$huerto->ruta_imagen) }}"
                            alt="Imagen de {{ $huerto->nombre }}"
                            style="width: 100%; height: 100%; object-fit: cover; object-position: center;"
                        >

                        <!-- Nombre del huerto sobre la imagen -->
                        <div
                            style="position: absolute; bottom: 0; left: 0; right: 0;
                                   padding: 16px; background: rgba(0, 0, 0, 0.8);
                                   color: white; text-align: center;"
                        >
                            <h2 class="text-xl font-bold">
                                {{ $huerto->nombre }}
                            </h2>

                            @if ($huerto->ciudad)
                                <p class="mt-1">
                                    {{ $huerto->ciudad }}
                                </p>
                            @endif
                        </div>
                    </div>

                @endforeach
            </div>

            @if ($huertos->count() > 1)
                <div class="flex items-center justify-center gap-4 py-4">

                    <button
                        type="button"
                        data-carousel-prev
                        aria-label="Mostrar huerto anterior"
                        class="rounded-lg border px-5 py-2 font-semibold"
                    >
                        ← Anterior
                    </button>

                    <button
                        type="button"
                        data-carousel-next
                        aria-label="Mostrar huerto siguiente"
                        class="rounded-lg border px-5 py-2 font-semibold"
                    >
                        Siguiente →
                    </button>

                </div>
            @endif
        </div>

    @else

        <div
            class="my-8 rounded-lg border bg-white p-8 text-center"
            role="status"
        >
            <p class="text-lg font-semibold">
                Todavía no hay imágenes de huertos disponibles.
            </p>
        </div>

    @endif

@endsection