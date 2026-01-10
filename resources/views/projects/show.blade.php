<x-layouts.app>
    <div class="max-w-4xl mx-auto">
        
        <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-sm text-zinc-500 hover:text-white mb-6 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Voltar para Meus Projetos
        </a>

        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-8 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">{{ $project->name }}</h1>
                    <div class="flex items-center gap-3 text-sm text-zinc-400">
                        <span>Criado em: {{ $project->created_at->format('d/m/Y') }}</span>
                        <span>&bull;</span>
                        <span>ID: #{{ str_pad($project->id, 4, '0', STR_PAD_LEFT) }}</span>
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
                        'desenvolvimento' => 'Em Desenvolvimento',
                        'homologacao' => 'Homologação',
                        'concluido' => 'Concluído',
                    ];
                    $status = $project->status;
                @endphp
                <span class="px-4 py-2 rounded-full text-sm font-bold border {{ $statusClasses[$status] ?? 'text-zinc-400' }}">
                    {{ $statusLabels[$status] ?? 'Desconhecido' }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-white mb-4">Escopo do Projeto</h3>
                    <div class="prose prose-invert text-zinc-400">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6">
                    <h3 class="text-sm font-medium text-zinc-500 uppercase tracking-wider mb-2">Previsão de Entrega</h3>
                    @if($project->deadline)
                        <div class="text-2xl font-bold text-white">
                            {{ \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}
                        </div>
                        <p class="text-xs text-zinc-500 mt-1">Data sujeita a alteração.</p>
                    @else
                        <div class="text-zinc-400 italic">A definir</div>
                    @endif
                </div>

                <div class="bg-zinc-900/30 border border-dashed border-zinc-800 rounded-xl p-6 text-center">
                    <p class="text-zinc-500 text-sm">Timeline e Arquivos em breve...</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>