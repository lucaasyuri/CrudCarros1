@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-sm-12 col-md-6"> <!--coluna-pequena-ocupando 12(tudo) ou se for no tamanho médio col-md-6-->
                <h1>Marcas</h1>
            </div>

            <!-- Adicionar -->
            <div class="col-sm-12 col-md-6" style="text-align: right">
                <a href="{{ route('marcas-create') }}" class="btn btn-md btn-success">Adicionar</a>
            </div>

        </div>

        <!-- Filtro -->
        <div class="row">

            <!-- col-sm-0: quando tela pequena some, col-md-6: quando for média, vai ter espaço de 6-->
            <div class="col-sm-0 col-md-6"></div>

            <div class="col-sm-0 col-md-6">
                <form method="GET">
                <!-- método 'get', pois faz uma request na própria url | action: vai ser a própria página -->
                
                    <div class="input-group mb-3 mt-2">

                        <input type="text" class="form-control" placeholder="pesquisar" name="queryPesquisa" value="{{ $queryPesquisa }}">

                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Pesquisar</button>
                            <a href="{{ route('marcas-index') }}" class="btn btn-danger">Limpar</a>
                        </div>

                    </div>
                    
                </form>

            </div>

        </div>

        <div class="row pt-3 mt-2"> <!--pt-3: espaço entre a linha de cima | mt-2: margem-->
            <div class="col-sm-12">
                <div class="table responsive">
                    <table class="table table-striped table-hover">

                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>Ano Fundação</th>
                                <th>País</th>
                                <th>Ação</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($marcas as $marca)
                                <tr>
                                    <th>{{ $marca->id }}</th>
                                    <td>{{ $marca->nome }}</td>
                                    <td>{{ $marca->ano_fundacao }}</td>
                                    <td>{{ $marca->pais }}</td>
                                    <td class="d-flex"> <!--d-flex: alinhando os botões-->

                                        <!-- Edit -->
                                        <a href="{{ route('marcas-edit', ['id' => $marca->id ]) }}" class="btn btn-sm btn-primary" style="margin-right: 3px">Editar</a>

                                        <!-- Delete -->
                                        <form action="{{ route('marcas-destroy', ['id' => $marca->id ]) }}" method="POST">
                                            @csrf
                                            @method('DELETE') <!--forçando método 'DELETE'-->

                                            <button type="submit" class="btn btn-sm btn-danger">Deletar</button>

                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Paginação -->
                    <!--pagination justify-content-end: alinhando à direita da página-->
                    <div class="pagination justify-content-end">
                        {{ $marcas->links() }}
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection