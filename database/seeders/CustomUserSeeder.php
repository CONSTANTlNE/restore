<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomUserSeeder extends Seeder
{

    protected static ?string $password;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $customer= User::create([
            'name' => 'Customer 1',
            'email' => 'customer1@example.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'ident_no' => '123456789',
            'legal_form' => 'იმ',
            'company_name' => 'სატესტო კომპანია',
            'mobile1'=> '555111111',
            'remember_token' => Str::random(10),
        ]);
       $customer->assignRole('customer');
    }
}
