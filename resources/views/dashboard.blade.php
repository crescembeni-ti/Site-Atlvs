<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        {{-- Cards superiores --}}
        <div class="grid auto-rows-min gap-6 md:grid-cols-3">

            {{-- Card: Contatos --}}
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-900">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Contatos recebidos
                </h3>

                <div class="mt-4 text-3xl font-bold">
                    {{ \App\Models\Contact::count() }}
                </div>

                <a
                    href="{{ route('dashboard.contacts') }}"
                    wire:navigate
                    class="mt-4 inline-block text-sm font-medium text-cyan-500 hover:underline"
                >
                    Ver todos →
                </a>
            </div>

            {{-- Card: Novos hoje --}}
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-900">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Novos hoje
                </h3>

                <div class="mt-4 text-3xl font-bold">
                    {{ \App\Models\Contact::whereDate('created_at', today())->count() }}
                </div>
            </div>

            {{-- Card: Status --}}
            <div class="rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-900">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    Sistema
                </h3>

                <div class="mt-4 text-lg font-semibold text-green-500">
                    Online
                </div>
            </div>

        </div>

        {{-- Área principal --}}
        <div class="flex-1 rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-zinc-900">
            <h2 class="mb-4 text-lg font-semibold">
                Últimos contatos
            </h2>

            @php
                $contacts = \App\Models\Contact::latest()->limit(5)->get();
            @endphp

            @forelse($contacts as $contact)
                <div class="border-b border-neutral-200 py-3 last:border-0 dark:border-neutral-700">
                    <div class="font-medium">{{ $contact->name }}</div>
                    <div class="text-sm text-gray-500">{{ $contact->email }}</div>
                </div>
            @empty
                <p class="text-sm text-gray-500">
                    Nenhum contato recebido ainda.
                </p>
            @endforelse
        </div>

    </div>
</x-layouts.app>
