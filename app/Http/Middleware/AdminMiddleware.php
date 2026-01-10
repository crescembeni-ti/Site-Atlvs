<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário NÃO está logado OU se o cargo NÃO é 'admin'
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Se falhar, redireciona para o dashboard comum (ou login)
            return redirect()->route('dashboard'); 
        }

        return $next($request);
    }
}