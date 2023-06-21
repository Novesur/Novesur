<?php

use Illuminate\Database\Seeder;
use App\Rol;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
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

        $roles =[
            ['slug' => 'ROL.ADMINISTRADOR','nombre' => 'ADMINISTRADOR','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['slug' => 'ROL.ALMACEN','nombre' => 'ALMACEN','created_at' => $createdDate, 'updated_at' => $createdDate],
   


        ];
        Rol::query()->delete();

        foreach ($roles as $data) {
            Rol::create($data);
        }
    }
}
