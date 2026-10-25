@extends('layouts.app')

@section('titulo', 'Administración de huertos')

@section('content')

<section class="py-10">

    {{-- Mensajes de éxito, aviso o error --}}
    @if (session('exito'))
        <div
            role="status"
            class="mb-6 rounded-lg border p-4"
            style="background: #dcfce7; color: #14532d;"
        >
            {{ session('exito') }}
        </div>
    @endif

    @if (session('aviso'))
        <div
            role="status"
            class="mb-6 rounded-lg border p-4"
            style="background: #fef3c7; color: #78350f;"
        >
            {{ session('aviso') }}
        </div>
    @endif

    @if (session('error'))
        <div
            role="alert"
            class="mb-6 rounded-lg border p-4"
            style="background: #fef2f2; color: #991b1b;"
        >
            {{ session('error') }}
        </div>
    @endif

    {{-- Encabezado y navegación --}}
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Huertos registrados
            </h1>

            <p class="mt-2 text-slate-600">
                Consulta los huertos disponibles en el listado.
                Los registros eliminados se encuentran en la papelera.
            </p>
        </div>

        <div class="flex flex-wrap gap-3">
            @can('consultar')
                <a
                    href="{{ route('admin.huertos.papelera') }}"
                    class="inline-flex items-center justify-center rounded-lg border px-5 py-3 font-semibold"
                    style="background: #ffffff; color: #0f172a;"
                >
                    Ver papelera
                </a>
            @endcan

            @can('crear')
                <a
                    href="{{ route('admin.huertos.nuevo') }}"
                    class="inline-flex items-center justify-center rounded-lg px-5 py-3 font-semibold focus:outline-none focus:ring-4 focus:ring-yellow-300"
                    style="background: #166534; color: white;"
                >
                    + Nuevo huerto
                </a>
            @endcan
        </div>

    </div>

    {{-- Avisos según los permisos del administrador --}}
    @cannot('crear')
        <div
            role="note"
            class="mb-4 rounded-lg border px-5 py-4"
            style="background: #f8fafc; color: #334155;"
        >
            Tu cuenta tiene acceso de consulta.
            No puedes crear, editar ni eliminar registros.
        </div>
    @endcannot

    @can('crear')
        @cannot('eliminar')
            <div
                role="note"
                class="mb-4 rounded-lg border px-5 py-4"
                style="background: #f8fafc; color: #334155;"
            >
                Puedes consultar, crear y editar huertos.
                Tu nivel no permite eliminar registros.
            </div>
        @endcannot
    @endcan

    {{-- Resumen de registros --}}
    <div
        class="mb-4 rounded-lg border px-5 py-4"
        style="background: #eff6ff; color: #172554;"
    >
        <p>
            Se encontraron
            <strong>{{ $huertos->total() }}</strong>
            huertos fuera de la papelera.

            @if ($huertos->total() > 0)
                Página
                <strong>{{ $huertos->currentPage() }}</strong>
                de
                <strong>{{ $huertos->lastPage() }}</strong>.
            @endif
        </p>
    </div>

    <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-sm">

        <table class="w-full text-left text-sm text-slate-700">

            <thead
                class="text-xs uppercase"
                style="background: #0f172a; color: white;"
            >
                <tr>
                    <th scope="col" class="px-6 py-4">ID</th>
                    <th scope="col" class="px-6 py-4">Nombre</th>
                    <th scope="col" class="px-6 py-4">Ciudad</th>
                    <th scope="col" class="px-6 py-4">Propietario</th>
                    <th scope="col" class="px-6 py-4">Área</th>
                    <th scope="col" class="px-6 py-4">Estado</th>
                    <th scope="col" class="px-6 py-4 text-center">
                        Acciones
                    </th>
                </tr>
            </thead>

            <tbody>
                @forelse ($huertos as $huerto)
                    <tr class="border-b border-slate-200 hover:bg-slate-50">

                        {{-- Identificador --}}
                        <td class="px-6 py-4">
                            {{ $huerto->id }}
                        </td>

                        {{-- Nombre e imagen --}}
                        <td class="px-6 py-4 font-semibold text-slate-900">
                            <div class="flex items-center gap-3">
                                @if ($huerto->ruta_imagen)
                                    <img
                                        src="{{ asset('storage/'.$huerto->ruta_imagen) }}"
                                        alt="Imagen de {{ $huerto->nombre }}"
                                        width="80"
                                        height="60"
                                        style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px;"
                                    >
                                @endif

                                <span>{{ $huerto->nombre }}</span>
                            </div>
                        </td>

                        {{-- Ciudad --}}
                        <td class="px-6 py-4">
                            {{ $huerto->ciudad ?? 'Sin ciudad registrada' }}
                        </td>

                        {{-- Propietario --}}
                        <td class="px-6 py-4">
                            @if ($huerto->propietario)
                                <div class="font-semibold text-slate-900">
                                    {{ $huerto->propietario->nombres }}
                                    {{ $huerto->propietario->apellidos }}
                                </div>

                                <div class="mt-1 text-xs text-slate-600">
                                    {{ $huerto->propietario->correo }}
                                </div>
                            @else
                                <span>Sin propietario registrado</span>
                            @endif
                        </td>

                        {{-- Superficie --}}
                        <td class="px-6 py-4">
                            @if ($huerto->area_m2 !== null)
                                {{ number_format($huerto->area_m2, 2) }} m²
                            @else
                                Sin información
                            @endif
                        </td>

                        {{-- Estado --}}
                        <td class="px-6 py-4">
                            @if ($huerto->estado === 'activo')
                                <span
                                    class="inline-flex rounded-full px-3 py-1 font-semibold"
                                    style="background: #dcfce7; color: #14532d;"
                                >
                                    Activo
                                </span>
                            @elseif ($huerto->estado === 'inactivo')
                                <span
                                    class="inline-flex rounded-full px-3 py-1 font-semibold"
                                    style="background: #e2e8f0; color: #1e293b;"
                                >
                                    Inactivo
                                </span>
                            @else
                                <span
                                    class="inline-flex rounded-full px-3 py-1 font-semibold"
                                    style="background: #fef3c7; color: #78350f;"
                                >
                                    {{ ucfirst($huerto->estado) }}
                                </span>
                            @endif
                        </td>

                        {{-- Acciones autorizadas --}}
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap items-center justify-center gap-2">

                                @can('consultar')
                                    <a
                                        href="{{ route('admin.huertos.show', $huerto->id) }}"
                                        class="rounded-lg px-3 py-2 font-semibold"
                                        style="background: #1e40af; color: white;"
                                    >
                                        Mostrar
                                    </a>
                                @endcan

                                @can('editar')
                                    <a
                                        href="{{ route('admin.huertos.editar', $huerto->id) }}"
                                        class="rounded-lg px-3 py-2 font-semibold"
                                        style="background: #fbbf24; color: #0f172a;"
                                    >
                                        Editar
                                    </a>
                                @endcan

                                @can('eliminar')
                                    {{-- Confirmación del borrado lógico --}}
                                    <form
                                        action="{{ route('admin.huertos.destroy', $huerto->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Mover este huerto a la papelera? Podrás restaurarlo después.');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg px-3 py-2 font-semibold"
                                            style="background: #991b1b; color: white;"
                                        >
                                            Eliminar
                                        </button>
                                    </form>
                                @endcan

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <p class="text-lg font-semibold text-slate-900">
                                No hay huertos para mostrar.
                            </p>

                            @can('crear')
                                <p class="mt-2 text-slate-600">
                                    Puedes registrar un nuevo huerto.
                                </p>
                            @endcan

                            @cannot('crear')
                                <p class="mt-2 text-slate-600">
                                    Cuando haya huertos registrados,
                                    podrás consultarlos aquí.
                                </p>
                            @endcannot

                            @can('restaurar')
                                <p class="mt-2 text-slate-600">
                                    También puedes revisar la papelera
                                    para restaurar un registro.
                                </p>
                            @endcan
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- Paginación --}}
    @if ($huertos->hasPages())
        <div class="mt-6">
            {{ $huertos->links() }}
        </div>
    @endif

</section>

@endsection