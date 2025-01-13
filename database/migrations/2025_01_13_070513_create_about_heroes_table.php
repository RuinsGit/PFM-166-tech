<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            
            // Image ALT - 3 dilde
            $table->string('image_alt_az')->nullable();
            $table->string('image_alt_en')->nullable();
            $table->string('image_alt_ru')->nullable();
            
            // Description 1
            $table->text('description1_az');
            $table->text('description1_en')->nullable();
            $table->text('description1_ru')->nullable();
            
            // Description 2
            $table->text('description2_az');
            $table->text('description2_en')->nullable();
            $table->text('description2_ru')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_heroes');
    }
};