<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Marca;

use function Ramsey\Uuid\v1;

class MarcaTableSeeder extends Seeder
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
        $marca =[
            ['nombre' => 'S/MARCA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'NOVESUR','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ZENNER','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'POWOGAZ','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CONCYSSA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DON BOSCO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TRIVECA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'FLOW RAM','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CIM','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'SANKING','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'SIEMMESS','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PCP','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'INYECTOPLAST','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'SAMATA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PLASTIK','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'HIDROSEAL','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TUBOPLAST','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PAVCO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'POLIFUSION','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'AMANCO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'HANNA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'JEBEUSA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DEWALT','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'SHUBERT','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'SCHU','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'SOUHLAND TOOL','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CHUANGNE NG','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'BOHELER','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TAPIA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'INDURA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'AQUAFIT','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'SANFLEX','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'VERTEX','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'MAXIRAN','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'STANLEY','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'KISGAL','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'BADOTHERM','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TRUPPER','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'NICOLL','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'MASTER BATCH','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CHLOR PLUS','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'BOSSINI','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'VIKING JHONSON','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'EKOVAL','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'STS','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ARROW','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'AISA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'KAMASA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'INCCOSAC','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'KNT','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'EUROTUBO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TILFHOR','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'MAX-LIFE','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'SYI','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TOPEX','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'OATEY','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'BOSCH','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'FUMOSAC','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'VAE ITALY','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ASTABRASIL','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ENIPSA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'OXFORD','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'RIDGID','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ESSETI','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TEKNO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'SHURTAPE','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'YASCELL','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'EATHISA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'A&E','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CABLELINEA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DYNAMIC','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ARMAS','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'M&L','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'SIKA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PREMIUM','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PAM','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'B METERS','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'T.B. WOODS ','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'HACH','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'SCHOTT-ALEMANIA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'KALLPA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TESS','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PLUSCHLOR','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'NWM','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ERA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'FIMACA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'STONETOWN','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PROINVAL','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'LONZA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'R&G','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'JKLON','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'HELBERT','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'JKLONG','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'INDISAP','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'BERMAND','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TRAMONTINA','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PATO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'PHILIPS','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'GIACOMINI','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TAIRI','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'DOROT','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'CONCYCOR','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ARI','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'KROSS','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'ENZO','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'AQUAPLAST','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'TRIDENTE','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'KLEPER','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'AIRON','created_at' => $createdDate, 'updated_at' => $createdDate],
            ['nombre' => 'WIKA','created_at' => $createdDate, 'updated_at' => $createdDate],

        ];
        Marca::query()->delete();

        foreach ($marca as $data) {
            Marca::create($data);
        }
    }
}
