<x-layouts.app>
    <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('projects.index') }}" class="text-sm text-zinc-500 hover:text-white transition-colors flex items-center gap-2 mb-4">
                &larr; Voltar para meus projetos
            </a>
            <h1 class="text-3xl font-bold text-white">Novo Projeto</h1>
            <p class="text-zinc-400">Descreva sua necessidade e anexe arquivos de referência.</p>
        </div>

        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6 space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-zinc-300 mb-2">Nome do Projeto</label>
                    <input type="text" name="name" id="name" required placeholder="Ex: Redesign do E-commerce" 
                        class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-zinc-300 mb-2">Descrição Detalhada</label>
                    <textarea name="description" id="description" rows="6" required placeholder="Conte-nos os detalhes, objetivos e requisitos..." 
                        class="w-full bg-zinc-950 border border-zinc-800 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-blue-500 transition-all resize-none"></textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl p-6">
                <label class="block text-sm font-medium text-zinc-300 mb-4 tracking-wide uppercase text-xs">Anexos e Referências</label>
                
                <div class="relative group">
                    <input type="file" name="attachments[]" id="attachments" multiple 
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    
                    <div class="border-2 border-dashed border-zinc-800 group-hover:border-blue-500/50 group-hover:bg-blue-500/5 rounded-xl p-8 transition-all text-center">
                        <div class="bg-zinc-800 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-zinc-400 group-hover:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                        </div>
                        <p class="text-white font-medium">Clique ou arraste arquivos aqui</p>
                        <p class="text-xs text-zinc-500 mt-1">PDF, PNG, JPG ou ZIP (Máx. 10MB cada)</p>
                    </div>
                </div>

                <div id="file-list" class="mt-4 space-y-2"></div>
            </div>

            <div class="flex items-center justify-end gap-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-8 rounded-lg transition-all shadow-lg shadow-blue-900/20">
                    Solicitar Orçamento
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('attachments').addEventListener('change', function(e) {
            const list = document.getElementById('file-list');
            list.innerHTML = '';
            for (let i = 0; i < this.files.length; i++) {
                const item = document.createElement('div');
                item.className = 'text-xs text-zinc-400 bg-zinc-800/50 px-3 py-2 rounded border border-zinc-700 flex items-center gap-2';
                item.innerHTML = `<svg class="w-4 h-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg> ${this.files[i].name}`;
                list.appendChild(item);
            }
        });
    </script>
</x-layouts.app>