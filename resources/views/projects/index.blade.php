<x-layouts.app>
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Meus Projetos</h1>
            <p class="text-zinc-400">Acompanhe o progresso das suas demandas técnicas.</p>
        </div>
        
        <a href="{{ route('projects.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2 ml-4">
    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Novo Projeto
</a>
    </div>

    @if($projects->isEmpty())
        <div class="border border-dashed border-zinc-800 rounded-xl p-12 text-center bg-zinc-900/30">
            <div class="w-16 h-16 bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4 text-zinc-500">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <h3 class="text-white font-medium text-lg mb-1">Nenhum projeto ativo</h3>
            <p class="text-zinc-500 max-w-sm mx-auto">Você ainda não tem projetos em andamento com a ATLVS. Clique no botão acima para solicitar um orçamento.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($projects as $project)
                <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6 hover:border-blue-500/30 transition-all group relative overflow-hidden">
                    
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-lg bg-zinc-800 flex items-center justify-center text-blue-400 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
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
                            $status = $project->status ?? 'analise';
                        @endphp

                        <span class="px-2.5 py-1 rounded-full text-xs font-medium border {{ $statusClasses[$status] }}">
                            {{ $statusLabels[$status] }}
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-white mb-2">{{ $project->name }}</h3>
                    <p class="text-sm text-zinc-400 line-clamp-2 mb-6 h-10">
                        {{ $project->description ?? 'Sem descrição definida para este projeto.' }}
                    </p>

                    <div class="flex items-center justify-between pt-4 border-t border-zinc-800/50">
                        <div class="text-xs text-zinc-500">
                            Prazo: <span class="text-zinc-300">{{ $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') : 'A definir' }}</span>
                        </div>
                        <a href="{{ route('projects.show', $project) }}" class="text-xs font-medium text-blue-400 hover:text-blue-300 flex items-center gap-1">
                            Ver detalhes &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-layouts.app>