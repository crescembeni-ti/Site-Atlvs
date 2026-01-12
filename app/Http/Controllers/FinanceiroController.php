<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    public function index()
    {
        // Simulando dados de faturas (depois virá do Banco de Dados)
        $invoices = collect([
            [
                'id' => 'FAT-2024-001',
                'description' => 'Desenvolvimento Web - Parcela 1/3',
                'amount' => 1500.00,
                'due_date' => now()->addDays(5), // Vence em 5 dias
                'status' => 'pending', // pending, paid, overdue
                'url' => '#'
            ],
            [
                'id' => 'FAT-2023-012',
                'description' => 'Manutenção Mensal - Dezembro',
                'amount' => 350.00,
                'due_date' => now()->subDays(10),
                'status' => 'paid',
                'url' => '#'
            ],
            [
                'id' => 'FAT-2023-011',
                'description' => 'Manutenção Mensal - Novembro',
                'amount' => 350.00,
                'due_date' => now()->subDays(40),
                'status' => 'overdue', // Atrasado
                'url' => '#'
            ]
        ]);

        return view('gestao.financeiro.index', compact('invoices'));
    }
}