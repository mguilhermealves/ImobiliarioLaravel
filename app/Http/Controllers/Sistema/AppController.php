<?php

namespace App\Http\Controllers\Sistema;

use Cookie;
use App\Models\TrabalhoTemporario;
use App\Models\Juridico;
use App\Models\DuvidasFrequente;
use App\Models\Faq;
use App\Models\User;
use App\Models\Termo;
use App\Models\Politica;
use App\Models\Sobrenos;
use App\Models\Vendedor;
use App\Models\Comprador;
use App\Models\Noticia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ContatoEnviado;
use App\Services\Sistema\SistemaService;
use App\Http\Requests\Sistema\NewsRequest;
use App\Repositories\Sistema\BaseRepository;
use App\Http\Requests\Sistema\ContatoRequest;
use App\Repositories\Banners\BannersRepository;
use App\Repositories\CursosPalestras\CursosPalestrasRepository;
use App\Repositories\Noticias\NoticiasRepository;
use App\Repositories\CategoriaJuridico\CategoriaJuridicoRepository;
use App\Repositories\Home\HomeRepository;
use App\Repositories\Estados\EstadosRepository;
use App\Repositories\Usuarios\UsuariosRepository;
use App\Repositories\Equipe\EquipeRepository;

class AppController extends Controller
{
    public function Index()
    {
       
        $banners = BannersRepository::all();
       
        return view('sistema.index', [
          'title' => 'Home',
          'banners' => $banners,          
         ]);
    }

    public function sobre()
    {
        $item = Sobrenos::find(1);

        return view('sistema.asserttem', [
          'title' => 'Sobre Nós',
          'item' => $item,
        ]);
    }

    public function trabalho()
    {
        $item = TrabalhoTemporario::find(1);

        return view('sistema.trabalho-temporario', [
          'title' => 'Trabalho Temporário',
          'item' => $item,
        ]);
    }

    public function juridico()
    {
        $item = Juridico::find(1);
        $categoriasJuri = CategoriaJuridicoRepository::all();
        $arquivos = HomeRepository::getArquivosJuridicos();

        return view('sistema.juridico', [
          'title' => 'Juridico',
          'item' => $item,
          'categorias' => $categoriasJuri,
          'arquivos' => $arquivos,
        ]);
    }

    public function duvidas()
    {
        $item = DuvidasFrequente::find(1);
        $perguntas = json_decode($item->perguntas, true);

        return view('sistema.duvidas-frequentes', [
          'title' => 'Juridico',
          'item' => $item,
          'perguntas' => $perguntas,
        ]);
    }

    public function cursospalestras()
    {
        $cursos = CursosPalestrasRepository::all();

        return view('sistema.cursos-palestras', [
          'title' => 'Cursos e Palestras',
          'cursos' => $cursos,
        ]);
    }

    public function cursodetalhes(Request $request)
    {
        $curso = CursosPalestrasRepository::getBySlug($request->slug);

        return view('sistema.curso-detalhes', [
          'title' => 'Cursos e Palestras',
          'curso' => $curso,
        ]);
    }

    public function noticias()
    {
        $noticias = NoticiasRepository::all();
        $videos = NoticiasRepository::videos();
        $banners = NoticiasRepository::bannerNoticias();

       

        return view('sistema.noticias', [
          'title' => 'Notícias',
          'noticias' => $noticias,
          'videos' => $videos,
          'banners' => $banners
        ]);
    }

    public function noticia(Request $request)
    {
        $noticia = NoticiasRepository::getBySlug($request->slug);
        NoticiasRepository::updateVisitas($noticia);
        $banners = NoticiasRepository::bannerNoticias();
        return view('sistema.noticia', [
        'title' => 'Notícias',
        'noticia' => $noticia,
        'banners' => $banners
      ]);
    }

    public function agenciasassociadas()
    {
        $estados = EstadosRepository::all();
        $agencias = UsuariosRepository::all();

        return view('sistema.agencias-associadas', [
          'title' => 'Agências Associadas',
          'agencias' => $agencias,
          'estados' => $estados,
        ]);
    }

    public function equipe()
    {
        return view('sistema.corpo-diretivo', [
          'title' => 'Corpo diretivo',
          'executiva' => EquipeRepository::getEquipeByType(0),
          'regional' => EquipeRepository::getEquipeByType(1),
          'fiscal' => EquipeRepository::getEquipeByType(2),
          'consultivo' => EquipeRepository::getEquipeByType(3),
        ]);
    }

    public function newsletter(NewsRequest $request)
    {
        BaseRepository::adicionar('newsletter', $request);

        return SistemaService::jsonR(200, 1, 'E-mail cadastrado som sucesso! Obrigado.', 0);
    }

    public function politica()
    {
        $item = Politica::find(1);

        return view('sistema.pagina', [
          'titulo' => $item->titulo,
          'subtitulo' => $item->subtitulo,
          'conteudo' => $item->conteudo,
          'title' => 'Política de Privacidade',
        ]);
    }

    public function termos()
    {
        $item = Termo::find(1);

        return view('sistema.pagina', [
          'titulo' => $item->titulo,
          'subtitulo' => $item->subtitulo,
          'conteudo' => $item->conteudo,
          'title' => 'Termos de Uso',
        ]);
    }

    public function comprador()
    {
        $items = Comprador::all();

        return view('sistema.faq', [
          'titulo' => 'Ajuda para Compradores',
          'subtitulo' => 'Veja abaixo alguns tópicos que podem te auxiliar',
          'items' => $items,
          'title' => 'Ajuda para Compradores',
        ]);
    }

    public function vendedor()
    {
        $items = Vendedor::all();

        return view('sistema.faq', [
          'titulo' => 'Ajuda para Vendedores',
          'subtitulo' => 'Veja abaixo alguns tópicos que podem te auxiliar',
          'items' => $items,
          'title' => 'Ajuda para Vendedores',
        ]);
    }

    public function faq()
    {
        $items = Faq::all();

        return view('sistema.faq', [
          'titulo' => 'FAQ',
          'subtitulo' => 'Veja abaixo alguns tópicos que podem te auxiliar',
          'items' => $items,
          'title' => 'FAQ',
        ]);
    }

    public function contato()
    {
        return view('sistema.contato', [
          'titulo' => 'Fale Conosco',
          'subtitulo' => 'Preencha o formulário abaixo que em breve entraremos em contato com você.',
          'title' => 'Fale Conosco',
        ]);
    }

    public function contatoEnviar(ContatoRequest $request)
    {
        User::all()->each(function ($u) use ($request) {
            $u->notify(new ContatoEnviado($request));
        });

        return SistemaService::jsonR(200, 1, 'Contato enviado com sucesso!<br>Em breve entraremos em contato com você. Obrigado!', route('sistema.index'));
    }

    public function respostaAgencias(Request $request)
    {
        $agencias = UsuariosRepository::agenciasPorEstado($request->uf);

        return view('sistema.parts.agencias-resposta', [
          'agencias' => $agencias,
          'cidades' => UsuariosRepository::makeCidades($agencias),
        ]);
    }

    public function CookiePopup()
    {
        Cookie::queue('leaveUser', 1, 43800);
    }
}
