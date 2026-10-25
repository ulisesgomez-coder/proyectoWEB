

<?php $__env->startSection('titulo', 'Página principal'); ?>

<?php $__env->startSection('content'); ?>

    <style>
        .portada-huerticut {
            margin: 0 auto;
            overflow: hidden;
            border: 1px solid #dce5df;
            border-radius: 16px;
            background-color: #ffffff;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .portada-huerticut-imagen {
            background-color: #86f3aa;
        }

        .portada-huerticut-imagen img {
            display: block;
            width: 100%;
            height: auto;
        }
        

        .portada-huerticut-contenido {
            padding: 24px 32px;
        }

        .portada-huerticut-etiqueta {
            margin: 0 0 10px;
            color: #166534;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .portada-huerticut h1 {
            margin: 0;
            color: #0f172a;
            font-size: clamp(24px, 3vw, 34px);
            font-weight: 700;
            line-height: 1.2;
        }

        .portada-huerticut-descripcion {
            max-width: 850px;
            margin: 16px 0 0;
            color: #334155;
            font-size: 18px;
            line-height: 1.6;
        }

        .portada-huerticut-boton {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 22px;
            border-radius: 8px;
            background-color: #166534;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            text-decoration: none;
        }

        .portada-huerticut-boton:hover {
            background-color: #14532d;
            text-decoration: underline;
        }

        .portada-huerticut-boton:focus-visible {
            outline: 3px solid #0e7490;
            outline-offset: 4px;
        }

        @media (max-width: 640px) {
            .portada-huerticut-contenido {
                padding: 24px 20px;
            }
        }
    </style>

    <section class="portada-huerticut">

        
        <div class="portada-huerticut-imagen">
            <img
                src="<?php echo e(asset('images/principal/HuertiCUT.png')); ?>"
                alt="HuertiCUT: huerto urbano del Centro Universitario de Tonalá"
            >
        </div>

        
        <div class="portada-huerticut-contenido">

            <p class="portada-huerticut-etiqueta">
                Agricultura urbana y comunitaria
            </p>

            <h1>
                Plataforma de Gestión de Huertos Urbanos
            </h1>

            <p class="portada-huerticut-descripcion">
                Descubre huertos comunitarios, consulta cosechas disponibles
                y participa en una forma más sostenible de producir y
                distribuir alimentos dentro de la comunidad.
            </p>

            <a
                href="<?php echo e(route('huertos')); ?>"
                class="portada-huerticut-boton"
            >
                Ver catálogo de huertos
            </a>

        </div>

    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\proyectos\mi-proyecto\resources\views/principal.blade.php ENDPATH**/ ?>