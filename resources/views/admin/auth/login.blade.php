<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>Admin Login - ATLVS</title>
    </head>
    <body class="min-h-screen bg-zinc-950 flex flex-col justify-center items-center font-sans antialiased text-white relative overflow-hidden">

        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-red-900/20 via-zinc-950 to-zinc-950 -z-10"></div>
        <div class="absolute top-0 w-full h-px bg-gradient-to-r from-transparent via-red-900/50 to-transparent"></div>

        <div class="w-full sm:max-w-md px-6 py-8 bg-zinc-900/80 backdrop-blur-xl border border-red-900/30 shadow-2xl rounded-2xl">
            
            <div class="flex flex-col items-center mb-8">
                <img src="{{ asset('img/logo.png') }}" class="h-10 w-auto mb-6 opacity-90" alt="Logo">
                
                <h2 class="text-xs font-bold text-red-500 tracking-[0.2em] uppercase border border-red-500/30 px-3 py-1 rounded-full bg-red-500/10">
                    Acesso Administrativo
                </h2>
            </div>

            <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-6">
                @csrf

                <flux:input 
                    name="email" 
                    label="E-mail Corporativo" 
                    type="email" 
                    required 
                    autofocus 
                    placeholder="admin@atlvs.com.br"
                    class="bg-zinc-950/50"
                />

                <flux:input 
                    name="password" 
                    label="Senha de Acesso" 
                    type="password" 
                    required 
                    placeholder="••••••••"
                    class="bg-zinc-950/50"
                />

                <flux:button type="submit" variant="danger" class="w-full font-bold shadow-lg shadow-red-900/20">
                    Entrar no Painel
                </flux:button>
            </form>
        </div>

        <div class="mt-8 text-zinc-600 text-[10px] uppercase tracking-wider">
            Sistema Interno v1.0 &bull; Acesso Monitorado
        </div>

        @fluxScripts
    </body>
</html>