@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-2xl font-bold mb-6">Contatos Recebidos</h1>

    <div class="overflow-x-auto rounded-lg border border-white/10">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-white/5 text-gray-300">
                <tr>
                    <th class="px-4 py-3">Nome</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Mensagem</th>
                    <th class="px-4 py-3">Data</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @forelse($contacts as $contact)
                    <tr class="hover:bg-white/5">
                        <td class="px-4 py-3">{{ $contact->name }}</td>
                        <td class="px-4 py-3">{{ $contact->email }}</td>
                        <td class="px-4 py-3 max-w-md truncate">
                            {{ $contact->message }}
                        </td>
                        <td class="px-4 py-3">
                            {{ $contact->created_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-400">
                            Nenhum contato recebido ainda.
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
@endsection
