<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (!Schema::hasColumn('blogs', 'midias')) {
                $table->json('midias')->nullable()->after('imagem');
            }
        });

        Schema::table('videos', function (Blueprint $table) {
            if (!Schema::hasColumn('videos', 'thumbnail_url')) {
                $table->string('thumbnail_url', 2000)->nullable()->after('arquivo');
            }
            if (!Schema::hasColumn('videos', 'midias')) {
                $table->json('midias')->nullable()->after('arquivo');
            }
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (Schema::hasColumn('blogs', 'midias')) {
                $table->dropColumn('midias');
            }
        });

        Schema::table('videos', function (Blueprint $table) {
            if (Schema::hasColumn('videos', 'thumbnail_url')) {
                $table->dropColumn('thumbnail_url');
            }
            if (Schema::hasColumn('videos', 'midias')) {
                $table->dropColumn('midias');
            }
        });
    }
};