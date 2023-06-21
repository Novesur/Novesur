<?php

use Illuminate\Database\Seeder;
use App\EstadoProducto;
class EstadoprodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadoprod =[
            ['nombre' => 'Activo'],
            ['nombre' => 'Inactivo'],
        ];
        EstadoProducto::query()->delete();
        foreach ($estadoprod as $data) {
            EstadoProducto::create($data);
        }
    }
}
