<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark h-full">
    <head>
        @include('partials.head')
        <link rel="icon" href="{{ asset('img/icone.png') }}" type="image/png">
    </head>
    
    {{-- MUDANÇA 1: 'overflow-hidden' no body para travar a rolagem geral da janela --}}
    <body class="h-full bg-slate-950 text-slate-100 antialiased selection:bg-blue-600 selection:text-white flex overflow-hidden">
        
        {{-- Efeitos de Fundo --}}
        <div class="fixed top-0 right-0 w-[600px] h-[600px] bg-blue-600/10 blur-[120px] rounded-full -z-10 pointer-events-none"></div>
        <div class="fixed bottom-0 left-0 w-[400px] h-[400px] bg-indigo-600/5 blur-[100px] rounded-full -z-10 pointer-events-none"></div>
        <div class="fixed inset-0 bg-[linear-gradient(to_right,#1e293b1a_1px,transparent_1px),linear-gradient(to_bottom,#1e293b1a_1px,transparent_1px)] bg-[size:24px_24px] -z-20 pointer-events-none"></div>

        {{-- MUDANÇA 2: Sidebar com 'h-full' para ocupar 100% da altura sempre --}}
        <flux:sidebar sticky stashable class="h-full border-r border-slate-800 bg-slate-900/60 backdrop-blur-xl py-6 overflow-y-auto">
            
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="me-5 flex items-center space-x-3 rtl:space-x-reverse mb-8 pl-4" wire:navigate>
                
                {{-- A Logo --}}
                <img src="{{ asset('img/logo.png') }}" alt="ATLVS" class="h-9 w-auto drop-shadow-[0_0_15px_rgba(37,99,235,0.5)]">
                
                {{-- MUDANÇA: Texto "ATLVS" adicionado ao lado --}}
              <span class="text-2xl font-bold text-slate-100 tracking-widest drop-shadow-md font-['Outfit'] uppercase">ATLVS</span>

                @if(auth()->user()->role === 'admin')
                    <span class="text-[9px] uppercase bg-slate-800 text-blue-400 px-1.5 py-0.5 rounded border border-blue-500/30 tracking-wider shadow-[0_0_10px_rgba(59,130,246,0.2)] ml-1">Admin</span>
                @endif
            </a>

            <flux:navlist variant="outline">
                
                @if(auth()->user()->role === 'admin')
                    <flux:navlist.group :heading="__('Gestão ATLVS')" class="grid text-slate-400">
                        <flux:navlist.item icon="chart-bar" :href="route('admin.dashboard')" :current="request()->routeIs('admin.dashboard')" wire:navigate>Dashboard</flux:navlist.item>
                        <flux:navlist.item icon="inbox-arrow-down" :href="route('admin.leads')" :current="request()->routeIs('admin.leads*')" wire:navigate>Leads & Contatos</flux:navlist.item>
                        <flux:navlist.item icon="briefcase" :href="route('admin.projects.index')" :current="request()->routeIs('admin.projects.*')" wire:navigate>Todos os Projetos</flux:navlist.item>
                    </flux:navlist.group>
                @else
                    <flux:navlist.group :heading="__('Principal')" class="grid text-slate-400">
                        <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Visão Geral') }}</flux:navlist.item>
                    </flux:navlist.group>

                    <flux:navlist.group :heading="__('Gestão')" class="grid mt-4 text-slate-400">
                        <flux:navlist.item icon="briefcase" :href="route('projects.index')" :current="request()->routeIs('projects.*')" wire:navigate>{{ __('Meus Projetos') }}</flux:navlist.item>

                       <flux:navlist.item icon="briefcase"
                           :href="route('gestao.financeiro.index')"
                            :current="request()->routeIs('gestao.financeiro.*')" wire:navigate>{{ __('Financeiro') }}
                    </flux:navlist.item>

                        <flux:navlist.item
                        icon="briefcase"
                        :href="route('gestao.contratos.index')"
                        :current="request()->routeIs('gestao.contratos.*')"
                        wire:navigate >{{ __('Contratos') }}
</flux:navlist.item>

                    </flux:navlist.group>
                    
                    <flux:navlist.group :heading="__('Atendimento')" class="grid mt-4 text-slate-400">
                        <flux:navlist.item icon="chat-bubble-left-right" href="#">{{ __('Meus Chamados') }}</flux:navlist.item>
                    </flux:navlist.group>
                @endif

            </flux:navlist>

            <flux:spacer />

            <div class="w-full border-t border-slate-800 pt-5 mt-4">
                <flux:dropdown class="hidden lg:block w-full" position="bottom" align="start">
                    <flux:profile
                        :name="auth()->user()->name"
                        :initials="auth()->user()->initials()"
                        icon-trailing="chevrons-up-down"
                        class="w-full hover:bg-slate-800/50 transition-colors rounded-lg p-2 -ml-2 text-slate-200"
                    />

                    <flux:menu class="w-[220px] bg-slate-900 border border-slate-800 shadow-xl shadow-black/50">
                        @if(auth()->user()->role === 'admin')
                            <form method="POST" action="{{ route('admin.logout') }}" class="w-full">
                                @csrf
                                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full text-red-400 hover:text-red-300 hover:bg-slate-800">
                                    {{ __('Sair do Admin') }}
                                </flux:menu.item>
                            </form>
                        @else
                            <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate class="hover:bg-slate-800 text-slate-300">{{ __('Configurações') }}</flux:menu.item>
                            <flux:menu.separator class="bg-slate-800"/>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full hover:bg-slate-800 text-slate-300">
                                    {{ __('Sair') }}
                                </flux:menu.item>
                            </form>
                        @endif
                    </flux:menu>
                </flux:dropdown>
                
                <div class="text-[10px] text-slate-500 mt-3 text-center lg:text-left px-1">
                    ATLVS {{ auth()->user()->role === 'admin' ? 'System' : 'v1.0' }} &copy; {{ date('Y') }}
                </div>
            </div>
        </flux:sidebar>

        <flux:header class="lg:hidden bg-slate-900 border-b border-slate-800">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />
            <flux:dropdown position="top" align="end">
                <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />
                <flux:menu class="bg-slate-900 border border-slate-800">
                     <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full hover:bg-slate-800">
                            {{ __('Sair') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{-- MUDANÇA 3: Conteúdo Principal agora tem sua própria rolagem (h-full + overflow-y-auto) --}}
        <div class="flex-1 min-w-0 h-full overflow-y-auto scrollbar-thin scrollbar-thumb-slate-700 scrollbar-track-transparent">
            <flux:main class="!pt-8 !mt-0 w-full !max-w-none">
                {{ $slot }}
            </flux:main>
        </div>

        @if (session('success'))
            <div 
                x-data="{ show: true }"
                x-show="show"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                x-init="setTimeout(() => show = false, 4000)"
                class="fixed bottom-5 right-5 z-50 flex items-center gap-3 bg-slate-900 border border-emerald-500/30 text-white px-6 py-4 rounded-xl shadow-2xl shadow-emerald-900/20"
                style="display: none;" 
            >
                <div class="bg-emerald-500/10 p-2 rounded-full text-emerald-400">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <h4 class="font-bold text-sm text-emerald-400">Sucesso!</h4>
                    <p class="text-sm text-slate-300">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-slate-500 hover:text-white ml-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        @fluxScripts
    </body>
</html>