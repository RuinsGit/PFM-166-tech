<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerHeroesTable extends Migration
{
    public function up()
    {
        Schema::create('career_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('image'); 
            $table->string('image_alt_az'); 
            $table->string('image_alt_en'); 
            $table->string('image_alt_ru');     
            $table->text('description_az'); 
            $table->text('description_en');     
            $table->text('description_ru'); 
            $table->string('video'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('career_heroes');
    }
}