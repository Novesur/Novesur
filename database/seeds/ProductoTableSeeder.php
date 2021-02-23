<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Producto;

class ProductoTableSeeder extends Seeder
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

        $producto =[
            ['codigo' => '0104117708', 'familia_id'=> '1' ,'subfamilia_id'=> '4', 'modelotipo_id'=>'11', 'marca_id'=>'77', 'material_id'=>'8', 'estado_id'=>'1','user_id'=>'3','homologacion_id'=>'1' ,'created_at' => $createdDate, 'updated_at' => $createdDate],
            ['codigo' => '0103117708', 'familia_id'=> '1' ,'subfamilia_id'=> '3', 'modelotipo_id'=>'11', 'marca_id'=>'77', 'material_id'=>'8', 'estado_id'=>'1','user_id'=>'3','homologacion_id'=>'1'  ,'created_at' => $createdDate, 'updated_at' => $createdDate],
            ['codigo' => '0106117708', 'familia_id'=> '1' ,'subfamilia_id'=> '6', 'modelotipo_id'=>'11', 'marca_id'=>'77', 'material_id'=>'8', 'estado_id'=>'1','user_id'=>'3','homologacion_id'=>'1'   ,'created_at' => $createdDate, 'updated_at' => $createdDate],
            ['codigo' => '0110127708', 'familia_id'=> '1' ,'subfamilia_id'=> '10', 'modelotipo_id'=>'12', 'marca_id'=>'77', 'material_id'=>'8', 'estado_id'=>'1','user_id'=>'3','homologacion_id'=>'1'   ,'created_at' => $createdDate, 'updated_at' => $createdDate],
            ['codigo' => '0114127708', 'familia_id'=> '1' ,'subfamilia_id'=> '14', 'modelotipo_id'=>'12', 'marca_id'=>'77', 'material_id'=>'8', 'estado_id'=>'1','user_id'=>'3','homologacion_id'=>'1'   ,'created_at' => $createdDate, 'updated_at' => $createdDate],
            ['codigo' => '0116127708', 'familia_id'=> '1' ,'subfamilia_id'=> '16', 'modelotipo_id'=>'12', 'marca_id'=>'77', 'material_id'=>'8', 'estado_id'=>'1','user_id'=>'3','homologacion_id'=>'1'   ,'created_at' => $createdDate, 'updated_at' => $createdDate],
            ['codigo' => '0119127708', 'familia_id'=> '1' ,'subfamilia_id'=> '19', 'modelotipo_id'=>'12', 'marca_id'=>'77', 'material_id'=>'8', 'estado_id'=>'1','user_id'=>'3','homologacion_id'=>'1'  ,'created_at' => $createdDate, 'updated_at' => $createdDate],
            ['codigo' => '0122127708', 'familia_id'=> '1' ,'subfamilia_id'=> '22', 'modelotipo_id'=>'12', 'marca_id'=>'77', 'material_id'=>'8', 'estado_id'=>'1','user_id'=>'3','homologacion_id'=>'1'  ,'created_at' => $createdDate, 'updated_at' => $createdDate],

        ];
        Producto::query()->delete();

        foreach ($producto as $data) {
            Producto::create($data);
        }
    }
}
