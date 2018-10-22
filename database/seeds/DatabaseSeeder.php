<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Seeder;
use App\User;
use App\Models\Doctor;
use App\Models\Company;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
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
        User::create([
            'name'      => 'Mauricio Amorim',
            'email'     => 'mjvamorim@gmail.com',
            'password'  => bcrypt('123456'),
            'type'      => 'Admin',
        ]);
        User::create([
            'name'      => 'Fabiana Amorim',
            'email'     => 'frgamorim@gmail.com',
            'password'  => bcrypt('123456'),
            'company_id'=> 2,
        ]);
        $this->createTenant();
        $this->call(DoctorsTableSeeder::class);
        
    }

    public function createTenant() {

        if(!Schema::connection('tenant')->hasTable('doctors')) {
            Schema::connection('tenant')->create('doctors', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->string('zipcode')->nullable();
                $table->string('address1')->nullable();
                $table->string('address2')->nullable();
                $table->string('district')->nullable();
                $table->string('city')->nullable();
                $table->string('state')->default('RJ')->nullable();
                $table->string('country')->default('Brasil')->nullable();
                $table->string('email')->nullable();
                $table->string('mobile')->nullable();
                $table->string('phone')->nullable();
                $table->timestamps();
            });
        }
    }
    

}
