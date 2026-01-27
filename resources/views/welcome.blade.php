@extends('layouts.site')

@section('title', 'ATLVS - Sistemas e Soluções em Tecnologia')

@section('content')
    <section class="pt-32 pb-16 lg:pt-40 lg:pb-24 relative overflow-hidden">
        {{-- Efeito de luz de fundo --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-blue-600/20 blur-[120px] rounded-full -z-10 opacity-60 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                {{-- Coluna da Esquerda: Textos --}}
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-900 border border-slate-800 text-blue-400 text-xs font-semibold mb-6 uppercase tracking-wide shadow-sm shadow-blue-900/20">
                        <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                        Software House & Consultoria
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-[1.1] mb-6">
                        A base sólida para o <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500">crescimento do seu negócio.</span>
                    </h1>
                    <p class="text-lg text-slate-400 mb-8 leading-relaxed max-w-lg">
                        Desenvolvemos sistemas administrativos, robustos e seguros, pensados para escalar junto com sua empresa ou instituição. Tecnologia sob medida para o longo prazo.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('contact') }}" class="inline-flex justify-center items-center px-6 py-3.5 text-base font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-500 transition-all shadow-lg shadow-blue-600/20 hover:shadow-blue-600/40">
                            Solicitar Orçamento
                        </a>
                        <a href="#solucoes" class="inline-flex justify-center items-center px-6 py-3.5 border border-slate-700 text-base font-medium rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition-all">
                            Conhecer Serviços
                        </a>
                    </div>
                </div>

                {{-- Coluna da Direita: Imagem do Painel --}}
                <div class="relative">
                    <div class="relative rounded-2xl overflow-hidden border border-slate-800 bg-slate-900/50 shadow-2xl shadow-blue-900/10 backdrop-blur-sm group">
                        {{-- AQUI ESTÁ A IMAGEM NOVA --}}
                        <img src="{{ asset('img/img-equip.jpeg') }}" alt="Interface do Sistema ATLVS" class="w-full h-auto object-cover transform transition-transform duration-700 group-hover:scale-[1.02]">
                        
                        {{-- Overlay sutil para garantir legibilidade/estilo dark --}}
                        <div class="absolute inset-0 bg-gradient-to-tr from-slate-950/20 to-transparent pointer-events-none"></div>
                    </div>
                    
                    {{-- Sombra do card (Elemento decorativo atrás) --}}
                    <div class="absolute -bottom-6 -right-6 w-full h-full border border-slate-800 rounded-2xl -z-10 bg-slate-950"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="solucoes" class="py-24 bg-slate-900/30 border-y border-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                    <div class="max-w-2xl">
                        <h2 class="text-3xl font-bold text-white mb-4">Onde atuamos</h2>
                        <p class="text-slate-400">Soluções tecnológicas focadas na realidade do mercado brasileiro, do setor privado ao público.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="setores">
                    {{-- CARD 1 --}}
                    <div class="group p-8 rounded-xl bg-slate-900 border border-slate-800 hover:border-blue-500/40 hover:bg-slate-800/80 transition-all duration-300 shadow-sm hover:shadow-blue-900/10">
                        <div class="w-12 h-12 bg-slate-800 rounded-lg flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors group-hover:shadow-lg group-hover:shadow-blue-500/20">
                            <svg class="w-6 h-6 text-blue-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-3">Pequenas e Médias</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Sistemas administrativos e de gestão que organizam processos e impulsionam o crescimento de PMEs.</p>
                    </div>

                    {{-- CARD 2 --}}
                    <div class="group p-8 rounded-xl bg-slate-900 border border-slate-800 hover:border-blue-500/40 hover:bg-slate-800/80 transition-all duration-300 shadow-sm hover:shadow-blue-900/10">
                        <div class="w-12 h-12 bg-slate-800 rounded-lg flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors group-hover:shadow-lg group-hover:shadow-blue-500/20">
                             <svg class="w-6 h-6 text-blue-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-3">Órgãos Públicos</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Projetos institucionais com foco em transparência, segurança de dados e atendimento à legislação vigente.</p>
                    </div>

                    {{-- CARD 3 --}}
                    <div class="group p-8 rounded-xl bg-slate-900 border border-slate-800 hover:border-blue-500/40 hover:bg-slate-800/80 transition-all duration-300 shadow-sm hover:shadow-blue-900/10">
                        <div class="w-12 h-12 bg-slate-800 rounded-lg flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors group-hover:shadow-lg group-hover:shadow-blue-500/20">
                             <svg class="w-6 h-6 text-blue-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-3">Software Sob Medida</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Desenvolvimento on-demand. Criamos a ferramenta exata que sua operação precisa, sem adaptações forçadas.</p>
                    </div>

                    {{-- CARD 4 --}}
                    <div class="group p-8 rounded-xl bg-slate-900 border border-slate-800 hover:border-blue-500/40 hover:bg-slate-800/80 transition-all duration-300 shadow-sm hover:shadow-blue-900/10">
                        <div class="w-12 h-12 bg-slate-800 rounded-lg flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors group-hover:shadow-lg group-hover:shadow-blue-500/20">
                             <svg class="w-6 h-6 text-blue-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 012 2h2a2 2 0 012-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-3">Foco no Longo Prazo</h3>
                        <p class="text-sm text-slate-400 leading-relaxed">Consultoria técnica para garantir que seu sistema seja escalável e sustentável por anos.</p>
                    </div>
                </div>
        </div>
    </section>

    <section id="sobre" class="bg-blue-900/10 border-y border-blue-900/20 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-blue-800/20">
                <div>
                    <div class="text-xl font-bold text-blue-100 mb-1">Segurança</div>
                    <div class="text-blue-300/50 text-sm uppercase tracking-wider">Como Prioridade</div>
                </div>
                <div>
                    <div class="text-xl font-bold text-blue-100 mb-1">Sistemas Sólidos</div>
                    <div class="text-blue-300/50 text-sm uppercase tracking-wider">Base Estrutural</div>
                </div>
                <div>
                    <div class="text-xl font-bold text-blue-100 mb-1">Escalabilidade</div>
                    <div class="text-blue-300/50 text-sm uppercase tracking-wider">Pronto p/ Crescer</div>
                </div>
                <div>
                    <div class="text-xl font-bold text-blue-100 mb-1">Tecnologia</div>
                    <div class="text-blue-300/50 text-sm uppercase tracking-wider">Sob Demanda</div>
                </div>
            </div>
        </div>
    </section>
@endsection