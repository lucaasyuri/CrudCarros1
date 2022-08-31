@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="container">
            <div class="row">

                <div class="col-sm-12 col-md-6"> <!--coluna-pequeta-ocupando 12(tudo) ou se for no tamanho médio col-md-6-->
                    <h1>Cadastrar Carro</h1>
                </div>

                <div class="col-sm-12 col-md-6" style="text-align: right">
                    <a href="{{ route('carros-index') }}" class="btn btn-md btn-primary">Voltar</a>
                </div>

            </div>
        </div>

        <div class="pt-3 mt-2">

            <div class="col-sm-12">

                <h5>Informe os dados do carro:</h5>

                <br>

                @if ($errors->any()) <!-- $errors->any(): se houver algum erro cai dentro deste 'if' | mensagem de erro na tela -->
                    <div class="alert alert-danger">

                        <ul> <!-- lista -->

                            @foreach ($errors->all() as $error)
                            <!-- buscando todos os erros e para ada erro vou exibir a mensagem dele -->

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>
                @endif

            </div>

            <div class="col-sm-12 mt-3">
                <form action="{{ route('carros-store') }}" method="POST">
                    @csrf
                    @method('POST') <!--forçando método 'POST'-->

                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" required class="form-control" placeholder="Informe um nome para o carro...">
                    </div>

                    <br>

                    <div class="form-group">
                        <label for="cor">Cor:</label>
                        <input type="text" id="cor" required name="cor" class="form-control" placeholder="Informe umacor para o carro...">
                    </div>

                    <br>

                    <div class="form-group">
                        <label for="ano">Ano:</label>
                        <input type="number" id="ano" name="ano" required class="form-control" step="1" placeholder="Informe um ano para o carro...">
                    </div>
                    <!--step="1": só aceita números inteiros-->
                    <!--required: campo obrigatório-->

                    <br>

                    <!--listando as marcas-->
                    <div class="form-group">
                        <label for="marca_id">Marca:</label>
                        <select name="marca_id" id="marca_id" class="form-control" required>

                        <option>Selecione uma marca...</option>

                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nome }}</option>
                        @endforeach

                        </select>
                    </div>

                    <div class="form-group mt-3" style="text-align: right"> <!-- mt: margin-top-->
                        <button type="submit" class="btn btn-md btn-primary">Salvar</button>
                    </div>

                </form>
            </div>

        </div>

    </div>

@endsection