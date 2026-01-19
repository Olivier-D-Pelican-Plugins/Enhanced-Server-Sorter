<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
            Schema::create('enhanced_server_egg_folder_assignments', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('egg_id');
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('folder_id');
                $table->timestamps();

                $table->foreign('egg_id')->references('id')->on('eggs')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('folder_id')->references('id')->on('enhanced_server_folders')->onDelete('cascade');
                
                $table->unique(['egg_id', 'user_id', 'folder_id']);
            });

    }

    public function down(): void
    {
        Schema::drop('enhanced_server_egg_folder_assignments');
    }
};
