<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project; // <--- OBRIGATÓRIO: Importar o Model Project
use App\Models\ProjectComment;

class ProjectCommentController extends Controller
{
    public function store(Request $request, Project $project)
    {
        // 1. Validação
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // 2. Criação do Comentário
        $project->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        // 3. Redirecionamento Inteligente
        // Se quem enviou for admin, volta pro painel admin. Se for cliente, volta pro painel do cliente.
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.projects.show', $project)
                ->with('success', 'Mensagem enviada!');
        }

        return redirect()->route('projects.show', $project)
            ->with('success', 'Mensagem enviada!');
    }
}