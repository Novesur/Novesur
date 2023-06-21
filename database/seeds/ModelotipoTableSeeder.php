<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Modelotipo;

class ModelotipoTableSeeder extends Seeder
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

        $modelotipo =[
            ['nombre' => 'MINOMESS A -  TIPO CHORRO UNICO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'MTK-S1 - TIPO CHORRO MULTIPLE','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'MTK-S - TIPO CHORRO MULTIPLE','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'MTKD - TIPO CHORRO MULTIPLE','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'WS - TIPO WOLTMAN','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'JS - TIPO CHORRO UNICO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'WS - TIPO CHORRO MULTIPLE','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'MWN - TIPO WOLTMANN WPH','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'MWN - TIPO WOLTMANN COMBINADO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'GSD8-RFM - TIPO CHORRO UNICO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'GSD8 - TIPO CHORRO UNICO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'GMDM - TIPO CHORRO MULTIPLE','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'WDE-K40 - TIPO WOLTMANN WPH','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'WDE-K50 - TIPO WOLTMANN WPH','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'WDE - TIPO WOLTMANN WPH','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TOMA - TIPO CORPORETION','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PASO - TIPO MARIPOSA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PASO - TIPO PALANCA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'NIPLE TELESCOPICO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'NIPLE AUXILIAR','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CON ROSCA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'SIN ROSCA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'SOLDAR','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ROSCADA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'LOCA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'REDUCTORA DE PRESION','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'RECTA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ESCALONADA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'BRIDA EMBONE','created_at' => $createdDate, 'updated_at' => $createdDate],
        ];

        Modelotipo::query()->delete();

        foreach ($modelotipo as $data) {
            Modelotipo::create($data);
        }

    }
}
