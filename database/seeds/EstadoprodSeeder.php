<?php

use Illuminate\Database\Seeder;
use App\Estadoprod;
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
        Estadoprod::query()->delete();
        foreach ($estadoprod as $data) {
            Estadoprod::create($data);
        }
    }
}
