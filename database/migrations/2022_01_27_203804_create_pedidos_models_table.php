<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_models', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->date('fecha')->nullable();
            $table->float('costo')->nullable();
            $table->time('hora')->nullable();
            $table->integer('cantidad')->nullable();
            $table->timestamps();

            $table->integer('pizza_id')->unsigned();
            $table->foreign('pizza_id')->references('id')->on('pizza_models');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos_models');
    }
}
