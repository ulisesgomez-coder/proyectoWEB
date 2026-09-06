@extends('layouts.app')

@section('titulo', 'Formulario de huertos')

@section('content')

    <section class="py-10">

        <div class="mx-auto max-w-4xl">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-900">
                    Formulario de huerto
                </h1>

                <p class="mt-2 text-slate-600">
                    Captura simulada de la información de un huerto urbano.
                </p>
            </div>

            <form class="rounded-xl border border-slate-200 bg-white p-8 shadow-sm">

                <div class="grid gap-6 md:grid-cols-2">

                    <!-- Nombre -->
                    <div>
                        <label
                            for="nombre"
                            class="mb-2 block font-semibold text-slate-900"
                        >
                            Nombre del huerto
                        </label>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            placeholder="Ejemplo: Huerto Las Flores"
                            class="block w-full rounded-lg border border-slate-400 bg-white p-3 text-slate-900 focus:border-blue-700 focus:ring-blue-700"
                        >
                    </div>

                    <!-- Responsable -->
                    <div>
                        <label
                            for="responsable"
                            class="mb-2 block font-semibold text-slate-900"
                        >
                            Usuario responsable
                        </label>

                        <select
                            id="responsable"
                            name="responsable"
                            class="block w-full rounded-lg border border-slate-400 bg-white p-3 text-slate-900 focus:border-blue-700 focus:ring-blue-700"
                        >
                            <option value="">Selecciona un responsable</option>
                            <option value="1">María López</option>
                            <option value="2">Carlos Ramírez</option>
                            <option value="3">Ana González</option>
                        </select>
                    </div>

                    <!-- Dirección -->
                    <div>
                        <label
                            for="direccion"
                            class="mb-2 block font-semibold text-slate-900"
                        >
                            Dirección
                        </label>

                        <input
                            type="text"
                            id="direccion"
                            name="direccion"
                            placeholder="Calle y número"
                            class="block w-full rounded-lg border border-slate-400 bg-white p-3 text-slate-900 focus:border-blue-700 focus:ring-blue-700"
                        >
                    </div>

                    <!-- Ciudad -->
                    <div>
                        <label
                            for="ciudad"
                            class="mb-2 block font-semibold text-slate-900"
                        >
                            Ciudad
                        </label>

                        <input
                            type="text"
                            id="ciudad"
                            name="ciudad"
                            placeholder="Nombre de la ciudad"
                            class="block w-full rounded-lg border border-slate-400 bg-white p-3 text-slate-900 focus:border-blue-700 focus:ring-blue-700"
                        >
                    </div>

                    <!-- Código postal -->
                    <div>
                        <label
                            for="codigo_postal"
                            class="mb-2 block font-semibold text-slate-900"
                        >
                            Código postal
                        </label>

                        <input
                            type="text"
                            id="codigo_postal"
                            name="codigo_postal"
                            placeholder="00000"
                            class="block w-full rounded-lg border border-slate-400 bg-white p-3 text-slate-900 focus:border-blue-700 focus:ring-blue-700"
                        >
                    </div>

                    <!-- Superficie -->
                    <div>
                        <label
                            for="superficie"
                            class="mb-2 block font-semibold text-slate-900"
                        >
                            Superficie en m²
                        </label>

                        <input
                            type="number"
                            id="superficie"
                            name="superficie"
                            min="0"
                            placeholder="Ejemplo: 250"
                            class="block w-full rounded-lg border border-slate-400 bg-white p-3 text-slate-900 focus:border-blue-700 focus:ring-blue-700"
                        >
                    </div>

                    <!-- Fecha -->
                    <div>
                        <label
                            for="fecha_creacion"
                            class="mb-2 block font-semibold text-slate-900"
                        >
                            Fecha de creación
                        </label>

                        <input
                            type="date"
                            id="fecha_creacion"
                            name="fecha_creacion"
                            class="block w-full rounded-lg border border-slate-400 bg-white p-3 text-slate-900 focus:border-blue-700 focus:ring-blue-700"
                        >
                    </div>

                    <!-- Estado -->
                    <div>
                        <label
                            for="estado"
                            class="mb-2 block font-semibold text-slate-900"
                        >
                            Estado
                        </label>

                        <select
                            id="estado"
                            name="estado"
                            class="block w-full rounded-lg border border-slate-400 bg-white p-3 text-slate-900 focus:border-blue-700 focus:ring-blue-700"
                        >
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                            <option value="mantenimiento">En mantenimiento</option>
                        </select>
                    </div>

                    <!-- Imagen -->
                    <div class="md:col-span-2">
                        <label
                            for="imagen"
                            class="mb-2 block font-semibold text-slate-900"
                        >
                            Imagen del huerto
                        </label>

                        <input
                            type="file"
                            id="imagen"
                            name="imagen"
                            accept="image/*"
                            class="block w-full rounded-lg border border-slate-400 bg-white text-slate-700 file:mr-4 file:border-0 file:bg-slate-900 file:px-5 file:py-3 file:text-white"
                        >
                    </div>

                    <!-- Descripción -->
                    <div class="md:col-span-2">
                        <label
                            for="descripcion"
                            class="mb-2 block font-semibold text-slate-900"
                        >
                            Descripción
                        </label>

                        <textarea
                            id="descripcion"
                            name="descripcion"
                            rows="5"
                            placeholder="Escribe una descripción del huerto"
                            class="block w-full rounded-lg border border-slate-400 bg-white p-3 text-slate-900 focus:border-blue-700 focus:ring-blue-700"
                        ></textarea>
                    </div>

                    <!-- Tipo -->
                    <fieldset class="md:col-span-2">
                        <legend class="mb-3 font-semibold text-slate-900">
                            Tipo de huerto
                        </legend>

                        <div class="flex flex-wrap gap-6">
                            <label class="flex items-center gap-2">
                                <input
                                    type="radio"
                                    name="tipo"
                                    value="comunitario"
                                    class="h-4 w-4"
                                >
                                Comunitario
                            </label>

                            <label class="flex items-center gap-2">
                                <input
                                    type="radio"
                                    name="tipo"
                                    value="escolar"
                                    class="h-4 w-4"
                                >
                                Escolar
                            </label>

                            <label class="flex items-center gap-2">
                                <input
                                    type="radio"
                                    name="tipo"
                                    value="privado"
                                    class="h-4 w-4"
                                >
                                Privado
                            </label>
                        </div>
                    </fieldset>

                </div>

                <!-- Botones -->
                <div class="mt-8 flex flex-wrap justify-end gap-4">

                    <a
                        href="{{ route('admin.huertos.index') }}"
                        class="rounded-lg border border-slate-400 bg-white px-6 py-3 font-semibold text-slate-800 hover:bg-slate-100"
                    >
                        Cancelar
                    </a>

                    <button
                        type="button"
                        class="rounded-lg bg-green-800 px-6 py-3 font-semibold text-white hover:bg-green-900 focus:outline-none focus:ring-4 focus:ring-yellow-300"
                    >
                        Guardar
                    </button>

                </div>

            </form>
        </div>

    </section>

@endsection