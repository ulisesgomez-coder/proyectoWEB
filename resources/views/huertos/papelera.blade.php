@extends('layouts.app')

@section('titulo', 'Papelera de huertos')

@section('content')

<section class="py-10">

    @include('huertos.mensajes')

    <h1 class="mb-4 text-3xl font-bold">
        Papelera de huertos
    </h1>

    <p class="mb-4 text-slate-600">
        Aquí se muestran los huertos eliminados mediante borrado lógico.
    </p>

    {{-- Avisos según los permisos del administrador --}}
    @cannot('restaurar')
        <div
            role="note"
            class="mb-4 rounded-lg border p-4"
            style="background: #eff6ff; color: #172554;"
        >
            Puedes consultar los registros de la papelera,
            pero no tienes permiso para restaurarlos.
        </div>
    @endcannot

    @cannot('eliminar-definitivamente')
        <div
            role="note"
            class="mb-4 rounded-lg border p-4"
            style="background: #fef3c7; color: #78350f;"
        >
            Tu nivel de administrador no permite eliminar
            registros definitivamente.
        </div>
    @endcannot

    <a
        href="{{ route('admin.huertos.index') }}"
        class="mb-6 inline-block rounded-lg border px-5 py-3"
    >
        Volver al listado
    </a>

    <div class="overflow-x-auto rounded-lg border bg-white">
        <table class="w-full text-left">

            <thead style="background: #0f172a; color: white;">
                <tr>
                    <th scope="col" class="p-4">Huerto</th>
                    <th scope="col" class="p-4">Propietario</th>
                    <th scope="col" class="p-4">Eliminado el</th>
                    <th scope="col" class="p-4">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($huertos as $huerto)
                    <tr class="border-b">

                        <td class="p-4">
                            {{ $huerto->nombre }}
                        </td>

                        <td class="p-4">
                            @if ($huerto->propietario)
                                {{ $huerto->propietario->nombres }}
                                {{ $huerto->propietario->apellidos }}
                            @else
                                Sin propietario registrado
                            @endif
                        </td>

                        <td class="p-4">
                            {{ $huerto->eliminado_en }}
                        </td>

                        <td class="p-4">
                            <div class="flex flex-wrap items-center gap-3">

                                {{-- Consulta individual --}}
                                @can('consultar')
                                    <a
                                        href="{{ route('admin.huertos.show', $huerto->id) }}"
                                        class="rounded border px-3 py-2"
                                    >
                                        Mostrar
                                    </a>
                                @endcan

                                {{-- Restauración autorizada --}}
                                @can('restaurar')
                                    <form
                                        action="{{ route('admin.huertos.restaurar', $huerto->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Restaurar este huerto?');"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="rounded px-3 py-2"
                                            style="background: #166534; color: white;"
                                        >
                                            Restaurar
                                        </button>
                                    </form>
                                @endcan

                                {{-- Borrado físico autorizado --}}
                                @can('eliminar-definitivamente')
                                    <form
                                        action="{{ route('admin.huertos.definitivo', $huerto->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Eliminar definitivamente este huerto y sus imágenes? Esta operación no se puede deshacer.');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded px-3 py-2"
                                            style="background: #991b1b; color: white;"
                                        >
                                            Eliminar definitivamente
                                        </button>
                                    </form>
                                @endcan

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center">
                            La papelera está vacía.
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