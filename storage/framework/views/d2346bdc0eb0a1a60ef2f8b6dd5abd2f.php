

<?php $__env->startSection('titulo', 'Papelera de huertos'); ?>

<?php $__env->startSection('content'); ?>

<section class="py-10">

    <?php echo $__env->make('huertos.mensajes', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <h1 class="mb-4 text-3xl font-bold">
        Papelera de huertos
    </h1>

    <p class="mb-4 text-slate-600">
        Aquí se muestran los huertos eliminados mediante borrado lógico.
    </p>

    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('restaurar')): ?>
        <div
            role="note"
            class="mb-4 rounded-lg border p-4"
            style="background: #eff6ff; color: #172554;"
        >
            Puedes consultar los registros de la papelera,
            pero no tienes permiso para restaurarlos.
        </div>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('eliminar-definitivamente')): ?>
        <div
            role="note"
            class="mb-4 rounded-lg border p-4"
            style="background: #fef3c7; color: #78350f;"
        >
            Tu nivel de administrador no permite eliminar
            registros definitivamente.
        </div>
    <?php endif; ?>

    <a
        href="<?php echo e(route('admin.huertos.index')); ?>"
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
                <?php $__empty_1 = true; $__currentLoopData = $huertos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $huerto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b">

                        <td class="p-4">
                            <?php echo e($huerto->nombre); ?>

                        </td>

                        <td class="p-4">
                            <?php if($huerto->propietario): ?>
                                <?php echo e($huerto->propietario->nombres); ?>

                                <?php echo e($huerto->propietario->apellidos); ?>

                            <?php else: ?>
                                Sin propietario registrado
                            <?php endif; ?>
                        </td>

                        <td class="p-4">
                            <?php echo e($huerto->eliminado_en); ?>

                        </td>

                        <td class="p-4">
                            <div class="flex flex-wrap items-center gap-3">

                                
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('consultar')): ?>
                                    <a
                                        href="<?php echo e(route('admin.huertos.show', $huerto->id)); ?>"
                                        class="rounded border px-3 py-2"
                                    >
                                        Mostrar
                                    </a>
                                <?php endif; ?>

                                
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurar')): ?>
                                    <form
                                        action="<?php echo e(route('admin.huertos.restaurar', $huerto->id)); ?>"
                                        method="POST"
                                        onsubmit="return confirm('¿Restaurar este huerto?');"
                                    >
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>

                                        <button
                                            type="submit"
                                            class="rounded px-3 py-2"
                                            style="background: #166534; color: white;"
                                        >
                                            Restaurar
                                        </button>
                                    </form>
                                <?php endif; ?>

                                
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('eliminar-definitivamente')): ?>
                                    <form
                                        action="<?php echo e(route('admin.huertos.definitivo', $huerto->id)); ?>"
                                        method="POST"
                                        onsubmit="return confirm('¿Eliminar definitivamente este huerto y sus imágenes? Esta operación no se puede deshacer.');"
                                    >
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button
                                            type="submit"
                                            class="rounded px-3 py-2"
                                            style="background: #991b1b; color: white;"
                                        >
                                            Eliminar definitivamente
                                        </button>
                                    </form>
                                <?php endif; ?>

                            </div>
                        </td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="p-8 text-center">
                            La papelera está vacía.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>

    
    <?php if($huertos->hasPages()): ?>
        <div class="mt-6">
            <?php echo e($huertos->links()); ?>

        </div>
    <?php endif; ?>

</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\proyectos\mi-proyecto\resources\views/huertos/papelera.blade.php ENDPATH**/ ?>