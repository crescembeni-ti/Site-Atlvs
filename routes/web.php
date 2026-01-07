<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Site Institucional - ATLVS
|--------------------------------------------------------------------------
*/
Route::view('/', 'home')->name('home');

/*
|--------------------------------------------------------------------------
| Contato (Landing Page)
|--------------------------------------------------------------------------
| GET: redireciona para âncora
| POST: envia formulário
*/
Route::get('/contato', function () {
    return redirect('/#contato');
});

Route::post('/contato', [ContactController::class, 'send'])
    ->name('contact.send');

/*
|--------------------------------------------------------------------------
| Dashboard (Área autenticada)
|--------------------------------------------------------------------------
*/
Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Configurações do Usuário (Volt)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::redirect('/settings', '/settings/profile');

    Volt::route('/settings/profile', 'settings.profile')
        ->name('profile.edit');

    Volt::route('/settings/password', 'settings.password')
        ->name('user-password.edit');

    Volt::route('/settings/appearance', 'settings.appearance')
        ->name('appearance.edit');

    Volt::route('/settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                && Features::optionEnabled(
                    Features::twoFactorAuthentication(),
                    'confirmPassword'
                ),
                ['password.confirm'],
                [],
            )
        )
        ->name('two-factor.show');
});
