<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section>
    <header>
        {{-- Títulos claros para fundo escuro --}}
        <h2 class="text-lg font-bold text-white">
            {{ __('Alterar Senha') }}
        </h2>

        <p class="mt-1 text-sm text-slate-400">
            {{ __('Garanta que sua conta esteja usando uma senha longa e aleatória para manter a segurança.') }}
        </p>
    </header>

    <form wire:submit="updatePassword" class="mt-6 space-y-6">
        
        {{-- Senha Atual --}}
        <div>
            <label for="update_password_current_password" class="block text-sm font-bold text-slate-300 mb-1">{{ __('Senha Atual') }}</label>
            <input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" 
                class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all placeholder-slate-600" 
                autocomplete="current-password" />
            
            @error('current_password') 
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        {{-- Nova Senha --}}
        <div>
            <label for="update_password_password" class="block text-sm font-bold text-slate-300 mb-1">{{ __('Nova Senha') }}</label>
            <input wire:model="password" id="update_password_password" name="password" type="password" 
                class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all placeholder-slate-600" 
                autocomplete="new-password" />
            
            @error('password') 
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        {{-- Confirmar Senha --}}
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-bold text-slate-300 mb-1">{{ __('Confirmar Nova Senha') }}</label>
            <input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" 
                class="w-full bg-slate-900 border border-slate-800 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all placeholder-slate-600" 
                autocomplete="new-password" />
            
            @error('password_confirmation') 
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2.5 px-6 rounded-xl shadow-lg shadow-blue-900/20 transition-all transform hover:-translate-y-0.5">
                {{ __('Salvar Alterações') }}
            </button>

            <x-action-message class="me-3 text-emerald-400 font-medium" on="password-updated">
                {{ __('Senha atualizada com sucesso.') }}
            </x-action-message>
        </div>
    </form>
</section>