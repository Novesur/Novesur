<?php

use App\CatArticulo;
use Illuminate\Database\Seeder;

class CatArticuloTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catArticulo =[
            ['nombre' => 'MEDIDOR PARA AGUA POTABLE'],
            ['nombre' => 'ACCESORIOS'],
            ['nombre' => 'EQUIPOS Y INSUMOS PARA TRATAMIENTO DE AGUA'],
            ['nombre' => 'HMTAS. PARA LIMPIEZA DE ALCANTARILLADOS'],
            ['nombre' => 'DISPOSITIVO DE CORTE INTRUSIVO'],
        ];
        CatArticulo::query()->delete();
        foreach ($catArticulo as $data) {
            CatArticulo::create($data);
        }
    }
}
