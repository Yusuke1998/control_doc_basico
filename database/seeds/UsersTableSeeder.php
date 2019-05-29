<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Person;
class UsersTableSeeder extends Seeder
{
    public function run()
    {
    	$persona = Person::create([
    		'ci'		=>	'1010101010',
    		'type_ci'	=>	'V',
    		'firstname'	=>	'admin',
    		'lastname'	=>	'admin',
    		'position'	=>	'Root',
    		'address'	=>	'YouHeard<3',
    		'phone'		=>	'04161428973'
    	]);
    	
        $usuario = User::create([
        	'name'		=>	'admin',
        	'email'		=>	'admin@admin.com',
        	'password'	=>	bcrypt('admin'),
        	'type'		=>	'administrador',
        	'person_id'	=>	$persona->id,
        ]);
    }
}
