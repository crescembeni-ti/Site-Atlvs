<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Busca os 3 projetos mais recentes do usuário (para a lista rápida)
        $recentProjects = Project::where('user_id', $user->id)
                                ->latest()
                                ->take(3)
                                ->get();

        // 2. Conta quantos projetos estão ativos (que não estão concluídos)
        $activeProjectsCount = Project::where('user_id', $user->id)
                                    ->where('status', '!=', 'concluido')
                                    ->count();

        // 3. Chamados (Por enquanto é 0, pois não criamos a tabela tickets ainda)
        // Quando criar o módulo de suporte, você altera aqui.
        $openTickets = 0;

        return view('dashboard', compact('recentProjects', 'activeProjectsCount', 'openTickets'));
    }
}