<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => 'User',
        //     'ic_number' => '982232889823',
        //     'phone_number' => '0128838192',
        //     'office_number' => '0332323232',
        //     'position' => 'Technician',
        //     'department' => 'IT',
        //     'email' => 'user@domain.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);

        // \App\Models\User::factory(5)->create();
        $this->call([
            PermissionSeeder::class,
        ]);

        \App\Models\Room::factory(20)->create();
        \App\Models\Booking::factory(10)->create();

    }
}
