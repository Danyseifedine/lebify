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
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->integer('age');
            $table->string('school')->nullable();
            $table->string('future_expertise')->nullable();
            $table->string('education')->nullable();
            $table->string('university')->nullable();
            $table->string('occupation')->nullable();
            $table->json('interests')->nullable();
            $table->json('contact_preferences');
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('browser')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('device')->nullable();
            $table->string('platform')->nullable();
            $table->string('platform_version')->nullable();
            $table->boolean('is_mobile')->nullable();
            $table->boolean('is_tablet')->nullable();
            $table->boolean('is_desktop')->nullable();
            $table->string('language')->nullable();
            $table->string('screen_resolution')->nullable();
            $table->integer('color_depth')->nullable();
            $table->string('device_memory')->nullable();
            $table->string('time_zone')->nullable();
            $table->boolean('touch_support')->nullable();
            $table->string('connection_type')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
