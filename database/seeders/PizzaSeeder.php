<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); 
        DB::table('pizza_models')->insert(
            ['nombre' => 'Pizza Queso', 'descripcion' => 'Desripcion test', 'estado' => true,  'costo' => '150', 'imagen' => 'default.jpg']
        );
        DB::table('pizza_models')->insert(
            ['nombre' => 'Pizza Hawaina', 'descripcion' => 'Desripcion test', 'estado' => true,  'costo' => '200','imagen' => 'default.jpg']
        );
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); 
    }
}
