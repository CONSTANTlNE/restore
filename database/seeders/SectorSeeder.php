<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       Sector::create([
            'name' => 'გლდანი 1',
            'address' => 'გლდანის 1-2-3 მკ',
        ])->prices()->create([
            'price' => 10
        ]);

       Sector::create([
            'name' => 'გლდანი 2',
            'address' => 'გლდანის 4-5-6 მკ',
        ])->prices()->create([
           'price' => 8
       ]);

        Sector::create([
            'name' => 'ვარგეთილი',
            'address' => 'ვარკეთილის ყველა მიკრო',
        ])->prices()->create([
            'price' => 5
        ]);





    }
}

