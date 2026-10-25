<?php $__currentLoopData = [
    'exito' => ['#dcfce7', '#14532d'],
    'aviso' => ['#fef3c7', '#78350f'],
    'error' => ['#fef2f2', '#991b1b'],
]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo => $colores): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <?php if(session($tipo)): ?>
        <div
            role="alert"
            class="mb-4 rounded-lg border p-4"
            style="background: <?php echo e($colores[0]); ?>; color: <?php echo e($colores[1]); ?>;"
        >
            <?php echo e(session($tipo)); ?>

        </div>
    <?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\proyectos\mi-proyecto\resources\views/huertos/mensajes.blade.php ENDPATH**/ ?>