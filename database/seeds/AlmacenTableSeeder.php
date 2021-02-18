<?php

use Illuminate\Database\Seeder;
use App\Almacen;
use Carbon\Carbon;

class AlmacenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $almacen = [
            ['nombre' => 'Almacen Oficina'],
            ['nombre' => 'Almacen Central'],
            ['nombre' => 'Almacen Lurin'],
            ['nombre' => 'Almacen Sullana'],
            ['nombre' => 'Almacen Talara'],
        ];

        Almacen::query()->delete();

        foreach ($almacen as $data) {
            Almacen::create($data);
        }


    }
}
