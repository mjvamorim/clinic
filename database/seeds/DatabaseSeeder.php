<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Doctor;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'      => 'Mauricio Amorim',
            'email'     => 'mjvamorim@gmail.com',
            'password'  => bcrypt('123456'),
        ]);
        Doctor::create([
            'name'      => 'Alexandre Magno Viana Amorim',
            'email'     => 'amvamorim@gmail.com',   
        ]);
    }
}
