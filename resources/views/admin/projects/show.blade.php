<x-layouts.app>
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('admin.projects.index') }}" class="text-sm text-zinc-500 hover:text-white flex items-center gap-2 transition-colors font-medium">
                &larr; Voltar para a lista
            </a>
            
            <div class="flex items-center gap-3">
                <span class="text-zinc-500 text-sm">Cliente:</span>
                <div class="flex items-center gap-2 bg-zinc-900 border border-zinc-800 rounded-full px-4 py-1.5 shadow-sm">
                    <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center text-[10px] font-bold text-white">
                        {{ $project->user->initials() }}
                    </div>
                    <span class="text-sm font-semibold text-white">{{ $project->user->name }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-zinc-900/50 border border-zinc-800 rounded-2xl p-8 backdrop-blur-sm">
                    <h1 class="text-3xl font-extrabold text-white mb-2">{{ $project->name }}</h1>
                    <p class="text-xs text-zinc-500 mb-8 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Solicitado em {{ $project->created_at->format('d/m/Y \à\s H:i') }}
                    </p>
                    
                    <h3 class="text-xs font-bold text-zinc-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                        Descrição da Demanda
                    </h3>
                    
                    <div class="prose prose-invert text-zinc-300 leading-relaxed mb-10 text-sm bg-zinc-950/30 p-4 rounded-lg border border-zinc-800/50">
                        {!! nl2br(e($project->description)) !!}
                    </div>

                    <div class="mt-10">
                        <h3 class="text-xs font-bold text-zinc-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                            Arquivos Enviados ({{ $project->files->count() }})
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
                                <div class="col-span-full py-8 text-center border-2 border-dashed border-zinc-800 rounded-2xl bg-zinc-950/20">
                                    <p class="text-sm text-zinc-600 italic font-medium">Nenhum anexo disponível.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="bg-zinc-900/50 border border-zinc-800 rounded-2xl overflow-hidden shadow-xl backdrop-blur-sm">
                    <div class="p-4 border-b border-zinc-800 bg-zinc-900/80 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                            <h3 class="text-xs font-bold text-white uppercase tracking-widest">Canal de Comunicação</h3>
                        </div>
                    </div>

                    <div class="p-6 h-[450px] overflow-y-auto space-y-4 flex flex-col bg-zinc-950/20 scrollbar-thin scrollbar-thumb-zinc-800 scrollbar-track-transparent">
                        @forelse($project->comments->sortBy('created_at') as $comment)
                            <div class="max-w-[85%] {{ $comment->user_id === auth()->id() ? 'self-end' : 'self-start' }}">
                                <div class="flex items-center gap-2 mb-1 {{ $comment->user_id === auth()->id() ? 'justify-end' : '' }}">
                                    <span class="text-[10px] font-bold text-zinc-500 uppercase">{{ $comment->user->name }}</span>
                                    <span class="text-[10px] text-zinc-600">{{ $comment->created_at->format('H:i') }}</span>
                                </div>
                                <div class="p-3.5 rounded-2xl text-sm shadow-sm {{ $comment->user_id === auth()->id() ? 'bg-blue-600 text-white rounded-tr-none' : 'bg-zinc-800 text-zinc-300 rounded-tl-none border border-zinc-700' }}">
                                    {{ $comment->content }}
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center h-full text-center space-y-3">
                                <svg class="w-12 h-12 text-zinc-800" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                <p class="text-zinc-600 text-sm font-medium">Inicie uma conversa com o cliente abaixo.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="p-4 bg-zinc-900/50 border-t border-zinc-800">
                        <form action="{{ route('projects.comments.store', $project) }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="text" name="content" required placeholder="Escreva sua mensagem aqui..." 
                                class="flex-1 bg-zinc-950 border border-zinc-800 rounded-xl px-4 py-2.5 text-sm text-white focus:outline-none focus:border-blue-500 transition-all placeholder-zinc-600">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-2.5 rounded-xl transition-all shadow-lg shadow-blue-900/20 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9-2-9-18-9 18 9 2zm0 0v-8"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="space-y-6 lg:sticky lg:top-8">
                
                <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl shadow-black/40 backdrop-blur-sm">
                    <h3 class="text-white font-bold mb-6 flex items-center gap-2">
                        <div class="p-1.5 bg-blue-500/10 rounded-lg">
                            <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                        </div>
                        Painel de Controle
                    </h3>

                    <form action="{{ route('admin.projects.update', $project) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-bold text-zinc-500 uppercase tracking-widest mb-2">Status Atual</label>
                            <select name="status" class="bg-zinc-950 border border-zinc-800 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 text-white transition-all">
                                <option value="analise" {{ $project->status == 'analise' ? 'selected' : '' }}>Em Análise</option>
                                <option value="desenvolvimento" {{ $project->status == 'desenvolvimento' ? 'selected' : '' }}>Em Desenvolvimento</option>
                                <option value="homologacao" {{ $project->status == 'homologacao' ? 'selected' : '' }}>Homologação</option>
                                <option value="concluido" {{ $project->status == 'concluido' ? 'selected' : '' }}>Concluído</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-zinc-500 uppercase tracking-widest mb-2">Data Limite (Prazo)</label>
                            <input type="date" name="deadline" value="{{ $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('Y-m-d') : '' }}" 
                                class="bg-zinc-950 border border-zinc-800 text-white text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition-all">
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3.5 px-4 rounded-xl transition-all shadow-lg shadow-blue-900/30 cursor-pointer text-sm">
                            Atualizar Projeto
                        </button>
                    </form>
                </div>

                <div class="bg-zinc-900/30 border border-zinc-800 rounded-2xl p-6">
                    <h3 class="text-zinc-500 text-[10px] uppercase font-bold tracking-widest mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Dados do Cliente
                    </h3>
                    <div class="space-y-3">
                        <p class="text-white text-sm font-semibold truncate">{{ $project->user->name }}</p>
                        <div class="flex items-center gap-2 text-zinc-400 hover:text-blue-400 transition-colors">
                             <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                             <a href="mailto:{{ $project->user->email }}" class="text-xs truncate">{{ $project->user->email }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>