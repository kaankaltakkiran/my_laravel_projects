<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   /*  veritabanına tablo oluşturur */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            /* constraint ile ilişkilendirme yapar. ve cascadeOnDelete ile user slindiğinde postları da silinir */
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('body');
            $table->timestamps();
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
