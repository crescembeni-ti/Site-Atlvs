<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\ProjectFile;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        // Busca apenas os projetos do usuário logado
        $projects = Project::where('user_id', Auth::id())
                          ->orderBy('created_at', 'desc')
                          ->get();

        return view('projects.index', compact('projects'));
    }


    // ... (Mantenha a função index que já existe)

    // 1. Mostrar a tela do formulário
    public function create()
    {
        return view('projects.create');
    }

    // 2. Receber os dados e salvar no banco
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'attachments.*' => 'nullable|file|max:10240', // Máx 10MB por arquivo
    ]);

    $project = auth()->user()->projects()->create([
        'name' => $validated['name'],
        'description' => $validated['description'],
        'status' => 'analise',
    ]);

    // Lógica de Upload
    if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $file) {
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

    public function show(Project $project)
    {
        // SEGURANÇA: Garante que o usuário só veja os SEUS próprios projetos
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Você não tem permissão para acessar este projeto.');
        }

        return view('projects.show', compact('project'));
    }
    
}