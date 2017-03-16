<?php


namespace App;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $vader = \DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => \Hash::make('admin'),
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
        ]);
    }
}