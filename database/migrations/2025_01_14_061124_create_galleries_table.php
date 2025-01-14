<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title_az'); 
            $table->string('title_en'); 
            $table->string('title_ru'); 
            $table->string('main_image'); 
            $table->string('main_image_alt_az')->nullable();
            $table->string('main_image_alt_en')->nullable(); 
            $table->string('main_image_alt_ru')->nullable(); 
            $table->text('bottom_images')->nullable(); 
            $table->text('bottom_images_alt_az')->nullable(); 
            $table->text('bottom_images_alt_en')->nullable(); 
            $table->text('bottom_images_alt_ru')->nullable(); 
            $table->unsignedBigInteger('gallery_type_id')->nullable(); 
            $table->string('meta_title_az')->nullable(); 
            $table->string('meta_title_en')->nullable(); 
            $table->string('meta_title_ru')->nullable(); 
            $table->text('meta_description_az')->nullable(); 
            $table->text('meta_description_en')->nullable(); 
            $table->text('meta_description_ru')->nullable(); 

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('galleries');
    }
};