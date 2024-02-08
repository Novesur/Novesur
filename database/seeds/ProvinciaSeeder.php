<?php

use App\Provincia;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provincia =[
            ['nombre' => 'LIMA','departamento_id' => 1],
        ];
        Provincia::query()->delete();
        foreach ($provincia as $data) {
            Provincia::create($data);
        }
    }
}
