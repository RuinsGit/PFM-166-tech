<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            
            // Title - 3 dilde
            $table->string('title_az');
            $table->string('title_en')->nullable();
            $table->string('title_ru')->nullable();
            
            // Text - 3 dilde
            $table->text('text_az');
            $table->text('text_en')->nullable();
            $table->text('text_ru')->nullable();
            
            // Image ve ALT
            $table->string('image');
            $table->string('image_alt_az')->nullable();
            $table->string('image_alt_en')->nullable();
            $table->string('image_alt_ru')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_sections');
    }
};