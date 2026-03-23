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
        Schema::create('component_version_caches', function (Blueprint $table) {
            $table->id();
            $table->string('component_name');
            $table->string('version');
            $table->json('metadata');
            $table->timestamp('last_synced_at')->default(now());

            $table->unique(['component_name', 'version']);
            $table->index('component_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_version_caches');
    }
};
