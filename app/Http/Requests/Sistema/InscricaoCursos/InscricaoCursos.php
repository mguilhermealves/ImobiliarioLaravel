<?php

namespace App\Http\Requests\Sistema\InscricaoCursos;

use Illuminate\Foundation\Http\FormRequest;

class InscricaoCursosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        // pre($this->produtoSlug->quantidade_minima);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cursos_palestras_id' => 'required|int|exists:cursos_palestras,id',
        ];
    }
}
