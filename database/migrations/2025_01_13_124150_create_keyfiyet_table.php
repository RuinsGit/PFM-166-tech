<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('keyfiyets', function (Blueprint $table) {
            $table->id();
            $table->integer('number_filial'); 
            $table->integer('number_customer'); 
            $table->integer('number_keyfiyet'); 
            $table->string('filial_title_az'); 
            $table->string('filial_title_en'); 
            $table->string('filial_title_ru'); 
            $table->string('customer_title_az'); 
            $table->string('customer_title_en'); 
            $table->string('customer_title_ru'); 
            $table->string('keyfiyet_title_az'); 
            $table->string('keyfiyet_title_en'); 
            $table->string('keyfiyet_title_ru'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('keyfiyets');
    }
};
