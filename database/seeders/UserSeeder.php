<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Demo user
        User::create([
            'name' => 'Demo User',
            'email' => 'demo@demo.com',
            'password' => Hash::make('demo'),
        ]);

        // Altri utenti di esempio
        User::factory(5)->create();
    }
}
