<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

// Controllers Públicos e Gerais
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController; // Controller do Cliente
use App\Http\Controllers\ProjectCommentController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\ContratosController;

// Controllers do Admin
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Dashboard\ContactController as DashboardContactController; // Leads
use App\Http\Controllers\Admin\ProjectController as AdminProjectController; // Alias para evitar conflito

/*
|--------------------------------------------------------------------------
| ÁREA PÚBLICA (Site Institucional)
|--------------------------------------------------------------------------
*/
Route::view('/', 'welcome')->name('home');
Route::view('/contato', 'contact')->name('contact');
Route::post('/contato', [ContactController::class, 'send'])->name('contact.send');

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


/*
|--------------------------------------------------------------------------
| ROTAS AUTENTICADAS GERAIS (Admin + Cliente)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // --- INTERAÇÕES NO PROJETO (CHAT) ---
    // Serve tanto para o Admin quanto para o Cliente
    
    // Enviar Mensagem
    Route::post('/projetos/{project}/comentarios', [ProjectCommentController::class, 'store'])
        ->name('projects.comments.store');

    // [NOVA ROTA] Atualização Automática (Polling)
    Route::get('/projects/{project}/messages', [ProjectCommentController::class, 'indexMessages'])
        ->name('projects.comments.index');
});


/*
|--------------------------------------------------------------------------
| ÁREA ADMINISTRATIVA (Protegida por Cargo 'admin')
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    
    // 1. Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // 2. Leads (Contatos do Site)
    Route::get('/leads', [DashboardContactController::class, 'index'])->name('admin.leads');
    Route::patch('/leads/{contact}/toggle', [DashboardContactController::class, 'toggleRead'])->name('admin.leads.toggle');

    // 3. Gestão de Projetos (Visão do Admin)
    // Note que usamos o AdminProjectController aqui
    Route::get('/projetos', [AdminProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('/projetos/{project}', [AdminProjectController::class, 'show'])->name('admin.projects.show');
    Route::put('/projetos/{project}', [AdminProjectController::class, 'update'])->name('admin.projects.update');
});


/*
|--------------------------------------------------------------------------
| ÁREA DO CLIENTE (Dashboard Padrão)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Dashboard Principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Meus Projetos (Visão do Cliente)
    Route::get('/meus-projetos', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/meus-projetos/novo', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/meus-projetos', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/meus-projetos/{project}', [ProjectController::class, 'show'])->name('projects.show');
});
    

/*
|--------------------------------------------------------------------------
| CONFIGURAÇÕES DO USUÁRIO (Perfil, Senha, 2FA)
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