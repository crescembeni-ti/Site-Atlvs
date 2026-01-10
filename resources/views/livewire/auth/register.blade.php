<x-layouts.auth>
    <div class="flex flex-col gap-6">
        
        <div class="flex justify-start">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm text-zinc-500 hover:text-white transition-colors group" wire:navigate>
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Voltar ao início</span>
            </a>
        </div>

        <x-auth-header :title="__('Criar uma conta')" :description="__('Insira seus dados abaixo para criar sua conta')" />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-6">
            @csrf
            <flux:input
                name="name"
                :label="__('Nome')"
                :value="old('name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Nome Completo')"
            />

            <flux:input
                name="email"
                :label="__('Endereço de e-mail')"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@exemplo.com"
            />

            <flux:input
                name="password"
                :label="__('Senha')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Senha')"
                viewable
            />

            <flux:input
                name="password_confirmation"
                :label="__('Confirme sua senha')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Confirme sua senha')"
                viewable
            />

            <div class="flex items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                    {{ __('Criar uma conta') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('Já possui uma conta?') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('Entrar') }}</flux:link>
        </div>
    </div>
</x-layouts.auth>