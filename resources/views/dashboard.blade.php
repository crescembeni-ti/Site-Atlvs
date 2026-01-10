<x-layouts.app>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-1">Visão Geral</h1>
        <p class="text-zinc-400">Bem-vindo à área do cliente ATLVS.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-16 h-16 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <p class="text-sm font-medium text-zinc-500 uppercase tracking-wider mb-1">Projetos Ativos</p>
            <div class="text-3xl font-bold text-white">{{ $activeProjectsCount }}</div>
            <p class="text-xs text-zinc-500 mt-2">Em desenvolvimento ou análise</p>
        </div>

        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-16 h-16 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <p class="text-sm font-medium text-zinc-500 uppercase tracking-wider mb-1">Suporte Técnico</p>
            <div class="text-3xl font-bold text-white">{{ $openTickets }} Chamados</div>
            <p class="text-xs text-emerald-500 mt-2">Nenhuma pendência</p>
        </div>

        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-16 h-16 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <p class="text-sm font-medium text-zinc-500 uppercase tracking-wider mb-1">Status ATLVS</p>
            <div class="text-3xl font-bold text-white">Online</div>
            <p class="text-xs text-purple-400 mt-2">Sistemas operacionais</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden">
                <div class="p-6 border-b border-zinc-800 flex justify-between items-center">
                    <h3 class="font-bold text-white">Projetos Recentes</h3>
                    <a href="{{ route('projects.index') }}" class="text-xs text-blue-400 hover:text-blue-300">Ver todos</a>
                </div>

                <div class="divide-y divide-zinc-800">
                    @forelse($recentProjects as $project)
                        <div class="p-4 flex items-center justify-between hover:bg-zinc-800/30 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-zinc-800 flex items-center justify-center text-zinc-400">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-white">{{ $project->name }}</h4>
                                    <p class="text-xs text-zinc-500">Atualizado em {{ $project->updated_at->format('d/m/Y') }}</p>
                                </div>
                            </div>

                            @php
                                $statusClasses = [
                                    'analise' => 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20',
                                    'desenvolvimento' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                    'homologacao' => 'bg-purple-500/10 text-purple-400 border-purple-500/20',
                                    'concluido' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                ];
                                $statusLabels = [
                                    'analise' => 'Em Análise',
                                    'desenvolvimento' => 'Desenvolvimento',
                                    'homologacao' => 'Homologação',
                                    'concluido' => 'Concluído',
                                ];
                                $status = $project->status;
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium border {{ $statusClasses[$status] ?? 'text-zinc-500' }}">
                                {{ $statusLabels[$status] ?? 'Desconhecido' }}
                            </span>
                        </div>
                    @empty
                        <div class="p-8 text-center">
                            <p class="text-zinc-500 text-sm mb-4">Nenhum projeto iniciado.</p>
                            <a href="{{ route('projects.create') }}" class="text-blue-400 hover:text-white text-sm font-medium transition-colors">
                                + Iniciar meu primeiro projeto
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-blue-600 rounded-xl p-6 text-white shadow-lg shadow-blue-900/20">
                <h3 class="font-bold text-lg mb-2">Abrir Chamado</h3>
                <p class="text-blue-100 text-sm mb-6">Precisa de ajuda técnica ou manutenção? Abra um ticket direto para nossa equipe.</p>
                <a href="#" class="inline-block w-full bg-white text-blue-600 text-center py-2 rounded-lg font-bold hover:bg-blue-50 transition-colors">
                    Iniciar Suporte &rarr;
                </a>
            </div>

            <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6">
                <h3 class="font-bold text-white mb-4 text-sm uppercase tracking-wide">Acesso Rápido</h3>
                <ul class="space-y-3 text-sm text-zinc-400">
                    <li><a href="#" class="hover:text-blue-400 flex items-center gap-2 transition-colors"><span class="w-1.5 h-1.5 bg-zinc-700 rounded-full"></span> Documentação da API</a></li>
                    <li><a href="#" class="hover:text-blue-400 flex items-center gap-2 transition-colors"><span class="w-1.5 h-1.5 bg-zinc-700 rounded-full"></span> Segunda Via de Boleto</a></li>
                    <li><a href="{{ route('profile.edit') }}" class="hover:text-blue-400 flex items-center gap-2 transition-colors"><span class="w-1.5 h-1.5 bg-zinc-700 rounded-full"></span> Alterar Senha</a></li>
                </ul>
            </div>
        </div>
    </div>
</x-layouts.app>