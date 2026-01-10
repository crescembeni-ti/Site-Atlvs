<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        
        <div class="mb-8">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-sm text-zinc-500 hover:text-white mb-6 transition-colors font-medium">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Voltar para Meus Projetos
            </a>

            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b border-zinc-800 pb-6">
                <div>
                    <h1 class="text-3xl font-extrabold text-white mb-2">{{ $project->name }}</h1>
                    <div class="flex items-center gap-3 text-sm text-zinc-400">
                        <span>Criado em {{ $project->created_at->format('d/m/Y') }}</span>
                        <span class="text-zinc-700">&bull;</span>
                        <span class="bg-zinc-800 text-zinc-300 px-2 py-0.5 rounded text-xs font-mono">ID: #{{ str_pad($project->id, 4, '0', STR_PAD_LEFT) }}</span>
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
                @endphp
                <span class="px-4 py-2 rounded-full text-sm font-bold border {{ $statusClasses[$project->status] ?? 'text-zinc-400' }} shadow-sm">
                    {{ $statusLabels[$project->status] ?? 'Desconhecido' }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-zinc-900/50 border border-zinc-800 rounded-2xl p-8 backdrop-blur-sm">
                    <h3 class="text-xs font-bold text-zinc-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                        Escopo do Projeto
                    </h3>
                    
                    <div class="prose prose-invert text-zinc-300 leading-relaxed mb-10 text-sm bg-zinc-950/30 p-5 rounded-xl border border-zinc-800/50">
                        {!! nl2br(e($project->description)) !!}
                    </div>

                    <div>
                        <h3 class="text-xs font-bold text-zinc-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                            Arquivos do Projeto ({{ $project->files->count() }})
                        </h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @forelse($project->files as $file)
                                <div class="bg-zinc-950 border border-zinc-800 p-4 rounded-xl flex items-center justify-between group hover:border-blue-500/50 transition-all shadow-inner">
                                    <div class="flex items-center gap-3 overflow-hidden">
                                        <div class="bg-zinc-900 p-2 rounded-lg text-blue-400">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div class="overflow-hidden">
                                            <p class="text-sm text-zinc-200 font-medium truncate" title="{{ $file->original_name }}">
                                                {{ $file->original_name }}
                                            </p>
                                            <p class="text-[10px] text-zinc-500 uppercase font-bold">
                                                {{ number_format($file->size / 1024 / 1024, 2) }} MB
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ Storage::url($file->path) }}" target="_blank" download="{{ $file->original_name }}" 
                                       class="bg-zinc-800 hover:bg-blue-600 p-2.5 rounded-lg text-zinc-400 hover:text-white transition-all">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                    </a>
                                </div>
                            @empty
                                <div class="col-span-full py-6 text-center border-2 border-dashed border-zinc-800 rounded-xl bg-zinc-950/20">
                                    <p class="text-sm text-zinc-600 italic">Nenhum arquivo anexado.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="bg-zinc-900/50 border border-zinc-800 rounded-2xl overflow-hidden shadow-xl backdrop-blur-sm">
                    <div class="p-4 border-b border-zinc-800 bg-zinc-900/80 flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                        <h3 class="text-xs font-bold text-white uppercase tracking-widest">Chat com a Equipe</h3>
                    </div>

                    <div class="p-6 h-[400px] overflow-y-auto space-y-4 flex flex-col bg-zinc-950/20 scrollbar-thin scrollbar-thumb-zinc-800 scrollbar-track-transparent">
                        @forelse($project->comments->sortBy('created_at') as $comment)
                            <div class="max-w-[85%] {{ $comment->user_id === auth()->id() ? 'self-end' : 'self-start' }}">
                                <div class="flex items-center gap-2 mb-1 {{ $comment->user_id === auth()->id() ? 'justify-end' : '' }}">
                                    <span class="text-[10px] font-bold text-zinc-500 uppercase">
                                        {{ $comment->user_id === auth()->id() ? 'Você' : 'Equipe ATLVS' }}
                                    </span>
                                    <span class="text-[10px] text-zinc-600">{{ $comment->created_at->format('H:i') }}</span>
                                </div>
                                <div class="p-3.5 rounded-2xl text-sm shadow-sm {{ $comment->user_id === auth()->id() ? 'bg-blue-600 text-white rounded-tr-none' : 'bg-zinc-800 text-zinc-300 rounded-tl-none border border-zinc-700' }}">
                                    {{ $comment->content }}
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center h-full text-center space-y-3">
                                <svg class="w-12 h-12 text-zinc-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                <p class="text-zinc-600 text-sm font-medium">Tem alguma dúvida? Mande uma mensagem.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="p-4 bg-zinc-900/50 border-t border-zinc-800">
                        <form action="{{ route('projects.comments.store', $project) }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="text" name="content" required placeholder="Digite sua mensagem..." 
                                class="flex-1 bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 transition-all placeholder-zinc-600">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-2.5 rounded-xl transition-all shadow-lg shadow-blue-900/20">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9-2-9-18-9 18 9 2zm0 0v-8"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="space-y-6 lg:sticky lg:top-8">
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl shadow-black/40">
                    <h3 class="text-xs font-bold text-zinc-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Previsão de Entrega
                    </h3>
                    @if($project->deadline)
                        <div class="text-3xl font-bold text-white tracking-tight">
                            {{ \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') }}
                        </div>
                        <p class="text-xs text-zinc-500 mt-2">O prazo pode ser ajustado conforme o andamento das etapas de aprovação.</p>
                    @else
                        <div class="text-zinc-400 italic bg-zinc-950/50 p-3 rounded-lg border border-zinc-800/50 text-center">
                            A data será definida após análise técnica.
                        </div>
                    @endif
                </div>

                <div class="bg-gradient-to-br from-blue-900/20 to-zinc-900 border border-blue-500/20 rounded-2xl p-6">
                    <h3 class="text-blue-400 text-sm font-bold mb-2">Precisa de ajuda urgente?</h3>
                    <p class="text-xs text-zinc-400 mb-4">Se houver algum problema crítico, entre em contato direto pelo e-mail.</p>
                    <a href="mailto:contato@atlvs.com.br" class="text-xs text-white bg-blue-600 hover:bg-blue-500 px-4 py-2 rounded-lg inline-block transition-colors">
                        Enviar E-mail
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>