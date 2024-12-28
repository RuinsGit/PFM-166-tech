<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('logos', function (Blueprint $table) {
            $table->id();
            $table->string('logo_1_image'); // Logo 1 için dosya adı
            $table->string('logo_2_image'); // Logo 2 için dosya adı
            $table->text('logo_alt1_az'); // Azerice
            $table->text('logo_alt1_en'); // İngilizce
            $table->text('logo_alt1_ru'); // Rusça
            $table->text('logo_alt2_az'); // Azerice
            $table->text('logo_alt2_en'); // İngilizce
            $table->text('logo_alt2_ru'); // Rusça
            $table->string('logo_title1_az'); // Azerice
            $table->string('logo_title1_en'); // İngilizce
            $table->string('logo_title1_ru'); // Rusça
            $table->string('logo_title2_az'); // Azerice
            $table->string('logo_title2_en'); // İngilizce
            $table->string('logo_title2_ru'); // Rusça
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('logos');
    }
};