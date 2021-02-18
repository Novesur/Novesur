<?php

use Illuminate\Database\Seeder;
use App\PermissionRol;

class PermissionRolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{

    $permission =[
        ['rol_id' => 2, 'permission_id' => 2],
        ['rol_id' => 2, 'permission_id' => 3],
        ['rol_id' => 2, 'permission_id' => 4],
        ['rol_id' => 2, 'permission_id' => 5],
        ['rol_id' => 2, 'permission_id' => 6],
        ['rol_id' => 2, 'permission_id' => 7],
        ['rol_id' => 2, 'permission_id' => 8],
        ['rol_id' => 2, 'permission_id' => 13],
        ['rol_id' => 2, 'permission_id' => 14],
        ['rol_id' => 2, 'permission_id' => 15],
        ['rol_id' => 1, 'permission_id' => 1],
        ['rol_id' => 1, 'permission_id' => 2],
        ['rol_id' => 1, 'permission_id' => 3],
        ['rol_id' => 1, 'permission_id' => 4],
        ['rol_id' => 1, 'permission_id' => 5],
        ['rol_id' => 1, 'permission_id' => 6],
        ['rol_id' => 1, 'permission_id' => 7],
        ['rol_id' => 1, 'permission_id' => 8],
        ['rol_id' => 1, 'permission_id' => 9],
        ['rol_id' => 1, 'permission_id' => 10],
        ['rol_id' => 1, 'permission_id' => 11],
        ['rol_id' => 1, 'permission_id' => 12],
        ['rol_id' => 1, 'permission_id' => 13],
        ['rol_id' => 1, 'permission_id' => 14],
        ['rol_id' => 1, 'permission_id' => 15],
        ['rol_id' => 1, 'permission_id' => 16],
        ['rol_id' => 1, 'permission_id' => 17],

    ];

PermissionRol::query()->delete();

foreach ($permission as $data) {
    PermissionRol::create($data);
}
    }
}
