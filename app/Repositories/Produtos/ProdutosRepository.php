<?php

namespace App\Repositories\Produtos;

use App\Models\Grupo;
use App\Models\Imagem;
use App\Models\Empresa;
use App\Models\Produto;
use App\Models\Unidade;
use App\Models\Usuario;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\Sistema\Dash\Vendedor\Produtos\ProdutoRequest;

class ProdutosRepository
{
    public static function get(Empresa $empresa)
    {
        return Produto::where('empresa_id', $empresa->id)->get();
    }

    public static function unidades()
    {
        return Unidade::all();
    }

    public static function gravar(ProdutoRequest $request)
    {
        $produto = Produto::create($request->all());
        self::ProdutoImagens($produto, $request);
    }

    public static function salvar(Produto $produto, ProdutoRequest $request)
    {
        $request['status'] = 0;
        $produto->update($request->all());
        self::ProdutoImagens($produto, $request);
    }

    public static function ProdutoImagens(Produto $produto, ProdutoRequest $request)
    {
        foreach ($produto->imagens as $i) {
            $i->delete();
        }
        $produto->imagens()->create(['imagem' => $request->principal, 'principal' => 1]);
        foreach (range(1, 5) as $x) {
            $var = 'imagem_' . $x;
            if ($request->$var) {
                $produto->imagens()->create(['imagem' => $request->$var, 'principal' => 0]);
            }
        }
    }

    public static function editar(ProdutoRequest $request)
    {
        $request['valor_minimo'] = currencyToBd($request->valor_minimo);
        $request['valor_maximo'] = currencyToBd($request->valor_maximo);
        $request['valor_unico'] = currencyToBd($request->valor_unico);
        $produto = Produto::find($request->id);
        $produto->update($request->except('imagens', 'principal'));
        self::alteraImagens($produto, $request);
    }

    public static function clona(Produto $produto)
    {
        $new = $produto->replicate();
        $new->push();
        $new->nome = $produto->nome . '_CÓPIA';
        $new->status = 3;
        $new->visitas = 0;
        $new->vitrine = 0;
        $new->save();
        foreach ($produto->imagens as $imagem) {
            $nImage = $imagem->replicate();
            $nImage->push();
            $nImage->produto_id = $new->id;
            $nImage->save();
        }
    }

    public static function getBanco(Empresa $empresa)
    {
        return $empresa->imagens->sortByDesc('id');
    }

    public static function getTamanhoBanco(Empresa $empresa)
    {
        $file_size = 0;
        foreach (Storage::disk('banco')->files($empresa->id) as $file) {
            $file_size += Storage::disk('banco')->size($file);
        }

        return number_format($file_size / 1048576, 2);
    }

    public static function addBanco(Empresa $empresa, String $file, String $titulo)
    {
        Imagem::create([
        'empresa_id' => $empresa->id,
        'titulo' => $titulo,
        'imagem' => $file,
      ]);
    }

    public static function apagaImagem(Int $id)
    {
        $imagem = Imagem::find($id);
        if ($imagem) {
            self::apagaImagemFisica($imagem);
            $imagem->delete();
        }
    }

    public static function apagaImagemFisica(Imagem $imagem)
    {
        $path = $imagem->empresa->id;
        $names = explode('/', $imagem->imagem);
        $name = end($names);
        $image = $path . '/' . $name;
        if (Storage::disk('banco')->exists($image)) {
            Storage::disk('banco')->delete($image);
        }
    }

    public static function alteraImagens(Produto $produto, ProdutoRequest $request)
    {
        self::apagaImagens($produto);
        $i = new ImagemProduto();
        $i->produto_id = $produto->id;
        $i->arquivo = $request->principal;
        $i->principal = 0;
        $i->save();
        $principal = 0;
        foreach ($request->imagens as $imagem) {
            $i = new ImagemProduto();
            $i->produto_id = $produto->id;
            $i->arquivo = $imagem;
            $i->principal = 1;
            $i->save();
        }
    }

    protected static function apagaImagens(Produto $produto)
    {
        $produto->imagens->each(function ($p) {
            $p->delete();
        });
    }

    public static function apagar(Produto $produto)
    {
        $produto->delete();
    }

    public static function KeywordstoSelect()
    {
        return Keyword::all()->pluck('keyword', 'id')->toArray();
    }

    public static function KeywordsProduto($produto_id)
    {
        return Keyword::all()->where('produto_id', $produto_id)->pluck('keyword')->toArray();
    }

    public static function ProdutosEmpresa($empresa_id)
    {
        return Produto::where('empresa_id', $empresa_id)->get();
    }

    public static function Produto($id)
    {
        return Produto::find($id);
    }

    public static function buscaCategorias(Request $request)
    {
        $produtos = Produto::search($request->t)->get();
        if ($produtos->count() > 0) {
            $subs = new Collection();
            $grupos = new Collection();
            $x = 0;
            foreach ($produtos as $produto) {
                $subs->push(SubCategoria::find($produto->subcategoria->id));
                if ($produto->grupo()->exists()) {
                    $grupos->push(Grupo::find($produto->grupo->id));
                }
                $x++;
            }

            return self::montaCategorias($subs->unique('id'), $grupos->unique('id'));
        }

        return self::montaCategorias(null, null);
    }

    public static function montaCategorias(Collection $subs = null, Collection $grupos = null)
    {
        return view('sistema.parts.dash.categorias', [
          'grupos' => $grupos,
          'subs' => $subs,
        ])->render();
    }

    public static function busca(Categoria $categoria = null, Subcategoria $sub = null, Grupo $grupo = null, Request $request = null)
    {
        return Produto::where('status', 1)
        ->when($categoria != null, function ($query) use ($categoria) {
            return $query->where('categoria_id', $categoria->id);
        })
        ->when($sub != null, function ($query) use ($sub) {
            return $query->where('subcategoria_id', $sub->id);
        })
        ->when($grupo != null, function ($query) use ($grupo) {
            return $query->where('grupo_id', $grupo->id);
        })
        ->when($request != null, function ($query) use ($request) {
            return $query
            ->when($request->termo != null, function ($query) use ($request) {
                return $query->search($request->termo);
            })
            ->when($request->tipo != '', function ($query) use ($request) {
                return $query->join('empresas', function ($join) use ($request) {
                    $join->on('produtos.empresa_id', '=', 'empresas.id')->where('empresas.tipo', $request->tipo);
                });
            })
            ->when($request->uf != '', function ($query) use ($request) {
                return $query->join('empresas as euf', function ($join) use ($request) {
                    $join->on('produtos.empresa_id', '=', 'euf.id')->where('euf.uf', $request->uf);
                });
            })
            ->when($request->qmin > 0, function ($query) use ($request) {
                return $query->where('quantidade_minima', '>=', $request->qmin);
            })
            ->when($request->pmin > 0, function ($query) use ($request) {
                return $query->where('valor_minimo', '>=', currencyToBd($request->pmin));
            })
            ->when($request->pmax > 0, function ($query) use ($request) {
                return $query->where('valor_maximo', '<=', currencyToBd($request->pmax));
            })
            ->when($request->ordem == '0', function ($query) use ($request) {
                return $query->orderBy('produtos.valor_minimo', 'ASC');
            })
            ->when($request->ordem == '1', function ($query) use ($request) {
                return $query->orderBy('produtos.valor_maximo', 'DESC');
            });
        })->paginate(12, ['produtos.*']);
    }

    // public static function search(Request $request)
    // {
    //     $produtos = Produto::search($request->termo)
    //       ->when($request->tipo != '', function ($query) use ($request) {
    //           return $query->join('empresas', function ($join) use ($request) {
    //               $join->on('produtos.empresa_id', '=', 'empresas.id')->whereJsonContains('empresas.tipo', $request->tipo);
    //           });
    //       })
    //       ->when($request->uf != '', function ($query) use ($request) {
    //           return $query->join('empresas as euf', function ($join) use ($request) {
    //               $join->on('produtos.empresa_id', '=', 'euf.id')->where('euf.uf', $request->uf);
    //           });
    //       })
    //       ->when($request->qmin > 0, function ($query) use ($request) {
    //           return $query->where('quantidade_minima', '>=', $request->qmin);
    //       })
    //       ->when($request->pmin > 0, function ($query) use ($request) {
    //           return $query->where('valor_minimo', '>=', currencyToBd($request->pmin));
    //       })
    //       ->when($request->pmax > 0, function ($query) use ($request) {
    //           return $query->where('valor_maximo', '<=', currencyToBd($request->pmax));
    //       })
    //       ->when($request->ordem == '0', function ($query) use ($request) {
    //           return $query->orderBy('produtos.valor_minimo', 'ASC');
    //       })
    //       ->when($request->ordem == '1', function ($query) use ($request) {
    //           return $query->orderBy('produtos.valor_maximo', 'DESC');
    //       })
    //     ->paginate(12, ['produtos.*']);

    //     return $produtos;
    // }

    public static function insereImagemBanco(Int $empresa_id, String $caminho, string $titulo)
    {
        $imagem = new Imagem();
        $imagem->empresa_id = $empresa_id;
        $imagem->titulo = $titulo;
        $imagem->caminho = $caminho;
        $imagem->save();
    }

    public static function addFavorito(Usuario $usuario, Produto $produto)
    {
        $usuario->favoritos()->attach($produto);
    }

    public static function delFavorito(Usuario $usuario, Produto $produto)
    {
        $usuario->favoritos()->detach($produto);
    }

    public static function updateVisitas(Produto $produto)
    {
        $produto->visitas++;
        $produto->save();
    }

    public static function todosFornecedor(Empresa $empresa, Request $request)
    {
        return Produto::where('empresa_id', $empresa->id)->where('status', 1)->inRandomOrder()->paginate(15);
    }
}
