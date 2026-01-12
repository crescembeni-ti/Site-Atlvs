<x-layouts.app>
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-white mb-6">Novo Projeto Oficial</h1>
        
        <form action="{{ route('admin.projects.store') }}" method="POST" class="bg-slate-900/50 border border-slate-800 rounded-2xl p-8">
            @csrf
            
            <div class="space-y-6">
                {{-- Selecionar Cliente --}}
                <div>
                    <label class="block text-sm font-bold text-slate-300 mb-2">Vincular ao Cliente</label>
                    <select name="user_id" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white focus:border-blue-500">
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->email }})</option>
                        @endforeach
                    </select>
                </div>

                {{-- Nome do Projeto --}}
                <div>
                    <label class="block text-sm font-bold text-slate-300 mb-2">Nome do Projeto</label>
                    <input type="text" name="name" required class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white">
                </div>

                {{-- Status Inicial --}}
                <div>
                    <label class="block text-sm font-bold text-slate-300 mb-2">Status Inicial</label>
                    <select name="status" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white">
                        <option value="ativo">Ativo (Já iniciou)</option>
                        <option value="pausado">Pausado (Aguardando algo)</option>
                    </select>
                </div>

                {{-- Descrição --}}
                <div>
                    <label class="block text-sm font-bold text-slate-300 mb-2">Descrição Interna</label>
                    <textarea name="description" rows="4" class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white"></textarea>
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 rounded-xl">
                    Oficializar Projeto
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>