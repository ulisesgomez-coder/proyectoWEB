<?php

namespace App\Http\Controllers;

use App\Models\Huerto;
use App\Models\Usuario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use RuntimeException;
use Throwable;

class HuertoController extends Controller
{
    public function index(): View
    {
        $huertos = Huerto::query()
            ->with('propietario')
            ->whereNull('eliminado_en')
            ->orderByDesc('id')
            ->paginate(5);

        return view('huertos.index', [
            'huertos' => $huertos,
        ]);
    }

    public function create(): View
    {
        $usuarios = Usuario::query()
            ->whereNull('eliminado_en')
            ->where('estado', 'activo')
            ->orderBy('nombres')
            ->get(['id', 'nombres', 'apellidos']);

        return view('huertos.formulario', [
            'usuarios' => $usuarios,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        // Primero se validan todos los datos.
        $datos = $request->validate(
            [
                'nombre' => [
                    'required',
                    'string',
                    'min:3',
                    'max:150',
                ],
                'propietario_id' => [
                    'required',
                    'integer',
                    Rule::exists('usuarios', 'id')->where(
                        fn ($consulta) => $consulta
                            ->whereNull('eliminado_en')
                            ->where('estado', 'activo')
                    ),
                ],
                'direccion' => [
                    'required',
                    'string',
                    'min:5',
                    'max:255',
                ],
                'ciudad' => [
                    'nullable',
                    'string',
                    'max:100',
                ],
                'area_m2' => [
                    'nullable',
                    'numeric',
                    'min:0.01',
                    'max:99999999.99',
                    'decimal:0,2',
                ],
                'estado' => [
                    'required',
                    Rule::in(['activo', 'inactivo', 'mantenimiento']),
                ],
                'descripcion' => [
                    'nullable',
                    'string',
                    'max:2000',
                ],
                'imagen' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:2048',
                ],
            ],
            [
                'required' => 'El campo :attribute es obligatorio.',
                'string' => 'El campo :attribute debe ser texto.',
                'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
                'nombre.max' => 'El nombre admite como máximo 150 caracteres.',
                'propietario_id.integer' => 'Selecciona un propietario válido.',
                'propietario_id.exists' => 'Selecciona un usuario activo existente.',
                'direccion.min' => 'La dirección debe tener al menos 5 caracteres.',
                'direccion.max' => 'La dirección admite como máximo 255 caracteres.',
                'ciudad.max' => 'La ciudad admite como máximo 100 caracteres.',
                'area_m2.numeric' => 'El área debe ser un número.',
                'area_m2.min' => 'El área debe ser mayor que cero.',
                'area_m2.max' => 'El área supera el valor permitido.',
                'area_m2.decimal' => 'El área admite como máximo dos decimales.',
                'estado.in' => 'Selecciona un estado válido.',
                'descripcion.max' => 'La descripción admite hasta 2000 caracteres.',
                'imagen.image' => 'El archivo debe ser una imagen válida.',
                'imagen.mimes' => 'La imagen debe ser JPG, PNG o WEBP.',
                'imagen.max' => 'La imagen no debe superar 2 MB.',
                'imagen.uploaded' => 'No se pudo recibir la imagen. Revisa su tamaño.',
            ],
            [
                'nombre' => 'nombre',
                'propietario_id' => 'propietario',
                'direccion' => 'dirección',
                'estado' => 'estado',
            ]
        );

        unset($datos['imagen']);

        $rutaImagen = null;

        try {
            DB::transaction(function () use (
                $request,
                $datos,
                &$rutaImagen
            ) {
                $huerto = new Huerto();

                $huerto->nombre = $datos['nombre'];
                $huerto->propietario_id = $datos['propietario_id'];
                $huerto->direccion = $datos['direccion'];
                $huerto->ciudad = $datos['ciudad'] ?? null;
                $huerto->area_m2 = $datos['area_m2'] ?? null;
                $huerto->estado = $datos['estado'];
                $huerto->descripcion = $datos['descripcion'] ?? null;

                
                $huerto->save();

                if ($request->hasFile('imagen')) {
                    $imagen = $request->file('imagen');

                    $extension = $imagen->extension();

                    $nombreArchivo = "Huerto_{$huerto->id}_1.{$extension}";

                    $rutaImagen = 'huertos/'.$nombreArchivo;

                    $resultado = $imagen->storeAs(
                        'huertos',
                        $nombreArchivo,
                        'public'
                    );

                    if ($resultado === false) {
                        throw new RuntimeException(
                            'No se pudo guardar la imagen.'
                        );
                    }

                    $huerto->ruta_imagen = $rutaImagen;
                    $huerto->save();
                }
            });
        } catch (Throwable $error) {
            report($error);

            if ($rutaImagen !== null) {
                try {
                    Storage::disk('public')->delete($rutaImagen);
                } catch (Throwable $errorArchivo) {
                    report($errorArchivo);
                }
            }

            return back()
                ->withInput($request->except('imagen'))
                ->withErrors([
                    'guardado' => 'No se pudo guardar el huerto. Intenta nuevamente.',
                ]);
        }

        return redirect()
            ->route('admin.huertos.index')
            ->with('exito', 'El huerto se registró correctamente.');

    
    }

    public function catalogo(): View
{
    $huertos = Huerto::query()
        ->whereNull('eliminado_en')
        ->where('estado', 'activo')
        ->whereNotNull('ruta_imagen')
        ->where('ruta_imagen', '!=', '')
        ->orderByDesc('id')
        ->get();

    return view('catalogo.huertos', [
        'huertos' => $huertos,
    ]);

    }

    public function edit(Huerto $huerto): View
{
    abort_if($huerto->eliminado_en !== null, 404);

    $usuarios = Usuario::query()
        ->whereNull('eliminado_en')
        ->where('estado', 'activo')
        ->orderBy('nombres')
        ->get(['id', 'nombres', 'apellidos']);

    return view('huertos.formulario', [
        'huerto' => $huerto,
        'usuarios' => $usuarios,
    ]);
}

public function update(Request $request, Huerto $huerto): RedirectResponse
{
    abort_if($huerto->eliminado_en !== null, 404);

    $datos = $request->validate(
        [
            'nombre' => 'required|string|min:3|max:150',
            'propietario_id' => [
                'required',
                'integer',
                Rule::exists('usuarios', 'id')->where(
                    fn ($consulta) => $consulta
                        ->whereNull('eliminado_en')
                        ->where('estado', 'activo')
                ),
            ],
            'direccion' => 'required|string|min:5|max:255',
            'ciudad' => 'nullable|string|max:100',
            'area_m2' => 'nullable|numeric|min:0.01|max:99999999.99|decimal:0,2',
            'estado' => [
                'required',
                Rule::in(['activo', 'inactivo', 'mantenimiento']),
            ],
            'descripcion' => 'nullable|string|max:2000',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ],
        [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.max' => 'El nombre admite hasta 150 caracteres.',
            'propietario_id.integer' => 'Selecciona un propietario válido.',
            'propietario_id.exists' => 'Selecciona un propietario activo.',
            'direccion.min' => 'La dirección debe tener al menos 5 caracteres.',
            'direccion.max' => 'La dirección admite hasta 255 caracteres.',
            'ciudad.max' => 'La ciudad admite hasta 100 caracteres.',
            'area_m2.numeric' => 'El área debe ser un número.',
            'area_m2.min' => 'El área debe ser mayor que cero.',
            'area_m2.max' => 'El área supera el valor permitido.',
            'area_m2.decimal' => 'El área admite como máximo dos decimales.',
            'estado.in' => 'Selecciona un estado válido.',
            'descripcion.max' => 'La descripción admite hasta 2000 caracteres.',
            'imagen.image' => 'Selecciona una imagen válida.',
            'imagen.mimes' => 'La imagen debe ser JPG, PNG o WEBP.',
            'imagen.max' => 'La imagen no debe superar 2 MB.',
            'imagen.uploaded' => 'No se pudo recibir la imagen.',
        ],
        [
            'propietario_id' => 'propietario',
            'direccion' => 'dirección',
        ]
    );

    unset($datos['imagen']);

    $rutaNueva = null;

    try {
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');

            $carpeta = 'huertos/'.\Illuminate\Support\Str::uuid();

            $nombreArchivo = 'Huerto_'.$huerto->id.'_1.'
                .$imagen->extension();

            $rutaNueva = $carpeta.'/'.$nombreArchivo;

            $resultado = $imagen->storeAs(
                $carpeta,
                $nombreArchivo,
                'public'
            );

            if ($resultado === false) {
                throw new RuntimeException('No se pudo guardar la imagen.');
            }

            $datos['ruta_imagen'] = $rutaNueva;
        }

        DB::transaction(function () use ($huerto, $datos) {
            $huerto->nombre = $datos['nombre'];
            $huerto->propietario_id = $datos['propietario_id'];
            $huerto->direccion = $datos['direccion'];
            $huerto->ciudad = $datos['ciudad'] ?? null;
            $huerto->area_m2 = $datos['area_m2'] ?? null;
            $huerto->estado = $datos['estado'];
            $huerto->descripcion = $datos['descripcion'] ?? null;

            if (isset($datos['ruta_imagen'])) {
                $huerto->ruta_imagen = $datos['ruta_imagen'];
            }

            $huerto->save();
        });
    } catch (Throwable $error) {
        report($error);

        if ($rutaNueva !== null) {
            try {
                Storage::disk('public')->delete($rutaNueva);
            } catch (Throwable $errorArchivo) {
                report($errorArchivo);
            }
        }

        return back()
            ->withInput($request->except('imagen'))
            ->withErrors([
                'guardado' => 'No se pudieron guardar los cambios. Intenta nuevamente.',
            ]);
    }

    return redirect()
        ->route('admin.huertos.index')
        ->with('exito', 'El huerto se actualizó correctamente.');
}

    //Controlador para eliminar un huerto de manera lógica (soft delete)
    public function show(Huerto $huerto): View
{
    $huerto->load('propietario');

    $miembros = DB::table('huerto_usuario')
        ->join('usuarios', 'usuarios.id', '=', 'huerto_usuario.usuario_id')
        ->where('huerto_usuario.huerto_id', $huerto->id)
        ->select(
            'usuarios.nombres',
            'usuarios.apellidos',
            'huerto_usuario.funcion_miembro',
            'huerto_usuario.fecha_ingreso'
        )
        ->get();

    $productos = DB::table('productos')
        ->where('huerto_id', $huerto->id)
        ->select('nombre', 'unidad', 'existencias', 'eliminado_en')
        ->get();

    return view('huertos.mostrar', compact(
        'huerto',
        'miembros',
        'productos'
    ));
}

    //Controlador para consultar papelera 
    public function papelera(): View
{
    $huertos = Huerto::query()
        ->with('propietario')
        ->whereNotNull('eliminado_en')
        ->orderByDesc('eliminado_en')
        ->paginate(5);

    return view('huertos.papelera', compact('huertos'));
}

    //Borrado lógico de un huerto
    public function destroy(Huerto $huerto): RedirectResponse
{
    try {
        $afectados = DB::table('huertos')
            ->where('id', $huerto->id)
            ->whereNull('eliminado_en')
            ->update([
                'eliminado_en' => now(),
            ]);

        if ($afectados === 0) {
            return back()->with(
                'aviso',
                'El huerto ya se encuentra en la papelera.'
            );
        }

        return redirect()
            ->route('admin.huertos.index')
            ->with('exito', 'El huerto se movió a la papelera.');
    } catch (Throwable $error) {
        report($error);

        return back()->with(
            'error',
            'No se pudo enviar el huerto a la papelera.'
        );
    }
}

    public function restaurar(Huerto $huerto): RedirectResponse
{
    try {
        $afectados = DB::table('huertos')
            ->where('id', $huerto->id)
            ->whereNotNull('eliminado_en')
            ->update([
                'eliminado_en' => null,
            ]);

        if ($afectados === 0) {
            return back()->with(
                'aviso',
                'El huerto ya estaba fuera de la papelera.'
            );
        }

        return redirect()
            ->route('admin.huertos.index')
            ->with('exito', 'El huerto se restauró correctamente.');
    } catch (Throwable $error) {
        report($error);

        return back()->with(
            'error',
            'No se pudo restaurar el huerto.'
        );
    }
}

    public function eliminarDefinitivamente(Huerto $huerto): RedirectResponse
{
    $disco = Storage::disk('public');
    $respaldos = [];

    try {
        DB::transaction(function () use (
            $huerto,
            $disco,
            &$respaldos
        ) {
            // Bloqueamos el registro durante la operación.
            $registro = DB::table('huertos')
                ->where('id', $huerto->id)
                ->lockForUpdate()
                ->first();

            if (!$registro || $registro->eliminado_en === null) {
                throw new \DomainException(
                    'Solo puedes eliminar definitivamente un huerto de la papelera.'
                );
            }

            // Se cuentan también productos eliminados lógicamente:
            // todavía conservan una referencia al huerto.
            $productos = DB::table('productos')
                ->where('huerto_id', $huerto->id)
                ->count();

            $miembros = DB::table('huerto_usuario')
                ->where('huerto_id', $huerto->id)
                ->count();

            if ($productos > 0 || $miembros > 0) {
                throw new \DomainException(
                    "No se puede eliminar: tiene {$productos} productos "
                    ."y {$miembros} miembros asociados."
                );
            }

            /*
             * Incluye las versiones anteriores de las imágenes.
             * El método update guardaba cada reemplazo en una subcarpeta.
             */
            $patron = '/^Huerto_'
                .preg_quote((string) $huerto->id, '/')
                .'_[0-9]+\.(jpg|jpeg|png|webp)$/i';

            $rutas = collect($disco->allFiles('huertos'))
                ->filter(
                    fn ($ruta) => preg_match($patron, basename($ruta)) === 1
                );

            if ($registro->ruta_imagen) {
                $rutas->push($registro->ruta_imagen);
            }

            $rutas = $rutas->unique()->values();

            foreach ($rutas as $ruta) {
                // Limitamos las operaciones a la carpeta de imágenes de huertos.
                if (
                    !str_starts_with($ruta, 'huertos/')
                    || str_contains($ruta, '..')
                    || str_contains($ruta, '\\')
                ) {
                    throw new \DomainException(
                        'La ruta de una imagen no es válida. Revisa el registro.'
                    );
                }

                // No borrar un archivo si otro huerto utiliza esa misma ruta.
                $compartida = DB::table('huertos')
                    ->where('id', '!=', $huerto->id)
                    ->where('ruta_imagen', $ruta)
                    ->exists();

                if ($compartida) {
                    throw new \DomainException(
                        'Una imagen está siendo utilizada por otro huerto.'
                    );
                }

                if ($disco->exists($ruta)) {
                    $contenido = $disco->get($ruta);

                    if ($contenido === null) {
                        throw new RuntimeException(
                            'No se pudo leer una imagen antes de eliminarla.'
                        );
                    }

                    $respaldos[$ruta] = $contenido;
                }
            }

            // Las llaves foráneas siguen protegiendo la base de datos.
            DB::table('huertos')
                ->where('id', $huerto->id)
                ->delete();

            foreach ($respaldos as $ruta => $contenido) {
                if (!$disco->delete($ruta)) {
                    throw new RuntimeException(
                        'No se pudo eliminar uno de los archivos.'
                    );
                }
            }
        });
    } catch (Throwable $error) {
        /*
         * Si ocurre un error, la transacción revierte el borrado del registro.
         * También intentamos reponer los archivos retirados.
         */
        $recuperados = true;

        foreach ($respaldos as $ruta => $contenido) {
            try {
                if (!$disco->put($ruta, $contenido)) {
                    $recuperados = false;
                }
            } catch (Throwable $errorArchivo) {
                report($errorArchivo);
                $recuperados = false;
            }
        }

        report($error);

        if (!$recuperados) {
            return back()->with(
                'error',
                'Se canceló el borrado, pero no se pudieron recuperar todas '
                .'las imágenes. Revisa el almacenamiento del proyecto.'
            );
        }

        $mensaje = $error instanceof \DomainException
            ? $error->getMessage()
            : 'No se pudo completar el borrado. Revisa las relaciones '
                .'y los permisos de los archivos.';

        return back()->with('error', $mensaje);
    }

    return redirect()
        ->route('admin.huertos.papelera')
        ->with('exito', 'El huerto y sus imágenes se eliminaron definitivamente.');
}

}