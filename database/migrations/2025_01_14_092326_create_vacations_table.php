<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacationsTable extends Migration
{
    public function up()
    {
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();
            $table->string('title_az'); 
            $table->string('title_en'); 
            $table->string('title_ru'); 
            $table->text('description_az'); 
            $table->text('description_en'); 
            $table->text('description_ru'); 
            $table->string('email'); 
            $table->text('email_text'); 
            $table->date('application_deadline'); 
            $table->integer('view_count')->default(0); 
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('vacations');
    }
}