<?php

use App\Distrito;
use Illuminate\Database\Seeder;

class DistritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $distrito =[
            ['nombre' => 'Lima','provincia_id' => 1 , 'ubigeo' => '150101'],
            ['nombre' => 'Ancón','provincia_id' => 1 , 'ubigeo' => '150102'],
            ['nombre' => 'Ate','provincia_id' => 1 , 'ubigeo' => '150103'],
            ['nombre' => 'Barranco','provincia_id' => 1 , 'ubigeo' => '150104'],
            ['nombre' => 'Breña','provincia_id' => 1 , 'ubigeo' => '150105'],
            ['nombre' => 'Carabayllo','provincia_id' => 1 , 'ubigeo' => '150106'],
            ['nombre' => 'Chaclacayo','provincia_id' => 1 , 'ubigeo' => '150107'],
            ['nombre' => 'Chorrillos','provincia_id' => 1 , 'ubigeo' => '150108'],
            ['nombre' => 'Cieneguilla','provincia_id' => 1 , 'ubigeo' => '150109'],
            ['nombre' => 'Comas','provincia_id' => 1 , 'ubigeo' => '150110'],
            ['nombre' => 'El Agustino','provincia_id' => 1 , 'ubigeo' => '150111'],
            ['nombre' => 'Independencia','provincia_id' => 1 , 'ubigeo' => '150112'],
            ['nombre' => 'Jesús María','provincia_id' => 1 , 'ubigeo' => '150113'],
            ['nombre' => 'La Molina','provincia_id' => 1 , 'ubigeo' => '150114'],
            ['nombre' => 'La Victoria','provincia_id' => 1 , 'ubigeo' => '150115'],
            ['nombre' => 'Lince','provincia_id' => 1 , 'ubigeo' => '150116'],
            ['nombre' => 'Los Olivos','provincia_id' => 1 , 'ubigeo' => '150117'],
            ['nombre' => 'Lurigancho','provincia_id' => 1 , 'ubigeo' => '150118'],
            ['nombre' => 'Lurin','provincia_id' => 1 , 'ubigeo' => '150119'],
            ['nombre' => 'Magdalena del Mar','provincia_id' => 1 , 'ubigeo' => '150120'],
            ['nombre' => 'Pueblo Libre','provincia_id' => 1 , 'ubigeo' => '150121'],
            ['nombre' => 'Miraflores','provincia_id' => 1 , 'ubigeo' => '150122'],
            ['nombre' => 'Pachacamac','provincia_id' => 1 , 'ubigeo' => '150123'],
            ['nombre' => 'Pucusana','provincia_id' => 1 , 'ubigeo' => '150124'],
            ['nombre' => 'Puente Piedra','provincia_id' => 1 , 'ubigeo' => '150125'],
            ['nombre' => 'Punta Hermosa','provincia_id' => 1 , 'ubigeo' => '150126'],
            ['nombre' => 'Punta Negra','provincia_id' => 1 , 'ubigeo' => '150127'],
            ['nombre' => 'Rímac','provincia_id' => 1 , 'ubigeo' => '150128'],
            ['nombre' => 'San Bartolo','provincia_id' => 1 , 'ubigeo' => '150129'],
            ['nombre' => 'San Borja','provincia_id' => 1 , 'ubigeo' => '150130'],
            ['nombre' => 'San Isidro','provincia_id' => 1 , 'ubigeo' => '150131'],
            ['nombre' => 'San Juan de Lurigancho','provincia_id' => 1 , 'ubigeo' => '150132'],
            ['nombre' => 'San Juan de Miraflores','provincia_id' => 1 , 'ubigeo' => '150133'],
            ['nombre' => 'San Luis','provincia_id' => 1 , 'ubigeo' => '150134'],
            ['nombre' => 'San Martín de Porres','provincia_id' => 1 , 'ubigeo' => '150135'],
            ['nombre' => 'San Miguel','provincia_id' => 1 , 'ubigeo' => '150136'],
            ['nombre' => 'Santa Anita','provincia_id' => 1 , 'ubigeo' => '150137'],
            ['nombre' => 'Santa María del Mar','provincia_id' => 1 , 'ubigeo' => '150138'],
            ['nombre' => 'Santa Rosa','provincia_id' => 1 , 'ubigeo' => '150139'],
            ['nombre' => 'Santiago de Surco','provincia_id' => 1 , 'ubigeo' => '150140'],
            ['nombre' => 'Surquillo','provincia_id' => 1 , 'ubigeo' => '150141'],
            ['nombre' => 'Villa El Salvador','provincia_id' => 1 , 'ubigeo' => '150142'],
            ['nombre' => 'Villa María del Triunfo','provincia_id' => 1 , 'ubigeo' => '150143'],
     


        ];
        Distrito::query()->delete();

        foreach ($distrito as $data) {
            Distrito::create($data);
        }
    }
}
