<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@mailinator.com',
            'password' => bcrypt('12345678'),
        ]);

        $response->assignRole('ADMIN');

        $response = User::create([
            'name' => 'product owner',
            'username' => 'product_owner',
            'email' => 'po@mailinator.com',
            'password' => bcrypt('12345678'),
        ]);

        $response->assignRole('PRODUCT_OWNER');

        $response = User::create([
            'name' => 'member1',
            'username' => 'member1',
            'email' => 'member1@mailinator.com',
            'password' => bcrypt('12345678'),
        ]);

        $response->assignRole('MEMBER');

        $response = User::create([
            'name' => 'member2',
            'username' => 'member2',
            'email' => 'member2@mailinator.com',
            'password' => bcrypt('12345678'),
        ]);

        $response->assignRole('MEMBER');

        $response = User::create([
            'name' => 'member3',
            'username' => 'member3',
            'email' => 'member3@mailinator.com',
            'password' => bcrypt('12345678'),
        ]);

        $response->assignRole('MEMBER');
    }
}
