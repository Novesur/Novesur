<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Subfamilia;

class SubfamiliaTableSeeder extends Seeder
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

        $subfamilia =[
            ['nombre' => 'DN15 (1/2") R=63 Q3 1,6  LONG  110','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN15 (1/2") R=80 Q3 2,5  LONG  110','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN15 (1/2") R=100 Q3 2,5  LONG  110 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN15 (1/2") R=125 Q3 2,5  LONG  110 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN15 (1/2") R=160 Q3 2,5  LONG  110 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN20 (3/4")R=100 Q3 4 LONG 130 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN15 (1/2")R=100 Q3 2.5 LONG 165 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN15 (1/2")R=125 Q3 2.5 LONG 165 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN15 (1/2")R=160 Q3 2.5 LONG 165 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN20 (3/4")R=100 Q3-4 LONG 190 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN20 (3/4")R=125 Q3-4 LONG 190 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN20 (3/4")R=160 Q3-4 LONG 190 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN25 (1")R=100 Q3 6.3 LONG 165 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN25 (1")R=100 Q3 6.3 LONG 260 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN25 (1")R=160 Q3 6.3 LONG 260 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN32 (1.1/4")R=100 Q3-10 LONG 260 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN32 (1.1/4")R=125 Q3-10 LONG 260 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN32 (1.1/4")R=160 Q3-10 LONG 260 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN40 (1.1/2")R=100 Q3-16 LONG 300 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN40 (1.1/2")R=125 Q3-16 LONG 300 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN40 (1.1/2")R=160 Q3-16 LONG 300 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN50 (2")R=100 Q3-25 LONG 300 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN50 (2")R=125 Q3-25 LONG 300 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN50 (2")R=100 Q3-40 LONG 200 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN65 (2.1/2")R=160 Q3-63 LONG 200 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN80 (3")R=100 Q3-100 LONG 225 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN100 (4")R=100 Q3-160 LONG 250 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN150 (6")R=100 Q3-250 LONG 300 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN200 (8")R=100 Q3-400 LONG 350 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN250 (10")R=100 Q3-160 LONG 225 mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '1/2"','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '3/4"','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '1"','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '1.1/4"','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '1.1/2"','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '2"','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '3"','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '4"','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '6"','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '8"','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN100','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN150','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN200','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN250','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN300','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '50MM','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '63MM','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '75mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '110mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '160mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '200mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => '250mm','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN 50 (56-74)','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN 80 (84-108)','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN100(109-128)','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN150(159-182)','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN200(198-225)','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN250(267-289)','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN300(322-346)','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN100  (109-128/138-153)','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN150(159-182/192-210)','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN200  (192-210/218-235)','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN250  (242-262/272-289)','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DN300  (315-332/322-339)','created_at' => $createdDate, 'updated_at' => $createdDate],

        ];
        Subfamilia::query()->delete();

        foreach ($subfamilia as $data) {
            Subfamilia::create($data);
        }
    }

}
