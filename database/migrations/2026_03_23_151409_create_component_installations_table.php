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
        Schema::create('component_installations', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('project_id');

            $table->string('component_name');
            $table->string('component_version');
            $table->json('component_categories')->nullable();

            $table->timestamp('installed_at');
            $table->timestamp('completed_at')->nullable();
            $table->enum('status', ['pending', 'success', 'failed', 'cancelled'])->default('pending');

            $table->string('laravel_version');
            $table->string('php_version');
            $table->enum('package_manager', ['npm', 'yarn', 'pnpm', 'bun']);

            $table->json('composer_dependencies')->nullable();
            $table->json('npm_dependencies')->nullable();
            $table->boolean('requires_alpine')->default(false);

            $table->integer('files_count')->default(0);
            $table->json('files_installed')->nullable();

            $table->text('error_message')->nullable();
            $table->text('error_stack')->nullable();

            $table->unique(['project_id', 'component_name', 'component_version']);
            $table->index('project_id');
            $table->index('installed_at');
            $table->index('status');
            $table->index('component_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_installations');
    }
};
