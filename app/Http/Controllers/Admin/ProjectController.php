<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User; // <--- Importante: Adicionei o User para listar clientes
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('user')->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    // --- NOVOS MÉTODOS PARA CRIAR PROJETO ---

    // 1. Tela de Criação (Formulário)
    public function create()
    {
        // Busca apenas usuários que são clientes para o dropdown
        $clients = User::where('role', 'cliente')->get();
        
        return view('admin.projects.create', compact('clients'));
    }

    // 2. Salvar o Novo Projeto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Alinhado com os status que você já usa no update
            'status' => 'required|in:analise,desenvolvimento,homologacao,concluido', 
            'user_id' => 'required|exists:users,id', // Vincula ao cliente X
            'deadline' => 'nullable|date',
        ]);

        $project = Project::create($validated);

        // Opcional: Criar um comentário inicial automático na timeline
        $project->comments()->create([
            'user_id' => auth()->id(),
            'content' => "🚀 PROJETO INICIADO: O projeto foi oficialmente criado e está na etapa de " . strtoupper($project->status) . ".",
        ]);

        return redirect()->route('admin.projects.show', $project)
            ->with('success', 'Projeto oficializado e vinculado ao cliente!');
    }

    // ----------------------------------------

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    // A MÁGICA ACONTECE AQUI (Mantive intacto)
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