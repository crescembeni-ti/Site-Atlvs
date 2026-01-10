<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Models\Contact;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // 1. Validar os dados
        $validated = $request->validate([
            'name' => 'required|min:3',
            'company' => 'nullable|string',
            'email' => 'required|email',
            'message' => 'required|min:10',
        ]);

        // 2. SALVAR NO BANCO DE DADOS (Fundamental para o Dashboard)
        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            // Truque: Como não criamos coluna 'company' no banco, salvamos junto com a mensagem
            'message' => "Empresa: " . ($request->company ?? 'Não informada') . "\n\n" . $validated['message'],
            'is_read' => false,
        ]);

        // 3. Enviar o e-mail (Mantive sua lógica, mas com proteção contra erro)
        try {
            // Se você não configurou o SMTP (.env), isso daria erro e travaria o site.
            // O try/catch garante que o cliente veja a mensagem de sucesso mesmo se o email falhar.
            Mail::to('contato@atlvs.com.br')->send(new ContactFormMail($validated));
        } catch (\Exception $e) {
            // O email falhou, mas o lead já está salvo no banco. Tudo certo.
        }

        // 4. Redirecionar de volta com mensagem de sucesso
        return back()->with('success', 'Mensagem enviada com sucesso! Entraremos em contato em breve.');
    }
}