<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ci')->unique();
            $table->string('type_ci');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('cargo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('people');
    }
}
