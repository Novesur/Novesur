<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Proveedor;

class ProveedorTableSeeder extends Seeder
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

        $proveedor =[
            ['nombre' => 'QUIMICOS GOICOCHEA SAC', 'ruc'=> '20211040352' ,'direccion'=> 'AV NESTOR GAMBETA 150 - CALLAO', 'telefono'=>'958 786 381', 'email'=>'cesarc@quimicosgoicochea.com', 'contacto'=>'CESAR CONDOR PACHECO', 'nrocuenta1'=>'192-1147717-1-09 / BCP DOLARES','nrocuenta2'=>'0362-01-0000-6188 / BBVA DOLARES' ,'nrocuenta3'=>'' ,'created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CAMARENA HUAMAN JUNIOR', 'ruc'=> '10481314653' ,'direccion'=> 'AV. ARGENTINA NRO 327 INT. K1-3 PASAJE 19 C.C. LA BELLOTA', 'telefono'=>'946213904 / 947394012 / 946095597', 'email'=>'.', 'contacto'=>'PAMELA', 'nrocuenta1'=>'','nrocuenta2'=>'' ,'nrocuenta3'=>'' ,'created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'M & L NEGOFER S.A.C.', 'ruc'=> '20602748821' ,'direccion'=> 'AV. ARGENTINA NRO. 327 INT. 9-10 (PAB.B1 PTO 9-10 LA BELLOTA) LIMA - LIMA - LIMA', 'telefono'=>'979783340 / 981325173', 'email'=>'ventas_myldistribuidora@hotmail.com', 'contacto'=>'MARCO HILARIO', 'nrocuenta1'=>'191-2483942-0-21 / BCP SOLES','nrocuenta2'=>'' ,'nrocuenta3'=>'' ,'created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'INDUSTRIAS TRIVECA S.A.C.', 'ruc'=> '20102108443' ,'direccion'=> 'AV. SURCO NRO. 278 URB. LOS ROSALES LIMA - SANTIAGO DE SURCO', 'telefono'=>'274-2660', 'email'=>'msolis@triveca.com / ventas@triveca.com', 'contacto'=>'MARIELA SOLIS / PAOLO VERA', 'nrocuenta1'=>'','nrocuenta2'=>'' ,'nrocuenta3'=>'' ,'created_at' => $createdDate, 'updated_at' => $createdDate],
        ];
        Proveedor::query()->delete();

        foreach ($proveedor as $data) {
            Proveedor::create($data);
        }


    }
}
