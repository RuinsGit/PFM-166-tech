<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            
           
            $table->string('image');
            $table->string('image_alt_az')->nullable();
            $table->string('image_alt_en')->nullable();
            $table->string('image_alt_ru')->nullable();
            
            
            $table->string('bottom_image');
            $table->string('bottom_image_alt_az')->nullable();
            $table->string('bottom_image_alt_en')->nullable();
            $table->string('bottom_image_alt_ru')->nullable();
            
            
            $table->string('meta_title_az');
            $table->string('meta_title_en')->nullable();
            $table->string('meta_title_ru')->nullable();
            
            $table->text('meta_description_az');
            $table->text('meta_description_en')->nullable();
            $table->text('meta_description_ru')->nullable();
            
            
            $table->string('title1_az');
            $table->string('title1_en')->nullable();
            $table->string('title1_ru')->nullable();
            
            $table->text('text1_az');
            $table->text('text1_en')->nullable();
            $table->text('text1_ru')->nullable();
            
            $table->string('title2_az');
            $table->string('title2_en')->nullable();
            $table->string('title2_ru')->nullable();
            
            $table->text('text2_az');
            $table->text('text2_en')->nullable();
            $table->text('text2_ru')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};