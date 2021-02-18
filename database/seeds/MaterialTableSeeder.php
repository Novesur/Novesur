<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Material;

class MaterialTableSeeder extends Seeder
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
        $material =[
            ['nombre' => 'FIERRO LISO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'FIERRO CORRUGADO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'FIERRO FUNDIDO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'BRONCE','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'BRONCE-NIQUELADO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PVC','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'JEBE','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'LATON','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ACERO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'FIERRO GALVANIZADO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'POLIPROPILENO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ACERO INOX','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CONCRETO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'METAL CUTTING','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TEFLON','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'METAL','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ACERO NEGRO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'MADERA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DIAMANTADO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CALCIO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ESMALTE','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CUERO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'FIERRO SINCADO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'LIQUIDO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'GRANULADO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PLOMO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CPVC','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PVC / LATA IMANTADO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ZINCADO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PLANCHA F° ESTRELLADA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ALUMINIO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CRISTAL','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TOTAL ACERO INOX','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'FIERRO FUNDIDO DUCTIL','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'GEL','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'POLVO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ACERO CARBONO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'INOX - BRONCE','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ACERO FORJADO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'FIBRA DE VIDRIO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CROMADO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'HILO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'GUANTE ANTIVIBRA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CUERO C/PUNTA ACERO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ACERO C/MADERA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TELA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'VIDRIO TEMPLADO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'SCH40','created_at' => $createdDate, 'updated_at' => $createdDate],

        ];
        Material::query()->delete();

        foreach ($material as $data) {
            Material::create($data);
        }
    }
}
