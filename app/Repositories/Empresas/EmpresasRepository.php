<?php

namespace App\Repositories\Empresas;

use App\Models\Plano;
use App\Models\Empresa;
use App\Models\Produto;
use App\Models\Usuario;
use App\Models\Website;
use App\Models\Empresagrupo;
use Illuminate\Http\Request;
use App\Models\Empresacertificado;
use Illuminate\Support\Facades\Storage;
use App\Services\Sistema\SistemaService;
use App\Http\Requests\Sistema\Auth\CadastroRequest;
use App\Http\Requests\Sistema\Dash\Vendedor\Empresa\EmpresaRequest;
use App\Http\Requests\Sistema\Dash\Vendedor\Website\WebsiteRequest;
use App\Repositories\Planos\PlanosRepository;

class EmpresasRepository
{
    public static function find(Int $id)
    {
        return Empresa::findOrFail($id);
    }

    public static function porAssinatura(Int $id)
    {
        return Empresa::where('assinatura_id', $id)->first();
    }

    public static function checkEmpresa(Usuario $usuario, Empresa $empresa)
    {
        return $usuario->empresa->id === $empresa->id;
    }

    public static function criarDeUsuario(CadastroRequest $request, Plano $plano)
    {
        $empresa = new Empresa();
        $empresa->nome = $request->empresa;
        $empresa->uf = $request->uf;
        $empresa->plano_id = $plano->id;
        $empresa->save();

        self::criaSite($empresa);

        return $empresa;
    }

    public static function criaSite(Empresa $empresa)
    {
        $site = new Website();
        $site->empresa_id = $empresa->id;
        $site->save();
    }

    public static function salvar(Usuario $usuario, EmpresaRequest $request)
    {
        if ($usuario->empresa->id != $request->empresa_id) {
            return SistemaService::jsonR(422, 0, 'Não autorizado!');
        }
        $usuario->empresa->update($request->all());
    }

    public static function salvaSite(Empresa $empresa, WebsiteRequest $request)
    {
        $site = Website::where('empresa_id', $empresa->id)->first();
        if (!$site) {
            $request['empresa_id'] = $empresa->id;
            $site = Website::create($request->all());
        } else {
            $site->update($request->all());
        }
    }

    public static function adicionaVitrine(Empresa $empresa, Request $request)
    {
        foreach ($request->vincular as $id) {
            $produto = Produto::find($id);
            if ($produto && $empresa->id === $produto->empresa_id) {
                $produto->vitrine = 1;
                $produto->save();
            }
        }
    }

    public static function removeVitrine(Produto $produto)
    {
        $produto->vitrine = 0;
        $produto->save();
    }

    public static function getDestaques(Empresa $empresa)
    {
        return Empresagrupo::whereIn('id', [$empresa->website->grupo1, $empresa->website->grupo2, $empresa->website->grupo3, $empresa->website->grupo4, $empresa->website->grupo5])->get();
    }

    public static function checkSite(Empresa $empresa)
    {
        if (!$empresa->website) {
            return Website::create(['empresa_id' => $empresa->id]);
        }

        return $empresa->website;
    }

    public static function certificados(Empresa $empresa, Request $request)
    {
        $nameFile = null;
        if ($request->hasFile('galeria') && $request->file('galeria')->isValid()) {
            $titulo = $request->galeria->getClientOriginalName();
            $nameFile = $empresa->id . '/' . $titulo;
            $upload = Storage::disk('certificados')->put($nameFile, file_get_contents($request->galeria), 'public');
            if (!$upload) {
                return redirect()
            ->back()
            ->with('error', 'Falha ao fazer upload')
            ->withInput();
            }
            $file = Storage::disk('certificados')->url($nameFile);
            $data = ['link' => $file];
            self::adicionaCertificado($empresa, $file, $titulo);

            return response()->json($data);
        }
    }

    public static function adicionaCertificado(Empresa $empresa, String $arquivo, String $titulo)
    {
        $certificado = new Empresacertificado();
        $certificado->empresa_id = $empresa->id;
        $certificado->certificado = $arquivo;
        $certificado->nome = $titulo;
        $certificado->save();
    }

    public static function apagarCertificado(Empresa $empresa, Request $request)
    {
        $certificado = Empresacertificado::find($request->key);
        self::apagaImagemFisica($certificado);
        $certificado->delete();

        return response()->json('ok');
    }

    public static function apagaImagemFisica(Empresacertificado $imagem)
    {
        $path = $imagem->empresa->id;
        $names = explode('/', $imagem->certificado);
        $name = end($names);
        $image = $path . '/' . $name;
        if (Storage::disk('certificados')->exists($image)) {
            Storage::disk('certificados')->delete($image);
        }
    }

    public static function atualizaNota(Empresa $empresa)
    {
        $notas = $empresa->avaliacoes->sum('nota');
        $qtd = $empresa->avaliacoes->count();
        $empresa->nota = number_format(($notas / $qtd), 2);
        $empresa->save();
    }

    public static function getDestaquesHome()
    {
        $planos = PlanosRepository::maiores();
        $maiores = Empresa::where('plano_id', $planos[0]->id)->inRandomOrder()->get();
        if ($maiores->count() < 20) {
            $maiores->merge(
                Empresa::where('plano_id', $planos[1]->id)->inRandomOrder()->take(20 - $maiores->count())->get()
            );
        }

        return $maiores;
    }
}
