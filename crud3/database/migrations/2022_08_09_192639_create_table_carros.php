<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carros', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100)->nullable(false);
            $table->string('cor', 50)->nullable(false);
            $table->string('ano', 100)->nullable(false);
            $table->unsignedBigInteger('marca_id'); //unsignedBigInteger: inteiro positivo | chave estrangeira da tabela 'marca'
            $table->foreign('marca_id')->references('id')->on('marcas'); //foreign key (referência)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carros');
    }
};
