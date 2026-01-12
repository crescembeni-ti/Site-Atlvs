<x-layouts.app>
    <div class="max-w-2xl mx-auto">
        <div class="mb-8 text-center">
            <div class="inline-flex items-center justify-center p-3 bg-blue-600/10 rounded-2xl mb-4 text-blue-500">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Solicitar Orçamento</h1>
            <p class="text-slate-400">Descreva sua ideia e nossa equipe técnica fará uma análise de viabilidade e custos.</p>
        </div>

        <form action="{{ route('tickets.store') }}" method="POST" class="bg-slate-900/50 border border-slate-800 rounded-2xl p-8 shadow-xl">
            @csrf
            {{-- Campo Oculto para definir que é Orçamento --}}
            <input type="hidden" name="category" value="orcamento">
            <input type="hidden" name="priority" value="media">

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-slate-300 mb-2">Nome do Projeto / Ideia</label>
                    <input type="text" name="subject" required placeholder="Ex: E-commerce de Sapatos, App de Delivery..." 
                        class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all placeholder-slate-600">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-300 mb-2">Detalhes do Escopo</label>
                    <textarea name="message" rows="6" required placeholder="Conte-nos mais sobre o que você precisa. Quais funcionalidades são essenciais? Tem algum site como referência?" 
                        class="w-full bg-slate-950 border border-slate-700 rounded-xl px-4 py-3 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all placeholder-slate-600 resize-none"></textarea>
                    <p class="text-xs text-slate-500 mt-2">Após o envio, nossa equipe entrará em contato pelo chat para agendar uma vistoria ou conversa inicial.</p>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-900/20 transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <span>Enviar Solicitação</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-layouts.app>