<x-layouts.app>
    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-bold text-white mb-1">Leads & Contatos</h1>
            <p class="text-slate-400">Mensagens recebidas através do formulário do site.</p>
        </div>
        
        {{-- Card de Resumo Rápido --}}
        <div class="flex gap-4">
            <div class="bg-blue-600/10 border border-blue-600/20 px-4 py-2 rounded-lg text-blue-400 text-sm font-bold flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                {{ $contacts->where('is_read', false)->count() }} Novas
            </div>
            <div class="bg-slate-900 border border-slate-800 px-4 py-2 rounded-lg text-slate-400 text-sm">
                Total: {{ $contacts->total() }}
            </div>
        </div>
    </div>

    <div class="bg-slate-900/50 border border-slate-800 rounded-2xl overflow-hidden shadow-xl backdrop-blur-sm">
        @if($contacts->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-400">
                    <thead class="bg-slate-900/80 text-slate-200 uppercase font-bold text-xs">
                        <tr>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Remetente</th>
                            <th class="px-6 py-4">Assunto / Mensagem</th>
                            <th class="px-6 py-4">Data</th>
                            <th class="px-6 py-4 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @foreach($contacts as $contact)
                            <tr class="group hover:bg-slate-800/30 transition-colors {{ $contact->is_read ? 'opacity-70' : 'bg-blue-500/5' }}">
                                <td class="px-6 py-4">
                                    @if(!$contact->is_read)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide bg-blue-500 text-white shadow-lg shadow-blue-500/30">
                                            Nova
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide bg-slate-800 text-slate-400 border border-slate-700">
                                            Lida
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-white mb-0.5">{{ $contact->name }}</div>
                                    <div class="text-xs text-slate-500 font-mono">{{ $contact->email }}</div>
                                    @if($contact->phone)
                                        <div class="text-xs text-slate-600 mt-1">{{ $contact->phone }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 max-w-md">
                                    <div class="font-bold text-slate-200 mb-1">{{ $contact->subject }}</div>
                                    <div class="text-slate-400 text-xs leading-relaxed line-clamp-2 group-hover:line-clamp-none transition-all">
                                        {{ $contact->message }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-xs whitespace-nowrap">
                                    <div class="text-slate-300">{{ $contact->created_at->format('d/m/Y') }}</div>
                                    <div class="text-slate-600">{{ $contact->created_at->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        {{-- Botão Marcar como Lido/Não Lido --}}
                                        <form action="{{ route('admin.leads.toggle', $contact) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="p-2 rounded-lg hover:bg-slate-700 transition-colors {{ $contact->is_read ? 'text-slate-500' : 'text-blue-400 hover:text-white' }}" title="{{ $contact->is_read ? 'Marcar como não lido' : 'Marcar como lido' }}">
                                                @if($contact->is_read)
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/></svg>
                                                @else
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/></svg>
                                                @endif
                                            </button>
                                        </form>

                                        {{-- Botão Excluir --}}
                                        <form action="{{ route('admin.leads.destroy', $contact) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja apagar esta mensagem?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg hover:bg-red-500/20 text-slate-600 hover:text-red-500 transition-colors" title="Excluir">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- Paginação --}}
            <div class="px-6 py-4 border-t border-slate-800">
                {{ $contacts->links() }}
            </div>
        @else
            <div class="p-12 text-center flex flex-col items-center justify-center">
                <div class="w-16 h-16 bg-slate-800 rounded-2xl flex items-center justify-center mb-4 text-slate-600">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-1">Nenhum contato recebido</h3>
                <p class="text-slate-500 max-w-sm">Sua caixa de entrada de leads está vazia no momento.</p>
            </div>
        @endif
    </div>
</x-layouts.app>