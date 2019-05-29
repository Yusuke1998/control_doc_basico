<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable(); #codigo
            $table->string('title')->nullable(); #titulo
            $table->string('affair')->nullable(); #asunto
            $table->date('date')->nullable(); #fecha
            $table->string('file')->nullable(); #archivo
            $table->integer('document_type_id')->unsigned()->nullable(); #tipo
            $table->integer('person_id')->unsigned()->nullable(); #persona_id
            $table->integer('user_id')->unsigned(); #usuario_id

            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
}
