<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'descricao'  => 'required|max:100',
            'preco'      => 'required|numeric',
            'quantidade' => 'required|integer',
            'marca'      => 'required|max:100'
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'descricao.required'  => 'Informe as descrição',
            'descricao.max'       => 'Máximo de 100 caracteres',
            'preco.required'      => 'Informe o preço',
            'preco.numeric'       => 'Informe o preço no formato numérico',
            'quantidade.required' => 'Informe a quantidade',
            'quantidade.integer'  => 'Informe a quantidade no formato inteiro',
            'marca.required'      => 'Informe a marca',
            'marca.max'           => 'Máximo de 100 caracteres'
        ];
    }
}