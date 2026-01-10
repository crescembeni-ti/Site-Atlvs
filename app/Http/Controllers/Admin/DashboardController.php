<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Contadores do Topo
        $totalClients = User::where('role', 'client')->count();
        $totalProjects = Project::count();
        $pendingLeads = Contact::where('is_read', false)->count(); // Leads não lidos

        // 2. Projetos Recentes (tabela rápida)
        $recentProjects = Project::with('user')
            ->latest()
            ->take(5)
            ->get();

        // 3. Últimos Leads
        $recentLeads = Contact::latest()
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'totalClients', 
            'totalProjects', 
            'pendingLeads', 
            'recentProjects',
            'recentLeads'
        ));
    }
}