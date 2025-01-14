<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryTypesTable extends Migration
{
    public function up()
    {
        Schema::create('gallery_types', function (Blueprint $table) {
            $table->id();
            $table->string('title_az'); 
            $table->string('title_en'); 
            $table->string('title_ru'); 
            $table->boolean('status')->default(1); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gallery_types');
    }
}