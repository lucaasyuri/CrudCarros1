<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carro;
use App\Models\Marca;
use App\Http\Requests\StoreCarroRequest;
use App\Http\Requests\UpdateCarroRequest;

class CarrosController extends Controller
{
    
    public function index(Request $request)
    {
        //$carros = Carro::all(); //buscando todos os carros

        //$carros = Carro::orderBy('id', 'DESC')->get();
        //ordem decrescente por id | get(): buscando todos os registros

        $query = $request->query('queryPesquisa', null);

        if ($query)
        {
            //pesquisar
            $carros = Carro::where('nome', 'LIKE', "%" . $query . "%")
                ->orderBy('id', 'DESC')
                ->paginate(5)
                ->withQueryString();
                //withQueryString(): mantendo os parâmetros na url e não perdendo o valor de '$query'
        }
        else
        {
            $carros = Carro::orderBy('id', 'DESC')->paginate(5);
        }

        return view('carros.index', ['carros' => $carros, 'queryPesquisa' => $query]);
        //nome da pasta . nome da rota
        //[passando variável do back-end para o front-end]
    }

    public function create()
    {
        $marcas = Marca::all(); //importando todos os times

        return view('carros.create', ['marcas' => $marcas]); //passando os dados do back para o front-end
    }

    public function store(StoreCarroRequest $request)
    {
        Carro::create($request->all());

        return redirect(route('carros-index'));
    }

    public function edit($id) //variável com mesmo nome do parâmetro passado na rota 'edit'
    {
        $carro = Carro::where('id', $id)->first();

        //verificando se o jogador existe
        if (!empty($carro)) //se a variável '$carro' não estiver vazia
        {
            $marcas = Marca::all();

            return view('carros.edit', ['marcas' => $marcas, 'carro' => $carro]);
        }
        else
        {
            return redirect(route('carros-index'));
        }

    }

    public function update(UpdateCarroRequest $request, $id) //%id: está vindo da rota
    {
        //conjunto de dados para ser atualizados
        $data = [
            'nome' => $request->nome,
            'cor' => $request->cor,
            'ano' => $request->ano,
            'marca_id' => $request->marca_id,
        ];

        Carro::where('id', $id)->update($data); //campo 'id' com mesmo valor do $id recebido como parâmetro

        return redirect(route('carros-index'));

    }

    public function destroy($id)
    {
        Carro::where('id', $id)->delete(); //campo 'id' com mesmo valor do $id recebido como parâmetro

        return redirect(route('carros-index'));
    }

}
