<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzaIngredienteModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pizza_ingrediente_models', function (Blueprint $table) {
            $table->increments('id'); 
            $table->boolean('extra');
            $table->float('value');
            $table->timestamps();

            $table->integer('pizza_id')->unsigned();
            $table->foreign('pizza_id')->references('id')->on('pizza_models');
            $table->integer('ingrediente_id')->unsigned();
            $table->foreign('ingrediente_id')->references('id')->on('ingredientes_models');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pizza_ingrediente_models');
    }
}
