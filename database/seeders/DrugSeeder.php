<?php

namespace Database\Seeders;

use App\Models\Drug;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $drugs_list = [
        'تریاک',
        'مورفین',
        'هرویین',
        'شیره',
        'ترامادول',
        'متادون',
        'شیشه',
        'ریتالین',
        'کوکایین',
        'کراک',
        'گل',
        'حشیش',
       ];

       foreach($drugs_list as $drug){
        Drug::create([
            'name' => $drug
        ]);
       }
    }
}
