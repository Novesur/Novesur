<?php

use Illuminate\Database\Seeder;
use App\Tipopago;
class TipopagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipopago =[
            ['nombre' => 'CONTADO',],
            ['nombre' => 'CREDITO'],
            ['nombre' => 'LETRA'],

        ];
        Tipopago::query()->delete();
        foreach ($tipopago as $data) {
            Tipopago::create($data);
        }
    }
}
