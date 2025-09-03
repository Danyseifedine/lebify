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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('developer_name');
            $table->text('description');
            $table->string('url');
            $table->string('icon')->nullable();
            $table->text('features');
            $table->integer('visitor_count')->default(0);
            $table->enum('visibility', ['public', 'private'])->default('public');
            $table->enum('status', ['working_on_it', 'available'])->default('working_on_it');
            $table->json('codes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
