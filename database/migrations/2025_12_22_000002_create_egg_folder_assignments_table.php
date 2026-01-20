<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('enhanced_server_egg_folder_assignments')) {
            Schema::create('enhanced_server_egg_folder_assignments', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('egg_id');
                $table->unsignedInteger('user_id');
                $table->unsignedBigInteger('folder_id');
                $table->timestamps();

                $table->foreign('egg_id')->references('id')->on('eggs')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('folder_id')->references('id')->on('enhanced_server_folders')->onDelete('cascade');
                
                $table->unique(['egg_id', 'user_id', 'folder_id'], 'egg_user_folder_unique');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('enhanced_server_egg_folder_assignments');
    }
};