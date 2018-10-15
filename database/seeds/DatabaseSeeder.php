<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Doctor;
use App\Models\Company;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'      => 'Mauricio Amorim',
            'email'     => 'mjvamorim@gmail.com',
            'password'  => bcrypt('123456'),
        ]);
        User::create([
            'name'      => 'Fabiana Amorim',
            'email'     => 'frgamorim@gmail.com',
            'password'  => bcrypt('123456'),
        ]);
/*         Doctor::create([
            'name'      => 'Alexandre Magno Viana Amorim',
            'email'     => 'amvamorim@gmail.com',   
        ]); */
        Company::create([
            'name'      => 'Consultorio 1 ',
            'mysql_host' => 'localhost',
            'mysql_database' => 'clinic1',
            'mysql_username' => 'root',
            'mysql_password' => 'root',  
        ]);
        Company::create([
            'name'      => 'Consultorio 2',
            'mysql_host' => 'localhost',
            'mysql_database' => 'clinic2',
            'mysql_username' => 'root',
            'mysql_password' => 'root',  
        ]);
    }
}
