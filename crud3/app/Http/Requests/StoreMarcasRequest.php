<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarcasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //todos os usuários podem acessar
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [ //regras são implementadas dentro do return [];
            'nome' => 'required|string|max:50|unique:marcas|min:2',
            'ano_fundacao' => 'required|integer',
            'pais' => 'required|max:100|min:2'
            //required: obrigatório | min/max: de cadacteres no campo | integer: apenas números inteiros
        ];
    }

    public function messages() //as mensagens por padrão retornam em inglês, mas queremos que retornem em português
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.string' => 'O campo nome deve ser do tipo string',
            'nome.max' => 'O tamanho máximo do nome é 50 caracteres',
            'nome.unique' => 'O nome da marca já está cadastrado',
            'nome.min' => 'O tamanho mínimo do nome é 2 caracteres',
            'ano_fundacao.required' => 'O campo ano é obrigatório',
            'ano_fundacao.integer' => 'O ano deve ser um número inteiro',
            'pais.required' => 'O campo país é obrigatório',
            'pais.max' => 'O tamanho máximo do país é 100 caracteres',
            'pais.min' => 'O tamanho mínimo do país é 2 caracteres',
        ];
    }

}
