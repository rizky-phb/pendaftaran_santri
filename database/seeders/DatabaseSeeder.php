<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**u
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Make sure 'role' column exists in your users table and UserFactory supports these fields
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('12345678'), // Password yang di-hash
        ]);
        User::factory()->create([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'role' => 'superadmin',
            'password' => bcrypt('12345678'), // Password yang di-hash
        ]);
    }
}
