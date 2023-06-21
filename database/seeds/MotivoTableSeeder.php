<?php

use Illuminate\Database\Seeder;
use App\Motivo;

class MotivoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $motivo =[
            ['nombre' => 'CAMBIO POR GARANTIA'],
            ['nombre' => 'COMPRA'],
            ['nombre' => 'DEVOLUCION'],
            ['nombre' => 'INVENTARIO INICIAL'],
            ['nombre' => 'PRESTAMO'],
            ['nombre' => 'VENTA'],

        ];
        Motivo::query()->delete();
        foreach ($motivo as $data) {
            Motivo::create($data);
        }
    }
}
