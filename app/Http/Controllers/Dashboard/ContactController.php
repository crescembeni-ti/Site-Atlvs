<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);

        return view('dashboard.contacts.index', compact('contacts'));
    }

    public function toggleRead(\App\Models\Contact $contact)
    {
        // Inverte o valor atual (se tava lido, vira não lido e vice-versa)
        $contact->update([
            'is_read' => !$contact->is_read
        ]);

        return back()->with('success', 'Status da mensagem atualizado!');
    }
    
}
