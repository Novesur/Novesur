<?php

use App\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departamento =[
            ['nombre' => 'LIMA'],
        ];
        Departamento::query()->delete();
        foreach ($departamento as $data) {
            Departamento::create($data);
        }
    }
}
