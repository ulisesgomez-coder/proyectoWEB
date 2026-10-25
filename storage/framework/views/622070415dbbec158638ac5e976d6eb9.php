

<?php $__env->startSection('titulo', isset($huerto) ? 'Editar huerto' : 'Nuevo huerto'); ?>

<?php $__env->startSection('content'); ?>

<section class="py-10">
    <div class="mx-auto max-w-4xl">

        <h1 class="mb-3 text-3xl font-bold">
            <?php echo e(isset($huerto) ? 'Editar huerto' : 'Registrar huerto'); ?>

        </h1>

        <p class="mb-6">
            Completa la información. Los campos con * son obligatorios.
        </p>

        <!-- Mensajes de validación del servidor -->
        <?php if($errors->any()): ?>
            <div
                role="alert"
                class="mb-6 rounded-lg border p-4"
                style="background: #fef2f2; color: #991b1b;"
            >
                <p class="font-bold">
                    Revisa los siguientes datos:
                </p>

                <ul class="mt-2 list-disc pl-5">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        
        <a
            href="<?php echo e(route('admin.huertos.index')); ?>"
            style="
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 24px;
                padding: 10px 16px;
                border: 1px solid #334155;
                border-radius: 8px;
                background-color: #ffffff;
                color: #0f172a;
                font-weight: 600;
                text-decoration: none;
            "
        >
            <span aria-hidden="true">←</span>
            Volver al listado
        </a>

        <form
            id="formulario-huerto"
            action="<?php echo e(isset($huerto)
                ? route('admin.huertos.update', $huerto->id)
                : route('admin.huertos.store')); ?>"
            method="POST"
            enctype="multipart/form-data"
            class="rounded-xl border bg-white p-8 shadow-sm"
        >
            <?php echo csrf_field(); ?>

            <?php if(isset($huerto)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <div class="grid gap-6 md:grid-cols-2">

                <!-- Nombre -->
                <div>
                    <label for="nombre" class="mb-2 block font-semibold">
                        Nombre del huerto *
                    </label>

                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        value="<?php echo e(old('nombre', $huerto->nombre ?? '')); ?>"
                        required
                        minlength="3"
                        maxlength="150"
                        class="w-full rounded-lg border p-3"
                    >
                </div>

                <!-- Propietario -->
                <div>
                    <label for="propietario_id" class="mb-2 block font-semibold">
                        Propietario *
                    </label>

                    <select
                        id="propietario_id"
                        name="propietario_id"
                        required
                        class="w-full rounded-lg border p-3"
                    >
                        <option value="">Selecciona un propietario</option>

                        <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option
                                value="<?php echo e($usuario->id); ?>"
                                <?php if(
                                    (string) old(
                                        'propietario_id',
                                        $huerto->propietario_id ?? ''
                                    ) === (string) $usuario->id
                                ): echo 'selected'; endif; ?>
                            >
                                <?php echo e($usuario->nombres); ?>

                                <?php echo e($usuario->apellidos); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- Dirección -->
                <div class="md:col-span-2">
                    <label for="direccion" class="mb-2 block font-semibold">
                        Dirección *
                    </label>

                    <input
                        type="text"
                        id="direccion"
                        name="direccion"
                        value="<?php echo e(old('direccion', $huerto->direccion ?? '')); ?>"
                        required
                        minlength="5"
                        maxlength="255"
                        class="w-full rounded-lg border p-3"
                    >
                </div>

                <!-- Ciudad -->
                <div>
                    <label for="ciudad" class="mb-2 block font-semibold">
                        Ciudad
                    </label>

                    <input
                        type="text"
                        id="ciudad"
                        name="ciudad"
                        value="<?php echo e(old('ciudad', $huerto->ciudad ?? '')); ?>"
                        maxlength="100"
                        class="w-full rounded-lg border p-3"
                    >
                </div>

                <!-- Superficie -->
                <div>
                    <label for="area_m2" class="mb-2 block font-semibold">
                        Superficie en m²
                    </label>

                    <input
                        type="number"
                        id="area_m2"
                        name="area_m2"
                        value="<?php echo e(old('area_m2', $huerto->area_m2 ?? '')); ?>"
                        min="0.01"
                        max="99999999.99"
                        step="0.01"
                        class="w-full rounded-lg border p-3"
                    >
                </div>

                <!-- Estado -->
                <div>
                    <label for="estado" class="mb-2 block font-semibold">
                        Estado *
                    </label>

                    <select
                        id="estado"
                        name="estado"
                        required
                        class="w-full rounded-lg border p-3"
                    >
                        <option
                            value="activo"
                            <?php if(
                                old('estado', $huerto->estado ?? 'activo')
                                === 'activo'
                            ): echo 'selected'; endif; ?>
                        >
                            Activo
                        </option>

                        <option
                            value="inactivo"
                            <?php if(
                                old('estado', $huerto->estado ?? 'activo')
                                === 'inactivo'
                            ): echo 'selected'; endif; ?>
                        >
                            Inactivo
                        </option>

                        <option
                            value="mantenimiento"
                            <?php if(
                                old('estado', $huerto->estado ?? 'activo')
                                === 'mantenimiento'
                            ): echo 'selected'; endif; ?>
                        >
                            En mantenimiento
                        </option>
                    </select>
                </div>

                <!-- Imagen -->
                <div>
                    <label for="imagen" class="mb-2 block font-semibold">
                        Imagen del huerto
                    </label>

                    <?php if(isset($huerto) && $huerto->ruta_imagen): ?>
                        <div class="mb-3">
                            <p class="mb-2 text-sm font-semibold">
                                Imagen actual:
                            </p>

                            <img
                                src="<?php echo e(asset('storage/'.$huerto->ruta_imagen)); ?>"
                                alt="Imagen de <?php echo e($huerto->nombre); ?>"
                                width="200"
                                height="130"
                                style="width: 200px; height: 130px; object-fit: cover; border-radius: 8px;"
                            >

                            <p class="mt-2 text-sm">
                                Selecciona otra imagen para reemplazarla.
                                Si no seleccionas ninguna, se conservará esta.
                            </p>
                        </div>
                    <?php endif; ?>

                    <input
                        type="file"
                        id="imagen"
                        name="imagen"
                        accept=".jpg,.jpeg,.png,.webp"
                        aria-describedby="ayuda-imagen error-imagen"
                        class="w-full rounded-lg border p-3"
                    >

                    <p id="ayuda-imagen" class="mt-2 text-sm">
                        Opcional. JPG, PNG o WEBP. Máximo 2 MB.
                    </p>

                    <p
                        id="error-imagen"
                        role="alert"
                        class="mt-2 text-sm"
                        style="color: #991b1b;"
                    ></p>
                </div>

                <!-- Descripción -->    
                <div class="md:col-span-2">
                    <label for="descripcion" class="mb-2 block font-semibold">
                        Descripción
                    </label>

                    <textarea
                        id="descripcion"
                        name="descripcion"
                        rows="5"
                        maxlength="2000"
                        class="w-full rounded-lg border p-3"
                    ><?php echo e(old('descripcion', $huerto->descripcion ?? '')); ?></textarea>
                </div>

            </div>

            <!-- Botones -->
            <div class="mt-8 flex justify-end gap-4">
                <a
                    href="<?php echo e(route('admin.huertos.index')); ?>"
                    class="rounded-lg border px-6 py-3"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="rounded-lg px-6 py-3 font-semibold"
                    style="background: #166534; color: white;"
                >
                    <?php echo e(isset($huerto) ? 'Guardar cambios' : 'Guardar huerto'); ?>

                </button>
            </div>

        </form>
    </div>
</section>

<script>
    (() => {
        const formulario = document.getElementById('formulario-huerto');
        const campoImagen = document.getElementById('imagen');
        const errorImagen = document.getElementById('error-imagen');

        function validarImagen() {
            const archivo = campoImagen.files[0];

            campoImagen.setCustomValidity('');
            errorImagen.textContent = '';

            if (!archivo) {
                return true;
            }

            const tiposPermitidos = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            let mensaje = '';

            if (!tiposPermitidos.includes(archivo.type)) {
                mensaje = 'Selecciona una imagen JPG, PNG o WEBP.';
            } else if (archivo.size > 2 * 1024 * 1024) {
                mensaje = 'La imagen no debe superar 2 MB.';
            }

            campoImagen.setCustomValidity(mensaje);
            errorImagen.textContent = mensaje;

            return mensaje === '';
        }

        campoImagen.addEventListener('change', validarImagen);

        formulario.addEventListener('submit', function (evento) {
            if (!validarImagen()) {
                evento.preventDefault();
                campoImagen.reportValidity();
            }
        });
    })();
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\proyectos\mi-proyecto\resources\views/huertos/formulario.blade.php ENDPATH**/ ?>