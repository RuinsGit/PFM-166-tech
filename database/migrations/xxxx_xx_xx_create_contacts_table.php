<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            
            // Temel bilgiler
            $table->string('email');
            $table->string('phone');
            
            // Filial bilgileri
            $table->string('filial_name_az')->nullable();
            $table->string('filial_name_en')->nullable();
            $table->string('filial_name_ru')->nullable();
            
            // Çoklu dil desteği için adres ve çalışma saatleri
            $table->string('address_az');
            $table->text('work_hours_az')->nullable();
            
            $table->string('address_en');
            $table->text('work_hours_en')->nullable();
            
            $table->string('address_ru');
            $table->text('work_hours_ru')->nullable();
            
            // Sosyal medya linkleri
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            
            // Logo ve favicon
            $table->string('logo')->nullable();
            $table->string('logo_2')->nullable();
            $table->string('favicon')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}; 