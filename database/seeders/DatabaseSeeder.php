<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(1)->create();

//         \App\Models\User::factory()->create([
//             'name' => 'test',
//             'email' => 'gmta.constantine@gmail.com',
//         ]);





//        $this->call(RoleSeeder::class);
//        $user = User::factory(1)->create()->first();
//        $user->assignRole('customer');
        // Create or retrieve the 'customer' role

        // Assign the 'customer' role to the user
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SectorSeeder::class);
        $this->call(CustomUserSeeder::class);

    }
}
