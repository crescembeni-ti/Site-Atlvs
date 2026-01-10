<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('user')->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    // A MÁGICA ACONTECE AQUI
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'status' => 'required|in:analise,desenvolvimento,homologacao,concluido',
            'deadline' => 'nullable|date',
        ]);

        // 1. Capturar os valores ANTIGOS antes de atualizar
        $oldStatus = $project->status;
        $oldDeadline = $project->deadline;

        // 2. Atualizar o projeto
        $project->update($validated);

        // 3. Verificar se o STATUS mudou e criar comentário automático
        if ($oldStatus !== $project->status) {
            $labels = [
                'analise' => 'EM ANÁLISE',
                'desenvolvimento' => 'EM DESENVOLVIMENTO',
                'homologacao' => 'HOMOLOGAÇÃO',
                'concluido' => 'CONCLUÍDO',
            ];
            
            $newLabel = $labels[$project->status] ?? $project->status;

            $project->comments()->create([
                'user_id' => auth()->id(), // Postado em seu nome
                'content' => "🔄 ATUALIZAÇÃO DE STATUS: O projeto avançou para a etapa de {$newLabel}.",
            ]);
        }

        // 4. Verificar se o PRAZO mudou e criar comentário automático
        // A lógica ($oldDeadline != $project->deadline) detecta qualquer mudança de data
        if ($project->deadline && $oldDeadline != $project->deadline) {
            $formattedDate = Carbon::parse($project->deadline)->format('d/m/Y');
            
            $project->comments()->create([
                'user_id' => auth()->id(),
                'content' => "📅 ATUALIZAÇÃO DE PRAZO: A previsão de entrega foi ajustada para {$formattedDate}.",
            ]);
        }

        return back()->with('success', 'Projeto atualizado e cliente notificado na timeline!');
    }
}