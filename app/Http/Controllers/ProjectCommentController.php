<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectComment;

class ProjectCommentController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $project->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return back()->with('success', 'Mensagem enviada!');
    }
}