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
            $table->string('code')->unique(); #codigo
            $table->string('title')->nullable(); #titulo
            $table->string('header')->nullable(); #encabezado
            $table->string('from')->nullable(); #de
            $table->string('to')->nullable(); #para
            $table->string('affair')->nullable(); #asunto
            $table->date('date')->nullable(); #fecha
            $table->text('text')->nullable(); #texto
            $table->integer('person_id')->unsigned(); #persona_id
            $table->integer('user_id')->unsigned(); #usuario_id
            $table->integer('document_type_id')->unsigned()->nullable(); #tipo_id
            $table->integer('file_id')->unsigned()->nullable(); #archivo_id
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
