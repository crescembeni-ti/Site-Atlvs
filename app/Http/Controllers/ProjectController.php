<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectFile;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Lista os projetos do usuário logado.
     */
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())
                          ->orderBy('created_at', 'desc')
                          ->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Mostra o formulário de novo projeto.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Salva o projeto e os anexos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'attachments.*' => 'nullable|file|max:10240', // Máx 10MB por arquivo
        ]);

        // Cria o projeto vinculado ao usuário
        $project = auth()->user()->projects()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'status' => 'analise', // Padrão inicial
        ]);

        // Lógica de Upload de Arquivos
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                // Salva na pasta 'projects/{id}' dentro do disco 'public'
                $path = $file->store('projects/' . $project->id, 'public');

                ProjectFile::create([
                    'project_id' => $project->id,
                    'original_name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('projects.index')->with('success', 'Projeto criado com anexos!');
    }

    /**
     * Exibe os detalhes do projeto.
     */
    public function show(Project $project)
    {
        // SEGURANÇA: Garante que o usuário só veja os SEUS próprios projetos
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para acessar este projeto.');
        }

        return view('projects.show', compact('project'));
    }
}