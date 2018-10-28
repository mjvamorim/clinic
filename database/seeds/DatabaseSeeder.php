<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Seeder;
use App\User;
use App\Tenant\Models\Company;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Company::create([
            'name'      => 'Pegasus Sistemas',
            'db_host' => '127.0.0.1',
            'db_database' => 'clinic1',
            'db_username' => 'root',
            'db_password' => 'root',  
        ]);
       
        User::create([
            'name'      => 'Mauricio Amorim',
            'email'     => 'mjvamorim@gmail.com',
            'password'  => bcrypt('123456'),
            'type'      => 'Admin',
        ]);
    }
}
