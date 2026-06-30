<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galeria_videos', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 100);
            $table->string("conteudo");
            $table->text("descricao");
            $table->timestamps();
            $table->foreignId('blogs_id')
                ->constrained('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeria_videos');
    }
};
