<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // Busca TODOS os projetos, trazendo junto o nome do Dono (user)
        // Ordena pelos mais recentes
        $projects = Project::with('user')->latest()->get();

        return view('admin.projects.index', compact('projects'));
    }

    // Função para atualizar o status (Faremos a tela disso no próximo passo)
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'status' => 'required|in:analise,desenvolvimento,homologacao,concluido',
            'deadline' => 'nullable|date',
        ]);

        $project->update($data);

        return back()->with('success', 'Projeto atualizado com sucesso!');
    }

    public function show(Project $project)
    {
        // Carrega o projeto com os dados do dono (user)
        $project->load('user');
        
        return view('admin.projects.show', compact('project'));
    }
}