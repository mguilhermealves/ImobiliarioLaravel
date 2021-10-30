<?php

namespace App\Http\Controllers\Backend\Produtos;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\Produtoimagem;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Backend\BackController;

class ProdutoController extends BackController
{
    public function Imagens(Produto $produto)
    {
        return view('backend.produtos.imagens', [
          'produto' => $produto,
        ]);
    }

    public function upload(Produto $produto, Request $request)
    {
        $nameFile = null;
        if ($request->hasFile('galeria') && $request->file('galeria')->isValid()) {
            $name = uniqid(date('HisYmd'));
            $extension = $request->galeria->extension();
            $nameFile = "{$name}.{$extension}";
            $upload = $request->galeria->storeAs('backend/produtos/' . $produto->id . '/', $nameFile);
            if (!$upload) {
                return redirect()
              ->back()
              ->with('error', 'Falha ao fazer upload')
              ->withInput();
            }
            ['link' => url('storage/app/public/backend/produtos/') . $produto->id . '/' . $nameFile];
            $imagem = new Produtoimagem();
            $imagem->imagem = $nameFile;
            $produto->imagens()->save($imagem);

            return response()->json(['ok'], 200);
        }
    }

    public function apagar(Produto $produto, Request $request)
    {
        $dir = 'backend/produtos/' . $produto->id . '/';
        $imagem = Produtoimagem::find($request->key);
        $arquivo = $dir . '/' . $imagem->imagem;
        Storage::delete($arquivo);
        $imagem->delete();
        $data = [];

        return response()->json($data);
    }
}
