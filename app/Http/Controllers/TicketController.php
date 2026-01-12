<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TicketMessage;

class TicketController extends Controller
{
    // 1. Listar Meus Chamados
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('tickets.index', compact('tickets'));
    }

    // 2. Tela de Abrir Novo Chamado
    public function create()
    {
        return view('tickets.create');
    }

    public function createQuote()
    {
        return view('tickets.create_quote');
    }
    
    // 3. Salvar o Chamado no Banco
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'priority' => 'required|in:baixa,media,alta',
            'message' => 'required|string',
            'category' => 'nullable|string|in:suporte,orcamento',
        ]);

        Ticket::create([
            'user_id' => Auth::id(),
            'subject' => $validated['subject'],
            'priority' => $validated['priority'],
            'message' => $validated['message'],
            'category' => $request->category ?? 'suporte',
            'status' => 'aberto',
        ]);
            if ($request->category === 'orcamento') {
             return redirect()->route('tickets.index')->with('success', 'Solicitação de orçamento enviada! Vamos analisar e responder em breve.');
        }

        return redirect()->route('tickets.index')->with('success', 'Chamado aberto com sucesso!');
    }

    // 4. Ver Detalhes do Chamado (Faremos o chat depois)
    public function show(Ticket $ticket)
    {
        // Garante que o usuário só veja os próprios chamados
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        return view('tickets.show', compact('ticket'));
    }

    // 5. Enviar Resposta (Chat)
    public function reply(Request $request, Ticket $ticket)
    {
        // Segurança: só dono ou admin pode responder
        if ($ticket->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate(['message' => 'required|string']);

        TicketMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // Se foi o admin respondendo, muda status para 'respondido'
        // Se foi o cliente, muda para 'aberto' (pendente de análise)
        $ticket->update([
            'status' => Auth::user()->role === 'admin' ? 'respondido' : 'aberto'
        ]);

        return back()->with('success', 'Mensagem enviada!');
    }

    // 6. Polling de Mensagens (Cliente)
    public function indexMessages(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }
        
        // Retorna apenas a "view parcial" das mensagens
        return view('tickets.partials.messages', compact('ticket'));
    }

}