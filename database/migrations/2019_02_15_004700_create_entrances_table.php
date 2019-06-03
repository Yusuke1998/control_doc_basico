<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrancesTable extends Migration
{
    public function up()
    {
        Schema::create('entrances', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('commentary')->nullable();
            $table->integer('area_id')->unsigned();
            $table->integer('site_id')->unsigned()->nullable();
            $table->integer('document_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
            $table->foreign('document_id')->references('id')->on('documents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entrances');
    }
}
