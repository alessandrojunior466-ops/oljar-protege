<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'youtube_url')) {
                $table->string('youtube_url', 2000)->nullable()->after('imagem');
            }
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (Schema::hasColumn('blogs', 'youtube_url')) {
                $table->dropColumn('youtube_url');
            }
        });
    }
};