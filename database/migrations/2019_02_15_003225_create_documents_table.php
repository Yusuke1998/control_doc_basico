<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title'); #titulo
            $table->string('description')->nullable(); #descripcion
            $table->string('type')->nullable(); #tipo
            $table->string('affair')->nullable(); #asunto
            $table->string('file')->nullable(); #archivo
            $table->integer('person_id')->unsigned(); #persona_id

            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
