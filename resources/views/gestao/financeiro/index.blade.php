<x-layouts.app>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Financeiro</h1>
        <p class="text-slate-400">Gerencie suas faturas e emita segundas vias.</p>
    </div>

    {{-- Cards de Resumo --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Card: Em Aberto --}}
        <div class="bg-slate-900/50 border border-slate-800 p-6 rounded-2xl relative overflow-hidden">
            <div class="absolute right-0 top-0 p-4 opacity-10">
                <svg class="w-16 h-16 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-slate-400 text-sm font-medium uppercase tracking-wider">Total em Aberto</p>
            <p class="text-3xl font-bold text-white mt-1">R$ {{ number_format($invoices->where('status', 'pending')->sum('amount'), 2, ',', '.') }}</p>
        </div>

        {{-- Card: Vencidos --}}
        <div class="bg-slate-900/50 border border-slate-800 p-6 rounded-2xl relative overflow-hidden">
             <div class="absolute right-0 top-0 p-4 opacity-10">
                <svg class="w-16 h-16 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <p class="text-slate-400 text-sm font-medium uppercase tracking-wider">Vencido</p>
            <p class="text-3xl font-bold text-white mt-1">R$ {{ number_format($invoices->where('status', 'overdue')->sum('amount'), 2, ',', '.') }}</p>
        </div>
    </div>

    {{-- Tabela de Faturas --}}
    <div class="bg-slate-900/50 border border-slate-800 rounded-2xl overflow-hidden shadow-xl backdrop-blur-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-400">
                <thead class="bg-slate-900/80 text-slate-200 uppercase font-bold text-xs">
                    <tr>
                        <th class="px-6 py-4">Fatura</th>
                        <th class="px-6 py-4">Descrição</th>
                        <th class="px-6 py-4">Vencimento</th>
                        <th class="px-6 py-4">Valor</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse($invoices as $invoice)
                        <tr class="hover:bg-slate-800/30 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs text-slate-500">
                                #{{ $invoice['id'] }}
                            </td>
                            <td class="px-6 py-4 font-bold text-white">
                                {{ $invoice['description'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $invoice['due_date']->format('d/m/Y') }}
                                @if($invoice['status'] == 'pending' && $invoice['due_date']->isToday())
                                    <span class="text-yellow-500 text-xs font-bold ml-2">(Vence Hoje)</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-200">
                                R$ {{ number_format($invoice['amount'], 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                @if($invoice['status'] == 'paid')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Pago
                                    </span>
                                @elseif($invoice['status'] == 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span> Em Aberto
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide bg-red-500/10 text-red-400 border border-red-500/20">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span> Atrasado
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($invoice['status'] != 'paid')
                                    <a href="#" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold py-2 px-4 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                        Boleto / PDF
                                    </a>
                                @else
                                    <a href="#" class="text-slate-500 hover:text-white text-xs font-bold transition-colors">
                                        Ver Recibo
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                Nenhuma fatura encontrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>