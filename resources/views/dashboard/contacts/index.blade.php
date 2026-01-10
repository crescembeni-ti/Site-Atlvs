<x-layouts.app>
    <div class="max-w-7xl mx-auto px-6 py-10">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-white">Contatos Recebidos</h1>
            <span class="text-sm text-zinc-500">Gerencie os leads do site</span>
        </div>

        <div class="overflow-x-auto rounded-lg border border-white/10 bg-zinc-900/50">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-white/5 text-gray-300 uppercase text-xs font-medium">
                    <tr>
                        <th class="px-4 py-3">Nome</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Mensagem</th>
                        <th class="px-4 py-3">Data</th>
                        <th class="px-4 py-3 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($contacts as $contact)
                        {{-- LÓGICA VISUAL: Se lido, fica mais apagado (opacity-50) --}}
                        <tr class="transition-colors {{ $contact->is_read ? 'bg-zinc-950/50 opacity-50' : 'hover:bg-white/5' }}">
                            
                            <td class="px-4 py-3 text-white font-medium">{{ $contact->name }}</td>
                            <td class="px-4 py-3 text-zinc-400">{{ $contact->email }}</td>
                            
                            <td class="px-4 py-3 max-w-md text-zinc-300">
                                <div class="truncate w-64" title="{{ $contact->message }}">
                                    {{ $contact->message }}
                                </div>
                            </td>
                            
                            <td class="px-4 py-3 text-zinc-500 whitespace-nowrap">
                                {{ $contact->created_at->format('d/m/Y H:i') }}
                            </td>

                            {{-- COLUNA DE AÇÕES --}}
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    
                                    <form action="{{ route('admin.leads.toggle', $contact) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                            class="p-2 rounded-lg transition-colors {{ $contact->is_read ? 'text-green-500 hover:text-green-400' : 'text-zinc-400 bg-white/5 hover:bg-white/10 hover:text-white' }}" 
                                            title="{{ $contact->is_read ? 'Marcar como não lido' : 'Marcar como lido' }}">
                                            
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>
                                    </form>

                                    <a href="mailto:{{ $contact->email }}" class="text-blue-400 hover:text-blue-300 p-2 hover:bg-blue-500/10 rounded-lg transition-colors" title="Responder por E-mail">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center text-zinc-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-10 h-10 mb-3 text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p>Nenhum contato recebido ainda.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $contacts->links() }}
        </div>

    </div>
</x-layouts.app>