<?php

namespace App\Http\Presenters;

use App\Models\Mensagemitem;
use Laracodes\Presenter\Presenter;

class MensagemPresenter extends Presenter
{
    public function nomeAnexo(Mensagemitem $item)
    {
        $url = explode('/', $item->mensagem);

        return end($url);
    }

    public function anexo(Mensagemitem $item)
    {
        $arquivo = $this->nomeAnexo($item);
        $nome = explode('.', $arquivo);
        $ext = strtolower(end($nome));
        if ($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'gif') {
            $icon = '<i class="far fa-file-image text-50-pt"></i>';
        }
        if ($ext == 'pdf') {
            $icon = '<i class="far fa-file-pdf text-50-pt"></i>';
        }
        if ($ext == 'doc' || $ext == 'docx') {
            $icon = '<i class="far fa-file-word text-50-pt"></i>';
        }
        if ($ext == 'xls' || $ext == 'xlsx') {
            $icon = '<i class="far fa-file-excel text-50-pt"></i>';
        }

        return $icon;
    }
}
