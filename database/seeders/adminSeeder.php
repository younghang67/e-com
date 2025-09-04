<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'asdf@gmail.com',
            'password' => bcrypt('asdf'),
            'is_admin' => true,
            'email_verified_at' => now(),

        ]);
    }
}
