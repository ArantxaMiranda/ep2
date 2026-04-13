<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Auth;

class AdminMiddleware{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response{
        // Verificar la sesión activa
        if(!Auth::check()){
            return redirect()->route('registro')
            ->with('error', 'Se debe registrar e iniciar sesión');
        }

        // Veridicar que la sesión sea de un administrador
        if(!Auth::user()->is_admin){
            return redirect()->route('home')
            ->with('error', 'No cuentas con permisos de administrador');
        }

        return $next($request);
    }
}
