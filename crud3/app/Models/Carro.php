<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    //campos preenchíveis
    protected $fillable = [
        'nome', 'cor', 'ano', 'marca_id'
    ];

    //relacionamento com a tabela de 'Marcas'
    public function marca()
    {
        return $this->beLongsTo(Marca::class); //beLongsTo(): carro pertence à uma marca
    }

}
