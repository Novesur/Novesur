<?php

use Illuminate\Database\Seeder;
use App\UnidMedida;

class UnidmedidaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnidMedida::query()->delete();
        UnidMedida::create(['nombre' => 'Unid']);
    }
}
