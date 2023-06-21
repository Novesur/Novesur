<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
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
            ['firstname' => 'Jorge', 'secondname'=> 'Sarmiento' ,'lastname'=> 'Trujillo', 'username'=>'Chocho', 'email'=>'jsarmiento@novesur.com', 'celular'=>'1', 'roles_id'=>'1','almacen_id'=>'1' ,'password'=>'$2y$10$jNS7jza3x05HmHrQgTvDxuEHFFYLUiTWl7tI/JShUp40D6ORFg0J.' ,'created_at' => $createdDate, 'updated_at' => $createdDate,'deleted_at'=> NULL],
            ['firstname' => 'Ernesto', 'secondname'=> 'Cabada' ,'lastname'=> 'Mandujano', 'username'=>'emandujano', 'email'=>'emandujano@novesur.com', 'celular'=>'2', 'roles_id'=>'2','almacen_id'=>'1' ,'password'=>'$2y$10$eRkFtGoAgW2kVx8VYp3//OIm7MbSO3y7wjApgIIqftuieDWs1wTqS' ,'created_at' => $createdDate, 'updated_at' => $createdDate,'deleted_at'=> NULL],
            ['firstname' => 'Alexander', 'secondname'=> 'Diaz' ,'lastname'=> 'Vera', 'username'=>'adiaz', 'email'=>'adiaz@novesur.com', 'celular'=>'3', 'roles_id'=>'1','almacen_id'=>'1' ,'password'=>'$2y$10$eRkFtGoAgW2kVx8VYp3//OIm7MbSO3y7wjApgIIqftuieDWs1wTqS' ,'created_at' => $createdDate, 'updated_at' => $createdDate,'deleted_at'=> NULL],
            ['firstname' => 'Joselyn Diana', 'secondname'=> 'Vera' ,'lastname'=> 'Cieza', 'username'=>'Jvera', 'email'=>'asistente.comercial@novesur.com', 'celular'=>'4', 'roles_id'=>'2','almacen_id'=>'1' ,'password'=>'$2y$10$i1sos9kBhk8tEaB1y/EJ5OvESMnhsvtjb2jJi8i9/FsXS66hMUnga' ,'created_at' => $createdDate, 'updated_at' => $createdDate,'deleted_at'=> NULL],

        ];
        User::query()->delete();

        foreach ($proveedor as $data) {
            User::create($data);
        }

    }
}
