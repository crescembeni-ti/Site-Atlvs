<x-layouts.app>
    <div class="max-w-5xl mx-auto">
        
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('admin.projects.index') }}" class="text-sm text-zinc-500 hover:text-white flex items-center gap-2 transition-colors">
                &larr; Voltar para a lista
            </a>
            
            <div class="flex items-center gap-3">
                <span class="text-zinc-500 text-sm">Cliente:</span>
                <div class="flex items-center gap-2 bg-zinc-900 border border-zinc-800 rounded-full px-3 py-1">
                    <div class="w-5 h-5 rounded-full bg-blue-600 flex items-center justify-center text-[10px] font-bold text-white">
                        {{ $project->user->initials() }}
                    </div>
                    <span class="text-sm font-medium text-white">{{ $project->user->name }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-8">
                    <h1 class="text-3xl font-bold text-white mb-2">{{ $project->name }}</h1>
                    <p class="text-xs text-zinc-500 mb-6">Solicitado em {{ $project->created_at->format('d/m/Y \à\s H:i') }}</p>
                    
                    <h3 class="text-sm font-bold text-zinc-400 uppercase tracking-wider mb-4 border-b border-zinc-800 pb-2">
                        Descrição da Demanda
                    </h3>
                    
                    <div class="prose prose-invert text-zinc-300 leading-relaxed mb-8">
                        {!! nl2br(e($project->description)) !!}
                    </div>

                    <div class="mt-10">
                        <h3 class="text-sm font-bold text-zinc-400 uppercase tracking-wider mb-4 border-b border-zinc-800 pb-2">
                            Anexos e Documentos ({{ $project->files->count() }})
                        </h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @forelse($project->files as $file)
                                <div class="bg-zinc-950 border border-zinc-800 p-4 rounded-xl flex items-center justify-between group hover:border-blue-500/50 transition-all">
                                    <div class="flex items-center gap-3 overflow-hidden">
                                        <div class="bg-zinc-900 p-2 rounded-lg text-blue-400">
                                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <div class="overflow-hidden text-ellipsis">
                                            <p class="text-sm text-zinc-200 font-medium truncate" title="{{ $file->original_name }}">
                                                {{ $file->original_name }}
                                            </p>
                                            <p class="text-[10px] text-zinc-500 uppercase">
                                                {{ number_format($file->size / 1024 / 1024, 2) }} MB
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ Storage::url($file->path) }}" target="_blank" download="{{ $file->original_name }}" 
                                       class="bg-zinc-800 hover:bg-blue-600 p-2 rounded-lg text-zinc-400 hover:text-white transition-all shadow-lg">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                    </a>
                                </div>
                            @empty
                                <div class="col-span-full py-6 text-center border-2 border-dashed border-zinc-800 rounded-xl">
                                    <p class="text-sm text-zinc-600 italic font-medium tracking-wide">Nenhum anexo disponível para este projeto.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6 shadow-lg shadow-black/20">
                    <h3 class="text-white font-bold mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                        Painel de Controle
                    </h3>

                    <form action="{{ route('admin.projects.update', $project) }}" method="POST" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium text-zinc-400 mb-2">Status do Projeto</label>
                            <select name="status" class="bg-zinc-950 border border-zinc-700 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 text-white">
                                <option value="analise" {{ $project->status == 'analise' ? 'selected' : '' }}>Em Análise</option>
                                <option value="desenvolvimento" {{ $project->status == 'desenvolvimento' ? 'selected' : '' }}>Em Desenvolvimento</option>
                                <option value="homologacao" {{ $project->status == 'homologacao' ? 'selected' : '' }}>Homologação</option>
                                <option value="concluido" {{ $project->status == 'concluido' ? 'selected' : '' }}>Concluído</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-zinc-400 mb-2">Prazo de Entrega</label>
                            <input type="date" name="deadline" value="{{ $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('Y-m-d') : '' }}" class="bg-zinc-950 border border-zinc-700 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-2.5 px-4 rounded-lg transition-colors shadow-lg shadow-blue-900/20 cursor-pointer">
                                Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>

                <div class="bg-zinc-900/30 border border-zinc-800 rounded-xl p-6">
                    <h3 class="text-zinc-500 text-xs uppercase font-bold mb-3">Contato do Cliente</h3>
                    <div class="space-y-2 text-sm text-zinc-300">
                        <div class="flex items-center gap-2">
                             <svg class="w-4 h-4 text-zinc-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                             <a href="mailto:{{ $project->user->email }}" class="hover:text-blue-400 transition-colors">{{ $project->user->email }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>