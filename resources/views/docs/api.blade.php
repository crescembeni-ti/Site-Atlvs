<x-layouts.app>
    <div class="max-w-4xl mx-auto">
        
        {{-- Cabeçalho --}}
        <div class="mb-10 text-center">
            <div class="inline-flex items-center justify-center p-3 bg-blue-500/10 rounded-2xl mb-4 text-blue-400">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
            </div>
            <h1 class="text-4xl font-bold text-white mb-3">Documentação da API</h1>
            <p class="text-slate-400 text-lg">Guia de integração para desenvolvedores e parceiros.</p>
        </div>

        {{-- Aviso de Autenticação --}}
        <div class="bg-slate-900/50 border border-slate-800 rounded-2xl p-6 mb-8 flex gap-4 items-start">
            <div class="text-yellow-500 mt-1">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <h3 class="text-white font-bold text-lg mb-1">Autenticação Necessária</h3>
                <p class="text-slate-400 text-sm leading-relaxed">
                    Todas as requisições devem incluir seu <strong>Token de Acesso</strong> no cabeçalho. Você pode gerar um novo token na sua área de <a href="{{ route('profile.edit') }}" class="text-blue-400 hover:underline">Configurações de Perfil</a>.
                </p>
                <div class="mt-4 bg-slate-950 rounded-lg p-3 border border-slate-800 font-mono text-xs text-blue-300">
                    Authorization: Bearer {SEU_TOKEN_AQUI}
                </div>
            </div>
        </div>

        {{-- Endpoints (Exemplo) --}}
        <div class="space-y-6">
            
            {{-- Endpoint 1 --}}
            <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">
                <div class="p-4 bg-slate-950/50 border-b border-slate-800 flex items-center gap-3">
                    <span class="bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 px-2 py-1 rounded text-xs font-bold uppercase">GET</span>
                    <code class="text-slate-200 font-mono text-sm">/api/v1/projects</code>
                </div>
                <div class="p-6">
                    <p class="text-slate-400 text-sm mb-4">Retorna uma lista paginada de todos os seus projetos ativos.</p>
                    
                    <h4 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Exemplo de Resposta</h4>
                    <div class="bg-slate-950 rounded-xl p-4 border border-slate-800 overflow-x-auto">
<pre class="text-xs font-mono text-slate-300">
{
  "data": [
    {
      "id": 1,
      "name": "E-commerce Redesign",
      "status": "active",
      "created_at": "2024-03-15T10:00:00Z"
    }
  ],
  "meta": {
    "total": 1
  }
}
</pre>
                    </div>
                </div>
            </div>

            {{-- Endpoint 2 --}}
            <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">
                <div class="p-4 bg-slate-950/50 border-b border-slate-800 flex items-center gap-3">
                    <span class="bg-blue-500/10 text-blue-400 border border-blue-500/20 px-2 py-1 rounded text-xs font-bold uppercase">POST</span>
                    <code class="text-slate-200 font-mono text-sm">/api/v1/tickets</code>
                </div>
                <div class="p-6">
                    <p class="text-slate-400 text-sm mb-4">Cria um novo chamado de suporte automaticamente.</p>
                </div>
            </div>

        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('dashboard') }}" class="text-slate-500 hover:text-white text-sm transition-colors">
                &larr; Voltar para o Dashboard
            </a>
        </div>
    </div>
</x-layouts.app>