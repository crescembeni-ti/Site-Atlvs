<x-layouts.app>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Visão Geral da Empresa</h1>
        <p class="text-zinc-400">Resumo das operações e novas demandas.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-zinc-500 uppercase tracking-wider">Base de Clientes</p>
                    <div class="text-3xl font-bold text-white mt-2">{{ $totalClients }}</div>
                </div>
                <div class="p-3 bg-blue-500/10 rounded-lg text-blue-500">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-zinc-500 uppercase tracking-wider">Projetos Totais</p>
                    <div class="text-3xl font-bold text-white mt-2">{{ $totalProjects }}</div>
                </div>
                <div class="p-3 bg-purple-500/10 rounded-lg text-purple-500">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
            </div>
        </div>

        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-medium text-zinc-500 uppercase tracking-wider">Leads Pendentes</p>
                    <div class="text-3xl font-bold text-white mt-2">{{ $pendingLeads }}</div>
                </div>
                <div class="p-3 {{ $pendingLeads > 0 ? 'bg-red-500/10 text-red-500 animate-pulse' : 'bg-green-500/10 text-green-500' }} rounded-lg">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden">
            <div class="p-6 border-b border-zinc-800 flex justify-between items-center">
                <h3 class="font-bold text-white">Últimos Projetos</h3>
                <a href="{{ route('admin.projects.index') }}" class="text-xs text-blue-400 hover:text-blue-300">Ver todos</a>
            </div>
            <div class="divide-y divide-zinc-800">
                @forelse($recentProjects as $project)
                    <div class="p-4 flex items-center justify-between hover:bg-zinc-800/30 transition-colors">
                        <div>
                            <span class="block text-sm font-medium text-white">{{ $project->name }}</span>
                            <span class="text-xs text-zinc-500">{{ $project->user->name }}</span>
                        </div>
                        
                        @php
                            $colors = [
                                'analise' => 'text-yellow-500 bg-yellow-500/10',
                                'desenvolvimento' => 'text-blue-400 bg-blue-500/10',
                                'homologacao' => 'text-purple-400 bg-purple-500/10',
                                'concluido' => 'text-green-400 bg-green-500/10',
                            ];
                        @endphp
                        <span class="px-2 py-1 rounded text-[10px] uppercase font-bold {{ $colors[$project->status] ?? 'text-zinc-500' }}">
                            {{ $project->status }}
                        </span>
                    </div>
                @empty
                    <div class="p-6 text-center text-zinc-500 text-sm">Sem projetos recentes.</div>
                @endforelse
            </div>
        </div>

        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden">
            <div class="p-6 border-b border-zinc-800 flex justify-between items-center">
                <h3 class="font-bold text-white">Últimos Contatos (Site)</h3>
                <a href="{{ route('admin.leads') }}" class="text-xs text-blue-400 hover:text-blue-300">Ver todos</a>
            </div>
            <div class="divide-y divide-zinc-800">
                @forelse($recentLeads as $lead)
                    <div class="p-4 hover:bg-zinc-800/30 transition-colors">
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-white">{{ $lead->name }}</span>
                            <span class="text-xs text-zinc-500">{{ $lead->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-xs text-zinc-400 truncate">{{ $lead->message }}</p>
                    </div>
                @empty
                    <div class="p-6 text-center text-zinc-500 text-sm">Nenhuma mensagem recebida.</div>
                @endforelse
            </div>
        </div>

    </div>
</x-layouts.app>