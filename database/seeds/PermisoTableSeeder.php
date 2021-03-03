<?php

use Illuminate\Database\Seeder;
use App\Permission;
use Carbon\Carbon;

class PermisoTableSeeder extends Seeder
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


        $permiso =[
            ['slug' => 'dashboard.index', 'name' => 'dashboard','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['slug' => 'productos.index', 'name' => 'productos','created_at' => $createdDate,'updated_at' => $createdDate],
            ['slug' => 'marca.index', 'name' => 'marca','created_at' => $createdDate,'updated_at' => $createdDate],
            ['slug' => 'material.index','name' => 'material','created_at' => $createdDate,'updated_at' => $createdDate],
            ['slug' => 'familia.index','name' => 'familia','created_at' => $createdDate,'updated_at' => $createdDate],
            ['slug' => 'subfamilia.index','name' => 'subfamilia','created_at' => $createdDate,'updated_at' => $createdDate],
            ['slug' => 'modelotipo.index','name' => 'modelotipo','created_at' => $createdDate,'updated_at' => $createdDate],
            ['slug' => 'proveedor.index','name' => 'proveedor','created_at' => $createdDate,'updated_at' => $createdDate],
            [ 'slug' => 'usuario.index','name' => 'usuario','created_at' => $createdDate,'updated_at' => $createdDate],
            ['slug' => 'roles.index ','name' => 'roles','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['slug' => 'permiso.index','name' => 'permiso','created_at' => $createdDate,'updated_at' => $createdDate],
            ['slug' => 'usuario.crear','name' => 'Usuario Crear','created_at' => $createdDate,'updated_at' => $createdDate],
            ['slug' => 'productos.crear','name' => 'Producto Crear','created_at' => $createdDate,'updated_at' => $createdDate],
            ['slug' => 'kardex.index','name' => 'Kardex Crear','created_at' => $createdDate,'updated_at' => $createdDate],
            ['slug' => 'reporte.movimientoXProducto','name' => 'Movimiento por Producto','created_at' => $createdDate,'updated_at' => $createdDate],
            ['slug' => 'area.ventas','name' => 'Seccion Ventas','created_at' => $createdDate,'updated_at' => $createdDate],
            ['slug' => 'cotizacion.create','name' => 'Cotizar Clientes','created_at' => $createdDate,'updated_at' => $createdDate],
            ['slug' => 'admin.listado_coti','name' => 'Listado cotizaciones admin','created_at' => $createdDate,'updated_at' => $createdDate],
        ];

        Permission::query()->delete();

        foreach ($permiso as $data) {
            Permission::create($data);
        }



    }
}
