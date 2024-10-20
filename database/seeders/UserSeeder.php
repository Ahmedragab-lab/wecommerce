<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        User::truncate();
        $superadmin = User::create([
            'name' => 'Ahmed Ragab',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'phone' => '01021493036',
            'type' => 'super_admin',
            'image'=> 'no-image.jpg',
            'status'=> 1,
            'remember_token' => Str::random(10),
            'email_verified_at' => now(),
        ]);
        // $superadmin->attachRole('super_admin');
        $superadmin->addRole('super_admin');

        $admin = User::create([
            'name'              => 'yasin',
            'phone'             => '01000000000',
            'email'             => 'admin@app.com',
            'password'          => bcrypt('123456'),
            'image'             => 'no-image.jpg',
            'type'              => 'admin',
            'status'            => 1,
            'remember_token'     => Str::random(10),
            'email_verified_at'  => now(),
        ]);
        $admin->addRole('admin');

        $user = User::create([
            'name'              => 'sahra',
            'phone'             => '01000000005',
            'email'             => 'user@app.com',
            'password'          => bcrypt('123456'),
            'image'             => 'no-image.jpg',
            'status'            => 1,
            'type'              => 'user',
            'remember_token'     => Str::random(10),
            'email_verified_at' => now(),
        ]);
        $user->addRole('user');

        for ($i = 1; $i <= 20; $i++) {
            $random_user = User::create([
                'name'              => $faker->name,
                'phone'             => '010' . $faker->numberBetween(10000000, 99999999),
                'email'             => $faker->unique()->safeEmail,
                'password'          => bcrypt('123456'),
                'image'             => 'no-image.jpg',
                'status'            => 1,
                'type'              => 'user',
                'remember_token'    => Str::random(10),
                'email_verified_at' => now(),
            ]);
            $random_user->addRole('user');
        }
    }
}
