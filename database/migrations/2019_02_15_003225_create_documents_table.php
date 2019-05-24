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
            $table->string('title')->nullable(); #titulo
            $table->string('header')->nullable(); #encabezado
            $table->string('from')->nullable(); #de
            $table->string('to')->nullable(); #para
            $table->string('affair')->nullable(); #asunto
            $table->date('date')->nullable(); #fecha
            $table->text('text')->nullable(); #texto
            $table->string('file')->nullable(); #archivo
            $table->integer('document_type_id')->unsigned(); #tipo
            $table->integer('person_id')->unsigned(); #persona_id
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
