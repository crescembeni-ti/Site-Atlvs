<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 1. Mostrar a tela de login exclusiva
    public function create()
    {
        return view('admin.auth.login');
    }

    // 2. Processar o login
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tenta logar
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // VERIFICAÇÃO DE SEGURANÇA (CRUCIAL)
            // Se o usuário logou, mas NÃO é admin...
            if (Auth::user()->role !== 'admin') {
                Auth::logout(); // Expulsa ele
                return back()->withErrors([
                    'email' => 'Acesso negado. Esta área é restrita para colaboradores.',
                ]);
            }

            // Se for admin, manda para o dashboard admin
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ]);
    }

    // 3. Logout específico do Admin
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}