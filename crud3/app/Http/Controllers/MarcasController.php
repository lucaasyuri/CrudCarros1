<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Http\Requests\StoreMarcasRequest;
use App\Http\Requests\UpdateMarcasRequest;

class MarcasController extends Controller
{
    
    public function index(Request $request)
    {
        //$marcas = Marca::all(); //busca todos as marcas no banco de dados e retorna para a variável '$marcas'

        //dd($marcas); //exibindo valor que recebo em '$marcas'

        //$marcas = Marca::where('pais', '=', 'Alemanha')->get();
        //where: buscando times da Alemanha | get(): busca todos

        //$marcas = Marca::find($id); //find(): busca direto pelo 'id'

        //$nome = 'Lucas Yurie'; //passando variável do back-end para o front-end
        //return view('marcas.index', ['nome' => $nome]); //nome da pasta . nome da view



        //$marcas = Marca::all(); //buscando todos as marcas

        //$marcas = Marca::orderBy('id', 'DESC')->get();
        //ordem decrescente por id | get(): buscando todos os registros

        $query = $request->query('queryPesquisa', null);

        if ($query)
        {
            //pesquisar
            $marcas = Marca::where('nome', 'LIKE', "%" . $query . "%")
                ->orderBy('id', 'DESC')
                ->paginate(5)
                ->withQueryString();
                //withQueryString(): mantendo os parâmetros n url e não perdend valor de '$query'
        }
        else
        {
            $marcas = Marca::orderBy('id', 'DESC')->paginate(5);
            //ordem decrescente por id | paginate(itens de cada pagina): paginação
        }

        return view('marcas.index', ['marcas' => $marcas, 'queryPesquisa' => $query]);
        //nome da pasta . nome da rota
        //[passando variável do back end para o front-end]
    }

    public function create()
    {
        return view('marcas.create');
    }

    public function store(StoreMarcasRequest $request) //StoreMarcasRequest: nossa classe que implementamos as regras dos campos
    {
        //dd($request->all());

        Marca::create($request->all());

        return redirect(route('marcas-index'));

    }

    public function edit($id) //variável com mesmo nome do parâmetro passado na rota 'edit'
    {
        $marca = Marca::find($id); //find(): busca direto pelo 'id'

        if (empty($marca))
        {
            return redirect(route('marcas-index'));
        }
        else
        {
            return view('marcas.edit', ['marca' => $marca]);
            //nome da pasta . nome da rota
            //[passando variável do back-end para o front-end]
        }

    }

    public function update(UpdateMarcasRequest $request, $id) //$id: id da rota
    {
        //dd($request, $id);

        //conjunto de dados para ser atualizados
        $data = [
            'nome' => $request->nome,
            'ano_fundacao' => $request->ano_fundacao,
            'pais' => $request->pais,
        ];

        Marca::where('id', $id)->update($data); //campo 'id' com mesmo valor do $id recebido como parâmetro

        return redirect(route('marcas-index'));

    }

    public function destroy($id)
    {
        Marca::where('id', $id)->delete(); //campo 'id' com mesmo valor do $id recebido como parâmetro

        return redirect(route('marcas-index'));
    }

}
