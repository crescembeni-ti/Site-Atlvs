<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ATLVS - Sistemas e Soluções em Tecnologia</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #09090b;
        }
    </style>
</head>

<body class="font-sans antialiased text-zinc-100 bg-zinc-950 selection:bg-blue-600 selection:text-white">

    <nav class="fixed w-full z-50 bg-zinc-950/80 border-b border-zinc-800 backdrop-blur-md">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex h-20 items-center">



                <div class="flex-shrink-0 flex items-center">

                    <img src="{{ asset('img/logo.png') }}" alt="Logo ATLVS" class="h-[120px] w-auto -mr-10">

                    <span class="font-bold text-xl tracking-tight text-white z-10">ATLVS</span>

                </div>



                <div class="hidden md:flex space-x-8 items-center ml-16">

                    <a href="#solucoes"
                        class="text-sm font-medium text-zinc-400 hover:text-white transition-colors">Soluções</a>

                    <a href="#setores"
                        class="text-sm font-medium text-zinc-400 hover:text-white transition-colors">Setores de
                        Atuação</a>

                    <a href="#sobre" class="text-sm font-medium text-zinc-400 hover:text-white transition-colors">A
                        Empresa</a>

                </div>



                <div class="flex items-center gap-4 ml-auto">

                    @if (Route::has('login'))

                        @auth

                            <a href="{{ url('/dashboard') }}"
                                class="text-sm font-medium text-zinc-300 hover:text-white">Dashboard</a>

                        @else

                            <a href="{{ route('login') }}"
                                class="text-sm font-medium text-zinc-300 hover:text-white hidden sm:block">Área do Cliente</a>

                        @endauth

                    @endif

                    <a href="/contato"
                        class="bg-white text-zinc-950 hover:bg-zinc-200 text-sm font-semibold py-2.5 px-5 rounded-lg transition-all shadow-sm">

                        Falar com especialista

                    </a>

                </div>



            </div>

        </div>

    </nav>

    <section class="pt-32 pb-16 lg:pt-40 lg:pb-24 relative overflow-hidden">
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-blue-600/20 blur-[120px] rounded-full -z-10 opacity-50 pointer-events-none">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                <div class="max-w-2xl">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-zinc-900 border border-zinc-800 text-blue-400 text-xs font-semibold mb-6 uppercase tracking-wide">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        Software House & Consultoria
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-[1.1] mb-6">
                        A base sólida para o <br>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-500">crescimento
                            do seu negócio.</span>
                    </h1>
                    <p class="text-lg text-zinc-400 mb-8 leading-relaxed max-w-lg">
                        Desenvolvemos sistemas administrativos, robustos e seguros, pensados para escalar junto com sua
                        empresa ou instituição. Tecnologia sob medida para o longo prazo.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/contato"
                            class="inline-flex justify-center items-center px-6 py-3.5 text-base font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition-all shadow-lg shadow-blue-600/20 hover:shadow-blue-600/40">
                            Solicitar Orçamento
                        </a>
                        <a href="#solucoes"
                            class="inline-flex justify-center items-center px-6 py-3.5 border border-zinc-700 text-base font-medium rounded-lg text-zinc-300 hover:bg-zinc-900 hover:text-white transition-all">
                            Conhecer Serviços
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <div
                        class="relative rounded-2xl overflow-hidden border border-zinc-800 bg-zinc-900/50 shadow-2xl backdrop-blur-sm">
                        <div class="aspect-[4/3] flex items-center justify-center relative">
                            <div
                                class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px]">
                            </div>

                            <div class="text-center p-8 z-10">
                                <div
                                    class="w-16 h-16 bg-gradient-to-tr from-blue-600 to-purple-600 rounded-xl mx-auto mb-4 flex items-center justify-center shadow-lg shadow-blue-500/30">
                                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">Estrutura Escalável</h3>
                                <p class="text-zinc-500 text-sm">Sistemas preparados para<br>altas demandas e segurança.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute -bottom-6 -right-6 w-full h-full border border-zinc-800 rounded-2xl -z-10 bg-zinc-950">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="setores" class="py-24 bg-zinc-900/30 border-y border-zinc-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div class="max-w-2xl">
                    <h2 class="text-3xl font-bold text-white mb-4">Onde atuamos</h2>
                    <p class="text-zinc-400">Soluções tecnológicas focadas na realidade do mercado brasileiro, do setor
                        privado ao público.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="group p-8 rounded-xl bg-zinc-900 border border-zinc-800 hover:border-blue-500/50 hover:bg-zinc-800/80 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-zinc-800 rounded-lg flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors group-hover:shadow-lg group-hover:shadow-blue-500/20">
                        <svg class="w-6 h-6 text-blue-400 group-hover:text-white transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-3">Pequenas e Médias</h3>
                    <p class="text-sm text-zinc-400 leading-relaxed">Sistemas administrativos e de gestão que organizam
                        processos e impulsionam o crescimento de PMEs.</p>
                </div>

                <div
                    class="group p-8 rounded-xl bg-zinc-900 border border-zinc-800 hover:border-blue-500/50 hover:bg-zinc-800/80 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-zinc-800 rounded-lg flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors group-hover:shadow-lg group-hover:shadow-blue-500/20">
                        <svg class="w-6 h-6 text-blue-400 group-hover:text-white transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-3">Órgãos Públicos</h3>
                    <p class="text-sm text-zinc-400 leading-relaxed">Projetos institucionais com foco em transparência,
                        segurança de dados e atendimento à legislação vigente.</p>
                </div>

                <div
                    class="group p-8 rounded-xl bg-zinc-900 border border-zinc-800 hover:border-blue-500/50 hover:bg-zinc-800/80 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-zinc-800 rounded-lg flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors group-hover:shadow-lg group-hover:shadow-blue-500/20">
                        <svg class="w-6 h-6 text-blue-400 group-hover:text-white transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-3">Software Sob Medida</h3>
                    <p class="text-sm text-zinc-400 leading-relaxed">Desenvolvimento on-demand. Criamos a ferramenta
                        exata que sua operação precisa, sem adaptações forçadas.</p>
                </div>

                <div
                    class="group p-8 rounded-xl bg-zinc-900 border border-zinc-800 hover:border-blue-500/50 hover:bg-zinc-800/80 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-zinc-800 rounded-lg flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors group-hover:shadow-lg group-hover:shadow-blue-500/20">
                        <svg class="w-6 h-6 text-blue-400 group-hover:text-white transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 012 2h2a2 2 0 012-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-3">Foco no Longo Prazo</h3>
                    <p class="text-sm text-zinc-400 leading-relaxed">Consultoria técnica para garantir que seu sistema
                        seja escalável e sustentável por anos.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-blue-900/20 border-y border-blue-900/30 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-blue-800/30">
                <div>
                    <div class="text-xl font-bold text-blue-100 mb-1">Segurança</div>
                    <div class="text-blue-300/70 text-sm uppercase tracking-wider">Como Prioridade</div>
                </div>
                <div>
                    <div class="text-xl font-bold text-blue-100 mb-1">Sistemas Sólidos</div>
                    <div class="text-blue-300/70 text-sm uppercase tracking-wider">Base Estrutural</div>
                </div>
                <div>
                    <div class="text-xl font-bold text-blue-100 mb-1">Escalabilidade</div>
                    <div class="text-blue-300/70 text-sm uppercase tracking-wider">Pronto p/ Crescer</div>
                </div>
                <div>
                    <div class="text-xl font-bold text-blue-100 mb-1">Tecnologia</div>
                    <div class="text-blue-300/70 text-sm uppercase tracking-wider">Sob Demanda</div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-black border-t border-zinc-900 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo ATLVS" class="h-20 w-auto">

                    <div>
                        <span class="font-bold text-lg text-zinc-300 block leading-none">ATLVS</span>
                        <span class="text-[10px] text-zinc-600 uppercase tracking-widest">Sistemas e Soluções</span>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-xs text-zinc-500 font-medium">ATLVS Sistemas e Soluções em Tecnologia Ltda</p>
                    <p class="text-xs text-zinc-600 mt-1">© {{ date('Y') }} Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>