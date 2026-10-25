

<?php $__env->startSection('titulo', 'Información del huerto'); ?>

<?php $__env->startSection('content'); ?>

<section class="py-10">
    <?php echo $__env->make('huertos.mensajes', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <h1 class="mb-6 text-3xl font-bold">
        <?php echo e($huerto->nombre); ?>

    </h1>

    <?php if($huerto->eliminado_en): ?>
        <p class="mb-4 rounded border p-3">
            Este huerto se encuentra en la papelera.
        </p>
    <?php endif; ?>

    <?php if($huerto->ruta_imagen): ?>
        <img
            src="<?php echo e(asset('storage/'.$huerto->ruta_imagen)); ?>"
            alt="Imagen de <?php echo e($huerto->nombre); ?>"
            class="mb-6 rounded-lg"
            style="max-width: 100%; max-height: 400px; object-fit: contain;"
        >
    <?php endif; ?>

    <?php
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
    ?>

    <dl class="mb-8 rounded-lg border bg-white p-6">
        <?php $__currentLoopData = $atributos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etiqueta => $valor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="mb-4">
                <dt class="font-bold"><?php echo e($etiqueta); ?></dt>
                <dd style="white-space: pre-wrap; overflow-wrap: anywhere;"><?php echo e($valor ?? 'Sin información'); ?></dd>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </dl>

    <h2 class="mb-3 text-xl font-bold">Miembros del huerto</h2>

    <ul class="mb-8 rounded-lg border bg-white p-6">
        <?php $__empty_1 = true; $__currentLoopData = $miembros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $miembro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li class="mb-3">
                <strong>
                    <?php echo e($miembro->nombres); ?> <?php echo e($miembro->apellidos); ?>

                </strong>
                — <?php echo e($miembro->funcion_miembro); ?>.
                Ingreso: <?php echo e($miembro->fecha_ingreso); ?>.
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li>No hay miembros asociados.</li>
        <?php endif; ?>
    </ul>

    <h2 class="mb-3 text-xl font-bold">Productos relacionados</h2>

    <ul class="mb-8 rounded-lg border bg-white p-6">
        <?php $__empty_1 = true; $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <li class="mb-3">
                <strong><?php echo e($producto->nombre); ?></strong>
                — <?php echo e($producto->existencias); ?> <?php echo e($producto->unidad); ?>


                <?php if($producto->eliminado_en): ?>
                    (eliminado lógicamente)
                <?php endif; ?>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <li>No hay productos asociados.</li>
        <?php endif; ?>
    </ul>

    <a
        href="<?php echo e($huerto->eliminado_en
            ? route('admin.huertos.papelera')
            : route('admin.huertos.index')); ?>"
        class="inline-block rounded-lg border px-5 py-3"
    >
        Volver
    </a>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\proyectos\mi-proyecto\resources\views/huertos/mostrar.blade.php ENDPATH**/ ?>