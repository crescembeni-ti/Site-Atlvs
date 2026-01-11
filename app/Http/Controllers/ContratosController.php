<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContratosController extends Controller
{

public function index()
    {
        // Aqui você vai buscar dados depois (faturas, pagamentos, etc)
        return view('gestao.contratos.index');
    }
}