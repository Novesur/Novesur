<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Homologacion;

class HomologacionTableSeeder extends Seeder
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

        $homologado =[
            ['nombre' => 'HOMOLOGADO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'HOMOLOGADO CON V.I','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '.','created_at' => $createdDate, 'updated_at' => $createdDate],

        ];
        Homologacion::query()->delete();

        foreach ($homologado as $data) {
            Homologacion::create($data);
        }
    }
}
