<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcceptancesTable extends Migration
{
    public function up()
    {
        Schema::create('acceptances', function (Blueprint $table) {
            $table->id();
            $table->string('title_az'); 
            $table->string('title_en'); 
            $table->string('title_ru'); 
            $table->text('text_az'); 
            $table->text('text_en'); 
            $table->text('text_ru'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('acceptances');
    }
}