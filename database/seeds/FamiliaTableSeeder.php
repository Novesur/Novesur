<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Familia;

class FamiliaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now()->modify('-2 year');
        $createdDate = clone ($date);

        $familia =[
            ['nombre' => 'MEDIDOR AGUA FRIA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'MEDIDOR AGUA CALIENTE','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'VALVULA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'NIPLE PARA RACOR','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TUERCA PARA RACOR','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'EMAPQUE','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'BRIDA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'FILTRO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'UNION DRESSER','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ADAPTADOR ','created_at' => $createdDate, 'updated_at' => $createdDate],


        ];
        Familia::query()->delete();

        foreach ($familia as $data) {
            Familia::create($data);
        }
    }
}









