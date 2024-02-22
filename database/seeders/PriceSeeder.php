<?php

namespace Database\Seeders;

use App\Models\ServicePrice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServicePrice::create([
            'price'=> 10,
        ]);

        ServicePrice::create([
            'price'=> 5,
        ]);
        ServicePrice::create([
            'price'=> 8,
        ]);
    }
}
