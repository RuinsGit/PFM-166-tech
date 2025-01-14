<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacationHeroesTable extends Migration
{
    public function up()
    {
        Schema::create('vacation_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('image'); 
            $table->string('image_alt_az'); 
            $table->string('image_alt_en'); 
            $table->string('image_alt_ru'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('vacation_heroes');
    }
}