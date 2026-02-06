<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>@yield('title', 'ATLVS - Sistemas e Soluções em Tecnologia')</title>
        
        <link rel="icon" href="{{ asset('img/icone.png') }}" type="image/png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <style>
            /* Cor de fundo Slate-950 (Azul Noturno Profundo) */
            body { background-color: #020617; } 
            html { scroll-behavior: smooth; }
        </style>
    </head>
    
    {{-- MUDANÇA: Paleta Slate em vez de Zinc --}}
    <body class="font-sans antialiased text-slate-100 bg-slate-950 selection:bg-blue-600 selection:text-white" x-data="{ mobileMenuOpen: false }">

        {{-- Navbar com fundo Slate e desfoque --}}
        <nav class="fixed w-full z-50 bg-slate-950/80 border-b border-slate-800 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex h-20 items-center justify-between md:justify-start">
                    
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            {{-- Logo com tamanho controlado e brilho azulado --}}
                            <img src="{{ asset('img/logo.png') }}" alt="Logo ATLVS" class="h-10 w-auto mr-3 drop-shadow-[0_0_8px_rgba(59,130,246,0.5)] object-contain">
                            <span class="font-bold text-xl tracking-tight text-white">ATLVS</span>
                        </a>
                    </div>

                    <div class="hidden md:flex items-center flex-1 ml-12">
                        <div class="flex space-x-8">
                            <a href="{{ route('home') }}#solucoes" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">Soluções</a>
                            <a href="{{ route('home') }}#setores" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">Setores</a>
                            <a href="{{ route('home') }}#sobre" class="text-sm font-medium text-slate-400 hover:text-white transition-colors">A Empresa</a>
                        </div>

                        <div class="flex items-center gap-6 ml-auto">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-slate-300 hover:text-white">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300 hover:text-white whitespace-nowrap">Área do Cliente</a>
                                @endauth
                            @endif
                            {{-- Botão Azul Real --}}
                            <a href="{{ route('contact') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold py-2.5 px-5 rounded-lg transition-all shadow-lg shadow-blue-900/30 whitespace-nowrap">
                                Falar com especialista
                            </a>
                        </div>
                    </div>

                    <div class="flex md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="text-slate-400 hover:text-white p-2">
                            <span class="sr-only">Abrir menu</span>
                            <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg x-show="mobileMenuOpen" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div x-show="mobileMenuOpen" 
                 class="md:hidden bg-slate-950 border-b border-slate-800 absolute w-full left-0 top-20 shadow-2xl" 
                 x-cloak>
                <div class="px-4 pt-2 pb-6 space-y-1">
                    <a href="{{ route('home') }}#solucoes" class="block px-3 py-3 text-base font-medium text-slate-300 hover:text-white hover:bg-slate-900 rounded-md">Soluções</a>
                    <a href="{{ route('home') }}#setores" class="block px-3 py-3 text-base font-medium text-slate-300 hover:text-white hover:bg-slate-900 rounded-md">Setores</a>
                    <a href="{{ route('home') }}#sobre" class="block px-3 py-3 text-base font-medium text-slate-300 hover:text-white hover:bg-slate-900 rounded-md">A Empresa</a>
                    <div class="border-t border-slate-800 my-2 pt-2">
                         <a href="{{ route('contact') }}" class="block px-3 py-3 text-base font-medium text-blue-400 hover:text-blue-300">Falar com especialista</a>
                    </div>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        {{-- Footer Slate Escuro --}}
        <footer class="bg-slate-900 border-t border-slate-800 pt-16 pb-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo ATLVS" class="h-10 w-auto opacity-80">
                        <div>
                            <span class="font-bold text-lg text-slate-300 block leading-none">ATLVS</span>
                            <span class="text-[10px] text-slate-500 uppercase tracking-widest">Sistemas e Soluções</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-slate-500 font-medium">ATLVS Sistemas e Soluções em Tecnologia Ltda</p>
                        <p class="text-xs text-slate-600 mt-1">© {{ date('Y') }} Todos os direitos reservados.</p>
                    </div>
                </div>
            </div>
        </footer>

    </body>
</html>