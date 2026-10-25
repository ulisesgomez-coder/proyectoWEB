

<?php $__env->startSection('titulo', 'Acceso administrativo'); ?>

<?php $__env->startSection('content'); ?>

    <section
        style="
            max-width: 460px;
            margin: 32px auto;
            padding: 32px;
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 16px;
        "
    >
        <h1
            style="
                margin: 0 0 12px;
                color: #0f172a;
                font-size: 28px;
                font-weight: 700;
            "
        >
            Acceso administrativo
        </h1>

        <p style="margin-bottom: 24px; color: #475569;">
            Introduce tu usuario y contraseña.
        </p>

        
        <?php $__sessionArgs = ['exito'];
if (session()->has($__sessionArgs[0])) :
if (isset($value)) { $__sessionPrevious[] = $value; }
$value = session()->get($__sessionArgs[0]); ?>
            <div
                role="status"
                style="
                    margin-bottom: 20px;
                    padding: 12px;
                    border: 1px solid #166534;
                    border-radius: 8px;
                    background-color: #f0fdf4;
                    color: #14532d;
                "
            >
                <?php echo e($value); ?>

            </div>
        <?php unset($value);
if (isset($__sessionPrevious) && !empty($__sessionPrevious)) { $value = array_pop($__sessionPrevious); }
if (isset($__sessionPrevious) && empty($__sessionPrevious)) { unset($__sessionPrevious); }
endif;
unset($__sessionArgs); ?>

        
        <?php if($errors->any()): ?>
            <div
                role="alert"
                style="
                    margin-bottom: 20px;
                    padding: 12px;
                    border: 1px solid #991b1b;
                    border-radius: 8px;
                    background-color: #fef2f2;
                    color: #991b1b;
                "
            >
                <p><strong>No se pudo iniciar sesión:</strong></p>

                <ul style="padding-left: 20px; list-style: disc;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if(auth()->guard('admin')->guest()): ?>
            <form
                action="<?php echo e(route('admin.login.store')); ?>"
                method="POST"
            >
                <?php echo csrf_field(); ?>

                <div style="margin-bottom: 20px;">
                    <label
                        for="usuario"
                        style="display: block; margin-bottom: 8px; font-weight: 600;"
                    >
                        Usuario
                    </label>

                    <input
                        id="usuario"
                        name="usuario"
                        type="text"
                        value="<?php echo e(old('usuario')); ?>"
                        required
                        maxlength="50"
                        autocomplete="username"
                        autofocus
                        style="
                            width: 100%;
                            box-sizing: border-box;
                            padding: 12px;
                            border: 1px solid #64748b;
                            border-radius: 8px;
                        "
                    >
                </div>

                <div style="margin-bottom: 24px;">
                    <label
                        for="password"
                        style="display: block; margin-bottom: 8px; font-weight: 600;"
                    >
                        Contraseña
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        maxlength="128"
                        autocomplete="current-password"
                        style="
                            width: 100%;
                            box-sizing: border-box;
                            padding: 12px;
                            border: 1px solid #64748b;
                            border-radius: 8px;
                        "
                    >
                </div>

                <button
                    type="submit"
                    style="
                        width: 100%;
                        padding: 12px;
                        border: 0;
                        border-radius: 8px;
                        background-color: #166534;
                        color: #ffffff;
                        font-weight: 700;
                        cursor: pointer;
                    "
                >
                    Iniciar sesión
                </button>
            </form>
        <?php endif; ?>

        <a
            href="<?php echo e(route('principal')); ?>"
            style="
                display: inline-block;
                margin-top: 20px;
                color: #166534;
                text-decoration: underline;
            "
        >
            Volver a la página principal
        </a>

    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\proyectos\mi-proyecto\resources\views/administracion/login.blade.php ENDPATH**/ ?>