<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('administracion');
        }

        return view('administracion.login');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validar los datos recibidos.
        $datos = $request->validate([
            'usuario' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'max:128'],
        ], [
            'usuario.required' => 'Escribe tu nombre de usuario.',
            'usuario.max' => 'El usuario no puede superar los 50 caracteres.',
            'password.required' => 'Escribe tu contraseña.',
            'password.max' => 'La contraseña no puede superar los 128 caracteres.',
        ]);

        // Limitar intentos por usuario y dirección IP.
        $clave = 'admin-login:' . hash(
            'sha256',
            Str::lower($datos['usuario']) . '|' . $request->ip()
        );

        if (RateLimiter::tooManyAttempts($clave, 5)) {
            $segundos = RateLimiter::availableIn($clave);

            throw ValidationException::withMessages([
                'usuario' => "Demasiados intentos. Espera {$segundos} segundos.",
            ]);
        }

        // Comprobar usuario, contraseña y estado antes de iniciar sesión.
        $credenciales = [
            'usuario' => $datos['usuario'],
            'password' => $datos['password'],
            'activo' => true,
        ];

        if (! Auth::guard('admin')->attempt($credenciales)) {
            RateLimiter::hit($clave, 60);

            throw ValidationException::withMessages([
                'usuario' => 'El usuario o la contraseña son incorrectos, o la cuenta está deshabilitada.',
            ]);
        }

        RateLimiter::clear($clave);

        // Cambiar el identificador de sesión después del acceso.
        $request->session()->regenerate();

        return redirect()
            ->route('administracion')
            ->with('exito', 'Iniciaste sesión correctamente.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login')
            ->with('exito', 'Cerraste sesión correctamente.');
    }
}