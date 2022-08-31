<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarroRequest extends FormRequest
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
        return [ //regras são implementadas dentro do return[];
            'nome' => 'required|string|max:50|min:2',
            'cor' => 'required|string|max:50|min:2',
            'ano' => 'required|string|max:100|min:2',
            'marca_id' => 'required|integer|exists:marcas,id'
            //before:today = só aceita datas anteriores à de hoje
            //required: obrigatório | min/max: de caracteres no campo | integer: apenas números inteiros
            //exists: verificando se a marca existe | marcas: tabela | id: id da marca
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.string' => 'O campo nome deve ser do tipo string',
            'nome.max' => 'O tamanho máximo do nome é 100 caracteres',
            'nome.min' => 'O tamanho mínimo do nome é 2 caracteres',
            'cor.required' => 'O campo cor é obrigatório',
            'cor.string' => 'O campo cor deve ser do tipo string',
            'cor.max' => 'O tamanho máximo do cor é 50 caracteres',
            'cor.min' => 'O tamanho mínimo do cor é 2 caracteres',
            'ano.required' => 'O campo ano é obrigatório',
            'ano.string' => 'O campo ano deve ser do tipo string',
            'ano.max' => 'O tamanho máximo do ano é 100 caracteres',
            'ano.min' => 'O tamanho mínimo do ano é 2 caracteres',
            'marca_id.required' => 'O campo marca é obrigatório',
            'marca_id.integer' => 'O campo marca deve ser do tipo inteiro',
            'marca_id.exists' => 'O campo marca deve ser equivalente ao id de uma marca existente',
        ];
    }

}
