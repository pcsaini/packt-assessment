<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->updateOrCreate([
            'email' => 'admin@test.com'
        ], [
            'email' => 'admin@test.com',
            'name' => 'Admin',
            'password' => bcrypt('password'),
            'email_verified_at' => now()
        ]);
    }
}
