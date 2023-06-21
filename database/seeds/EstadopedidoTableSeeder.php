<?php

use Illuminate\Database\Seeder;
use App\EstadoPedido;
class EstadopedidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadopedido =[
            ['nombre' => 'ACEPTADO'],
            ['nombre' => 'EN PROCESO'],
            ['nombre' => 'CANCELADO'],
        ];
        EstadoPedido::query()->delete();
        foreach ($estadopedido as $data) {
            EstadoPedido::create($data);
        }
    }
}
