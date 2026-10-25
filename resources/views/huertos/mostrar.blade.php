@extends('layouts.app')

@section('titulo', 'Información del huerto')

@section('content')

<section class="py-10">
    @include('huertos.mensajes')

    <h1 class="mb-6 text-3xl font-bold">
        {{ $huerto->nombre }}
    </h1>

    @if ($huerto->eliminado_en)
        <p class="mb-4 rounded border p-3">
            Este huerto se encuentra en la papelera.
        </p>
    @endif

    @if ($huerto->ruta_imagen)
        <img
            src="{{ asset('storage/'.$huerto->ruta_imagen) }}"
            alt="Imagen de {{ $huerto->nombre }}"
            class="mb-6 rounded-lg"
            style="max-width: 100%; max-height: 400px; object-fit: contain;"
        >
    @endif

    @php
        $propietario = $huerto->propietario;

        $atributos = [
            'ID' => $huerto->id,
            'Nombre' => $huerto->nombre,
            'Propietario' => $propietario
                ? $propietario->nombres.' '.$propietario->apellidos
                : 'Sin propietario disponible',
            'Correo del propietario' => $propietario?->correo,
            'Descripción' => $huerto->descripcion,
            'Dirección' => $huerto->direccion,
            'Ciudad' => $huerto->ciudad,
            'Latitud' => $huerto->latitud,
            'Longitud' => $huerto->longitud,
            'Superficie (m²)' => $huerto->area_m2,
            'Estado' => $huerto->estado,
            'Ruta de la imagen' => $huerto->ruta_imagen,
            'Fecha de creación' => $huerto->creado_en,
            'Última actualización' => $huerto->actualizado_en,
            'Fecha de borrado lógico' => $huerto->eliminado_en,
        ];
    @endphp

    <dl class="mb-8 rounded-lg border bg-white p-6">
        @foreach ($atributos as $etiqueta => $valor)
            <div class="mb-4">
                <dt class="font-bold">{{ $etiqueta }}</dt>
                <dd style="white-space: pre-wrap; overflow-wrap: anywhere;">{{ $valor ?? 'Sin información' }}</dd>
            </div>
        @endforeach
    </dl>

    <h2 class="mb-3 text-xl font-bold">Miembros del huerto</h2>

    <ul class="mb-8 rounded-lg border bg-white p-6">
        @forelse ($miembros as $miembro)
            <li class="mb-3">
                <strong>
                    {{ $miembro->nombres }} {{ $miembro->apellidos }}
                </strong>
                — {{ $miembro->funcion_miembro }}.
                Ingreso: {{ $miembro->fecha_ingreso }}.
            </li>
        @empty
            <li>No hay miembros asociados.</li>
        @endforelse
    </ul>

    <h2 class="mb-3 text-xl font-bold">Productos relacionados</h2>

    <ul class="mb-8 rounded-lg border bg-white p-6">
        @forelse ($productos as $producto)
            <li class="mb-3">
                <strong>{{ $producto->nombre }}</strong>
                — {{ $producto->existencias }} {{ $producto->unidad }}

                @if ($producto->eliminado_en)
                    (eliminado lógicamente)
                @endif
            </li>
        @empty
            <li>No hay productos asociados.</li>
        @endforelse
    </ul>

    <a
        href="{{ $huerto->eliminado_en
            ? route('admin.huertos.papelera')
            : route('admin.huertos.index') }}"
        class="inline-block rounded-lg border px-5 py-3"
    >
        Volver
    </a>
</section>

@endsection