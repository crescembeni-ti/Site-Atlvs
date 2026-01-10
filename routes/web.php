<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Dashboard\ContactController as DashboardContactController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

/*
|--------------------------------------------------------------------------
| ADMIN AUTH (Acesso Exclusivo Funcionários)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/atlvs-staff', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('/atlvs-staff', [AdminLoginController::class, 'store'])->name('admin.login.store');
});

Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');

Route::post('/projetos/{project}/comentarios', [ProjectCommentController::class, 'store'])->name('projects.comments.store');

/*
|--------------------------------------------------------------------------
| ÁREA ADMINISTRATIVA (Protegida por Cargo)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    
    // 1. Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // 2. Leads (Contatos do Site)
    Route::get('/leads', [DashboardContactController::class, 'index'])->name('admin.leads');
    Route::patch('/leads/{contact}/toggle', [DashboardContactController::class, 'toggleRead'])->name('admin.leads.toggle');

    // 3. Gestão de Projetos
    Route::get('/projetos', [App\Http\Controllers\Admin\ProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('/projetos/{project}', [App\Http\Controllers\Admin\ProjectController::class, 'show'])->name('admin.projects.show');
    Route::put('/projetos/{project}', [App\Http\Controllers\Admin\ProjectController::class, 'update'])->name('admin.projects.update');

});


/*
|--------------------------------------------------------------------------
| ÁREA PÚBLICA (Site Institucional)
|--------------------------------------------------------------------------
*/
Route::view('/', 'welcome')->name('home');
Route::view('/contato', 'contact')->name('contact');

// IMPORTANTE: Aqui definimos o nome da rota como 'contact.send'
Route::post('/contato', [ContactController::class, 'send'])->name('contact.send');


/*
|--------------------------------------------------------------------------
| ÁREA DO CLIENTE (Dashboard Padrão)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Dashboard Principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Meus Projetos
    Route::get('/meus-projetos', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/meus-projetos/novo', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/meus-projetos', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/meus-projetos/{project}', [ProjectController::class, 'show'])->name('projects.show');
});


/*
|--------------------------------------------------------------------------
| CONFIGURAÇÕES DO USUÁRIO
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::redirect('/settings', '/settings/profile');

    Volt::route('/settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('/settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('/settings/appearance', 'settings.appearance')->name('appearance.edit');
    
    Volt::route('/settings/two-factor', 'settings.two-factor')
        ->middleware(when(
            Features::canManageTwoFactorAuthentication() && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
            ['password.confirm'],
            []
        ))->name('two-factor.show');
});