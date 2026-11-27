<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            if (!Schema::hasColumn('videos', 'youtube_url')) {
                $table->text('youtube_url')->nullable()->after('arquivo');
            }
            if (!Schema::hasColumn('videos', 'thumbnail_url')) {
                $table->text('thumbnail_url')->nullable()->after('youtube_url');
            }
            if (!Schema::hasColumn('videos', 'midias')) {
                $table->json('midias')->nullable()->after('thumbnail_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            if (Schema::hasColumn('videos', 'midias')) {
                $table->dropColumn('midias');
            }
            if (Schema::hasColumn('videos', 'thumbnail_url')) {
                $table->dropColumn('thumbnail_url');
            }
            if (Schema::hasColumn('videos', 'youtube_url')) {
                $table->dropColumn('youtube_url');
            }
        });
    }
};