<?php

namespace App\Http\Requests\Sistema\Dash\Vendedor\Website;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'banner' => 'required|string|min:10',
          'grupo1' => 'nullable|int|exists:empresagrupos,id',
          'grupo2' => 'nullable|int|exists:empresagrupos,id',
          'grupo3' => 'nullable|int|exists:empresagrupos,id',
          'grupo4' => 'nullable|int|exists:empresagrupos,id',
          'grupo5' => 'nullable|int|exists:empresagrupos,id',
        ];
    }
}
