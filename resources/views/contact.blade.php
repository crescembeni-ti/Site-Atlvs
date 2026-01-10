@extends('layouts.site')

@section('title', 'Contato - ATLVS')

@section('content')
    <section class="relative min-h-screen pt-32 pb-20 lg:pt-40 lg:pb-32 overflow-hidden">
        
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/20 blur-[120px] rounded-full -z-10 opacity-40 pointer-events-none"></div>
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px] -z-20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-zinc-900/80 border border-zinc-800 text-blue-400 text-xs font-semibold mb-6 uppercase tracking-wide backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    Fale com nosso time
                </div>
                <h1 class="text-4xl lg:text-5xl font-extrabold text-white tracking-tight mb-4">
                    Vamos tirar seu projeto do papel?
                </h1>
                <p class="text-lg text-zinc-400">
                    Preencha os campos abaixo. Nossa equipe técnica analisará sua demanda e retornará com uma abordagem consultiva.
                </p>
            </div>

            {{-- MENSAGEM DE SUCESSO --}}
            @if (session('success'))
                <div class="max-w-4xl mx-auto mb-8 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 flex items-center gap-3 animate-fade-in-up">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div>
                        <span class="font-bold block">Recebemos sua mensagem!</span>
                        <span class="text-sm opacity-90">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid lg:grid-cols-12 gap-12 items-start">
                
                <div class="lg:col-span-7 bg-zinc-900/40 border border-zinc-800/60 rounded-2xl p-6 sm:p-8 shadow-2xl backdrop-blur-md relative overflow-hidden group">
                    <div class="absolute inset-0 border-2 border-white/5 rounded-2xl pointer-events-none group-hover:border-blue-500/20 transition-colors duration-500"></div>

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6 relative z-10">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- NOME --}}
                            <div class="space-y-2">
                                <label for="name" class="text-sm font-medium text-zinc-400 ml-1">Nome Completo</label>
                                <input type="text" name="name" id="name" required value="{{ old('name') }}" placeholder="Ex: João Silva" 
                                    class="w-full bg-zinc-950/50 border border-zinc-800 rounded-lg px-4 py-3 text-white placeholder-zinc-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all shadow-inner @error('name') border-red-500 @enderror">
                                @error('name') <span class="text-red-400 text-xs ml-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- EMPRESA --}}
                            <div class="space-y-2">
                                <label for="company" class="text-sm font-medium text-zinc-400 ml-1">Empresa</label>
                                <input type="text" name="company" id="company" value="{{ old('company') }}" placeholder="Ex: ATLVS Tecnologia" 
                                    class="w-full bg-zinc-950/50 border border-zinc-800 rounded-lg px-4 py-3 text-white placeholder-zinc-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all shadow-inner">
                            </div>
                        </div>

                        {{-- EMAIL --}}
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-medium text-zinc-400 ml-1">E-mail Corporativo</label>
                            <input type="email" name="email" id="email" required value="{{ old('email') }}" placeholder="voce@suaempresa.com" 
                                class="w-full bg-zinc-950/50 border border-zinc-800 rounded-lg px-4 py-3 text-white placeholder-zinc-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all shadow-inner @error('email') border-red-500 @enderror">
                            @error('email') <span class="text-red-400 text-xs ml-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- MENSAGEM --}}
                        <div class="space-y-2">
                            <label for="message" class="text-sm font-medium text-zinc-400 ml-1">Detalhes do Projeto</label>
                            <textarea name="message" id="message" rows="5" required placeholder="Descreva brevemente sua necessidade técnica ou de negócio..." 
                                class="w-full bg-zinc-950/50 border border-zinc-800 rounded-lg px-4 py-3 text-white placeholder-zinc-700 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all shadow-inner resize-none @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                            @error('message') <span class="text-red-400 text-xs ml-1">{{ $message }}</span> @enderror
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-bold py-4 rounded-lg transition-all shadow-lg shadow-blue-900/20 transform hover:-translate-y-0.5 border border-blue-500/20 cursor-pointer">
                            Iniciar Conversa
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-5 space-y-8 lg:mt-4">
                    
                    <div class="space-y-6">
                        <h3 class="text-xl font-bold text-white mb-6 pl-2 border-l-4 border-blue-600">Canais Diretos</h3>
                        
                        <a href="mailto:contato@atlvs.com.br" class="flex items-center gap-4 p-4 rounded-xl bg-zinc-900/30 border border-zinc-800 hover:border-blue-500/30 hover:bg-zinc-800/50 transition-all group">
                            <div class="w-12 h-12 bg-zinc-800 rounded-lg flex items-center justify-center text-blue-400 group-hover:text-white group-hover:bg-blue-600 transition-all shadow-lg">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-zinc-500 font-medium uppercase tracking-wider mb-0.5">E-mail Comercial</p>
                                <p class="text-zinc-200 font-medium group-hover:text-blue-200 transition-colors">atlvs.dev@gmail.com</p>
                            </div>
                        </a>

                        <div class="flex items-center gap-4 p-4 rounded-xl bg-zinc-900/30 border border-zinc-800">
                            <div class="w-12 h-12 bg-zinc-800 rounded-lg flex items-center justify-center text-zinc-400">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-zinc-500 font-medium uppercase tracking-wider mb-0.5">Paracambi - RJ</p>
                                <p class="text-zinc-200 font-medium">Casa do Juan - 26600-000</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl p-6 bg-gradient-to-br from-zinc-900 to-zinc-950 border border-zinc-800 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/10 rounded-full blur-2xl -mr-10 -mt-10"></div>
                        
                        <h4 class="text-white font-bold text-lg mb-4 flex items-center gap-2">
                            <span class="flex h-2 w-2 rounded-full bg-blue-500"></span>
                            Próximos Passos
                        </h4>
                        <ul class="space-y-4">
                            <li class="flex gap-3 text-sm text-zinc-400">
                                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-zinc-800 flex items-center justify-center text-xs font-bold text-blue-400 border border-zinc-700">1</span>
                                <span>Análise técnica do seu cenário atual.</span>
                            </li>
                            <li class="flex gap-3 text-sm text-zinc-400">
                                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-zinc-800 flex items-center justify-center text-xs font-bold text-blue-400 border border-zinc-700">2</span>
                                <span>Agendamento de reunião com especialista.</span>
                            </li>
                            <li class="flex gap-3 text-sm text-zinc-400">
                                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-zinc-800 flex items-center justify-center text-xs font-bold text-blue-400 border border-zinc-700">3</span>
                                <span>Apresentação de proposta e cronograma.</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection