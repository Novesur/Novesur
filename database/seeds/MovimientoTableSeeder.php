<?php

use Illuminate\Database\Seeder;
use App\Movimiento;

class MovimientoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movimiento =[
            ['nombre' => 'ENTRADA'],
            ['nombre' => 'SALIDA'],
        ];
        Movimiento::query()->delete();
        foreach ($movimiento as $data) {
            Movimiento::create($data);
        }
    }
}
