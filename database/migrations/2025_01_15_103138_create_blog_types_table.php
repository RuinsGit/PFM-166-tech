<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('blog_types', function (Blueprint $table) {
            $table->id();
            $table->string('title_az');
            $table->string('title_en');
            $table->string('title_ru');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // Add blog_type_id to blogs table
        Schema::table('blogs', function (Blueprint $table) {
            $table->foreignId('blog_type_id')->nullable()->constrained('blog_types')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['blog_type_id']);
            $table->dropColumn('blog_type_id');
        });
        
        Schema::dropIfExists('blog_types');
    }
}; 