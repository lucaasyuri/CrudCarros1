<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\CarrosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(); //rota para login, troca de senha do usuario, etc...

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//rota apenas para quem estiver logado | grupo de rotas manuseado por um middleware | controle para ver se o usuário está logado ou não
//se o usuário tentar acessar essas rotas e não estiver logado, vai ser redirecionado para o 'login'
Route::middleware(['auth'])->group(function (){

    // Grupo-Marcas
    Route::prefix('marcas')->group(function (){

        Route::get('', [MarcasController::class, 'index'])->name('marcas-index');
        //index

        Route::get('/create', [MarcasController::class, 'create'])->name('marcas-create');
        //chamando tela de criação (create)

        Route::post('/store', [MarcasController::class, 'store'])->name('marcas-store');
        //salvando dados do formulário

        Route::get('/{id}/edit', [MarcasController::class, 'edit'])->where('id', '[0-9]+')->name('marcas-edit');
        //chamando a tela de edição com id (edit)
        //where('o que quero validar', 'validação)
        //[0-9]: apenas números | +: numeros maiores que 9 como 15,20,25...

        Route::put('/{id}/update', [MarcasController::class, 'update'])->where('id', '[0-9]+')->name('marcas-update');
        //put: rota de edição
        //where('o que quero validar', 'validação)
        //[0-9]: apenas números | +: numeros maiores que 9 como 15,20,25...
        //salvando alteração (edição de dados)

        Route::delete('{id}', [MarcasController::class, 'destroy'])->where('id', '[0-9]+')->name('marcas-destroy');
        //deletando registros
        //where('o que quero validar', 'validação)
        //[0-9]: apenas números | +: numeros maiores que 9 como 15,20,25...

    });

    //Grupo-Carro
    Route::prefix('carros')->group(function (){

        Route::get('', [CarrosController::class, 'index'])->name('carros-index');
        //index

        Route::get('/create' ,[CarrosController::class, 'create'])->name('carros-create');
        //chamando tela de criação

        Route::post('/store', [CarrosController::class, 'store'])->name('carros-store');
        //salvando dados do formulário

        Route::get('/{id}/edit', [CarrosController::class, 'edit'])->where('id', '[0-9]+')->name('carros-edit');
        //chamando tela de edição (edit)
        //where('o que eu quero validar', 'validação')
        //[0-9]: apenas números | +: números maiores que 9 como 15, 20, 25...

        Route::put('{id}/update', [CarrosController::class, 'update'])->where('id', '[0-9]+')->name('carros-update');
        //put: rota de edição
        //where('o que quero validar', 'validação')
        //[0-9]: apenas números | +: números maiores que 9 como 15, 20, 25...
        //salvando alteração (edição dos dados)

        Route::delete('{id}', [CarrosController::class, 'destroy'])->where('id', '[0-9]+')->name('carros-destroy');
        //deletando registros
        //where('o que quero validar', 'validação')
        //[0-9]: apenas números | +: números maiores que 9 como 15, 20, 25...

    });

});
