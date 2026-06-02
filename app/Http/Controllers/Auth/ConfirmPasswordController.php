<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Dónde redirigir a los usuarios cuando la confirmación es exitosa.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Crear una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        // Solo usuarios que ya iniciaron sesión pueden confirmar su clave
        $this->middleware('auth');
    }

    /**
     * Hook que se ejecuta AUTOMÁTICAMENTE cuando el usuario pone su clave correcta.
     * * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function resetPasswordConfirmationTimeout(Request $request)
    {
        // 1. Ejecuta el comportamiento nativo de Laravel (guardar la marca de tiempo en la sesión)
        $request->session()->put('auth.password_confirmed_at', time());

        // 2. EXTRA SEGURIDAD: Guardamos en la sesión que este dispositivo específico fue re-verificado
        $device = $request->header('User-Agent');
        $request->session()->put('password_confirmed_device', $device);

        // 3. LOG DE AUDITORÍA: Deja un registro en los archivos log de Laravel de que el usuario confirmó su identidad
        Log::info("El usuario ID: {$request->user()->id} confirmó su contraseña con éxito desde el dispositivo: {$device}");

        // Redirige a donde el usuario intentaba ir originalmente o al home
        return redirect()->intended($this->redirectPath());
    }
};