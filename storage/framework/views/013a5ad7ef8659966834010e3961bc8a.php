

<?php $__env->startSection('titulo', 'Administración de huertos'); ?>

<?php $__env->startSection('content'); ?>

<section class="py-10">

    
    <?php if(session('exito')): ?>
        <div
            role="status"
            class="mb-6 rounded-lg border p-4"
            style="background: #dcfce7; color: #14532d;"
        >
            <?php echo e(session('exito')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('aviso')): ?>
        <div
            role="status"
            class="mb-6 rounded-lg border p-4"
            style="background: #fef3c7; color: #78350f;"
        >
            <?php echo e(session('aviso')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div
            role="alert"
            class="mb-6 rounded-lg border p-4"
            style="background: #fef2f2; color: #991b1b;"
        >
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    
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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('consultar')): ?>
                <a
                    href="<?php echo e(route('admin.huertos.papelera')); ?>"
                    class="inline-flex items-center justify-center rounded-lg border px-5 py-3 font-semibold"
                    style="background: #ffffff; color: #0f172a;"
                >
                    Ver papelera
                </a>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crear')): ?>
                <a
                    href="<?php echo e(route('admin.huertos.nuevo')); ?>"
                    class="inline-flex items-center justify-center rounded-lg px-5 py-3 font-semibold focus:outline-none focus:ring-4 focus:ring-yellow-300"
                    style="background: #166534; color: white;"
                >
                    + Nuevo huerto
                </a>
            <?php endif; ?>
        </div>

    </div>

    
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('crear')): ?>
        <div
            role="note"
            class="mb-4 rounded-lg border px-5 py-4"
            style="background: #f8fafc; color: #334155;"
        >
            Tu cuenta tiene acceso de consulta.
            No puedes crear, editar ni eliminar registros.
        </div>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crear')): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('eliminar')): ?>
            <div
                role="note"
                class="mb-4 rounded-lg border px-5 py-4"
                style="background: #f8fafc; color: #334155;"
            >
                Puedes consultar, crear y editar huertos.
                Tu nivel no permite eliminar registros.
            </div>
        <?php endif; ?>
    <?php endif; ?>

    
    <div
        class="mb-4 rounded-lg border px-5 py-4"
        style="background: #eff6ff; color: #172554;"
    >
        <p>
            Se encontraron
            <strong><?php echo e($huertos->total()); ?></strong>
            huertos fuera de la papelera.

            <?php if($huertos->total() > 0): ?>
                Página
                <strong><?php echo e($huertos->currentPage()); ?></strong>
                de
                <strong><?php echo e($huertos->lastPage()); ?></strong>.
            <?php endif; ?>
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
                <?php $__empty_1 = true; $__currentLoopData = $huertos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $huerto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b border-slate-200 hover:bg-slate-50">

                        
                        <td class="px-6 py-4">
                            <?php echo e($huerto->id); ?>

                        </td>

                        
                        <td class="px-6 py-4 font-semibold text-slate-900">
                            <div class="flex items-center gap-3">
                                <?php if($huerto->ruta_imagen): ?>
                                    <img
                                        src="<?php echo e(asset('storage/'.$huerto->ruta_imagen)); ?>"
                                        alt="Imagen de <?php echo e($huerto->nombre); ?>"
                                        width="80"
                                        height="60"
                                        style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px;"
                                    >
                                <?php endif; ?>

                                <span><?php echo e($huerto->nombre); ?></span>
                            </div>
                        </td>

                        
                        <td class="px-6 py-4">
                            <?php echo e($huerto->ciudad ?? 'Sin ciudad registrada'); ?>

                        </td>

                        
                        <td class="px-6 py-4">
                            <?php if($huerto->propietario): ?>
                                <div class="font-semibold text-slate-900">
                                    <?php echo e($huerto->propietario->nombres); ?>

                                    <?php echo e($huerto->propietario->apellidos); ?>

                                </div>

                                <div class="mt-1 text-xs text-slate-600">
                                    <?php echo e($huerto->propietario->correo); ?>

                                </div>
                            <?php else: ?>
                                <span>Sin propietario registrado</span>
                            <?php endif; ?>
                        </td>

                        
                        <td class="px-6 py-4">
                            <?php if($huerto->area_m2 !== null): ?>
                                <?php echo e(number_format($huerto->area_m2, 2)); ?> m²
                            <?php else: ?>
                                Sin información
                            <?php endif; ?>
                        </td>

                        
                        <td class="px-6 py-4">
                            <?php if($huerto->estado === 'activo'): ?>
                                <span
                                    class="inline-flex rounded-full px-3 py-1 font-semibold"
                                    style="background: #dcfce7; color: #14532d;"
                                >
                                    Activo
                                </span>
                            <?php elseif($huerto->estado === 'inactivo'): ?>
                                <span
                                    class="inline-flex rounded-full px-3 py-1 font-semibold"
                                    style="background: #e2e8f0; color: #1e293b;"
                                >
                                    Inactivo
                                </span>
                            <?php else: ?>
                                <span
                                    class="inline-flex rounded-full px-3 py-1 font-semibold"
                                    style="background: #fef3c7; color: #78350f;"
                                >
                                    <?php echo e(ucfirst($huerto->estado)); ?>

                                </span>
                            <?php endif; ?>
                        </td>

                        
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap items-center justify-center gap-2">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('consultar')): ?>
                                    <a
                                        href="<?php echo e(route('admin.huertos.show', $huerto->id)); ?>"
                                        class="rounded-lg px-3 py-2 font-semibold"
                                        style="background: #1e40af; color: white;"
                                    >
                                        Mostrar
                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('editar')): ?>
                                    <a
                                        href="<?php echo e(route('admin.huertos.editar', $huerto->id)); ?>"
                                        class="rounded-lg px-3 py-2 font-semibold"
                                        style="background: #fbbf24; color: #0f172a;"
                                    >
                                        Editar
                                    </a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('eliminar')): ?>
                                    
                                    <form
                                        action="<?php echo e(route('admin.huertos.destroy', $huerto->id)); ?>"
                                        method="POST"
                                        onsubmit="return confirm('¿Mover este huerto a la papelera? Podrás restaurarlo después.');"
                                    >
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>

                                        <button
                                            type="submit"
                                            class="rounded-lg px-3 py-2 font-semibold"
                                            style="background: #991b1b; color: white;"
                                        >
                                            Eliminar
                                        </button>
                                    </form>
                                <?php endif; ?>

                            </div>
                        </td>

                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <p class="text-lg font-semibold text-slate-900">
                                No hay huertos para mostrar.
                            </p>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crear')): ?>
                                <p class="mt-2 text-slate-600">
                                    Puedes registrar un nuevo huerto.
                                </p>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies('crear')): ?>
                                <p class="mt-2 text-slate-600">
                                    Cuando haya huertos registrados,
                                    podrás consultarlos aquí.
                                </p>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurar')): ?>
                                <p class="mt-2 text-slate-600">
                                    También puedes revisar la papelera
                                    para restaurar un registro.
                                </p>
                            <?php endif; ?>
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\proyectos\mi-proyecto\resources\views/huertos/index.blade.php ENDPATH**/ ?>