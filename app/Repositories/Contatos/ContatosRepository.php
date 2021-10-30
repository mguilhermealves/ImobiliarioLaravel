<?php

namespace App\Repositories\Contatos;

use App\Models\Contato;
use App\Models\Empresa;
use App\Models\Usuario;

class ContatosRepository
{
    public static function checkDono(Usuario $usuario, Contato $contato)
    {
        return $usuario->id === $contato->usuario_id;
    }
    public static function ContatosComprador(Empresa $empresa)
    {
        return $empresa->mensagens_comprador->where('contato', 1)->unique('empresa_destino_id');
    }

    public static function ContatosVendedor(Empresa $empresa)
    {
        return $empresa->mensagens->where('contato', 1)->unique('empresa_origem_id');
    }

    public static function getContato(Int $id)
    {
        return Empresa::find($id);
    }

    public static function adiciona(Usuario $usuario, Usuario $contato)
    {
        $ctt = new Contato();
        $ctt->usuario_id = $usuario->id;
        $ctt->contato_id = $contato->id;
        $ctt->save();
    }
}
