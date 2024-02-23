<?php

use App\MotivoTraslado;
use Illuminate\Database\Seeder;

class MotivoTrasladoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $motivoTraslado =[
            ['nombre' => 'VENTA'],
            ['nombre' => 'COMPRA'],
            ['nombre' => 'TRASLADO ENTRE ESTABLECIMIENTOS DE UNA MISMA EMPRESA'],
            ['nombre' => 'OTROS MOTIVOS'],
            ['nombre' => 'DEVOLUCION'],
            ['nombre' => 'TRASLADO DE BIENES PARA SU TRANSFORMACION'],
            ['nombre' => 'TRASLADO DE EMISOR ITINERANTE'],
            ['nombre' => 'EXPORTACION'],
            ['nombre' => 'IMPORTACION'],
            ['nombre' => 'VENTA SUJETA A CONFIRMACION DE COMPRA'],

        ];
        MotivoTraslado::query()->delete();
        foreach ($motivoTraslado as $data) {
            MotivoTraslado::create($data);
        }
    }
    }

