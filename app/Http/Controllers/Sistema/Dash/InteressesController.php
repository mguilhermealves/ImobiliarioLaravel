<?php

namespace App\Http\Controllers\Sistema\Dash;

use App\Http\Controllers\Controller;

class InteressesController extends Controller
{
    public function index()
    {
        return view('sistema.dash.comprador.interesses.index', [
          'lista' => $this->usuario->favoritos,
          'title' => 'Painel de Controle - Comprador - Lista de Interesses'
        ]);
    }
}
