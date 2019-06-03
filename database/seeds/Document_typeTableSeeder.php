<?php

use Illuminate\Database\Seeder;
use App\Document_type;

class Document_typeTableSeeder extends Seeder
{
    public function run()
    {
        $tipos = ['Seguridad','Seguridad simple','Comunicado'];

        foreach ($tipos as $key => $value) {
        	Document_type::create([
        		'name'	=>	$value,
        	]);
        }

    }
}
