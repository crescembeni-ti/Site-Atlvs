<x-layouts.app>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Gestão de Projetos</h1>
        <p class="text-zinc-400">Visão global de todas as demandas da software house.</p>
    </div>

    <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-zinc-400">
                <thead class="bg-zinc-900/80 text-xs uppercase font-medium text-zinc-500">
                    <tr>
                        <th class="px-6 py-4">Projeto</th>
                        <th class="px-6 py-4">Cliente</th>
                        <th class="px-6 py-4">Status Atual</th>
                        <th class="px-6 py-4">Prazo</th>
                        <th class="px-6 py-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-800">
                    @forelse($projects as $project)
                        <tr class="hover:bg-zinc-800/30 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="font-bold text-white block">{{ $project->name }}</span>
                                <span class="text-xs text-zinc-500">Criado em {{ $project->created_at->format('d/m/Y') }}</span>
                            </td>
                            
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded bg-zinc-800 flex items-center justify-center text-xs font-bold text-zinc-400">
                                        {{ $project->user->initials() }}
                                    </div>
                                    <span class="text-zinc-300">{{ $project->user->name }}</span>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <form action="{{ route('admin.projects.update', $project) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="bg-zinc-950 border-zinc-700 text-xs rounded-lg py-1 px-2 focus:ring-blue-500 focus:border-blue-500 block w-full">
                                        <option value="analise" {{ $project->status == 'analise' ? 'selected' : '' }}>Em Análise</option>
                                        <option value="desenvolvimento" {{ $project->status == 'desenvolvimento' ? 'selected' : '' }}>Desenvolvimento</option>
                                        <option value="homologacao" {{ $project->status == 'homologacao' ? 'selected' : '' }}>Homologação</option>
                                        <option value="concluido" {{ $project->status == 'concluido' ? 'selected' : '' }}>Concluído</option>
                                    </select>
                                </form>
                            </td>

                            <td class="px-6 py-4">
                                {{ $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('d/m/Y') : '-' }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.projects.show', $project) }}" class="inline-block text-zinc-500 hover:text-blue-400 transition-colors p-2 hover:bg-blue-500/10 rounded-lg" title="Ver Detalhes e Editar">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-zinc-500">
                                Nenhum projeto cadastrado no sistema.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>