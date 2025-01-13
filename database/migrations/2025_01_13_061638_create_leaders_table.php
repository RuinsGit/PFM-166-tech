<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('leaders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('image')->nullable();
            
            // AZ dili için
            $table->string('position_az');
            
            // EN dili için
            $table->string('position_en')->nullable();
            
            // RU dili için
            $table->string('position_ru')->nullable();
            
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leaders');
    }
};