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
        Schema::create('weapons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('name', 50);
            $table->text('description')->nullable();
            $table->tinyInteger('type');
            $table->integer('version')->default(1);
            $table->softDeletes();
        });

        Schema::create('weapon_profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('name', 50);
            $table->text('range');
            $table->char('attacks', 10);
            $table->char('skills', 10);
            $table->char('strength', 10);
            $table->char('penetration', 10);
            $table->char('damage', 10);
            $table->integer('version')->default(1);
            $table->unsignedBigInteger('weapon_id');
            $table->foreign('weapon_id')
                ->references('id')->on('weapons')
                ->onDelete('cascade');
            $table->softDeletes();
        });

        Schema::create('keyword_weapon_profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keyword_id');
            $table->unsignedBigInteger('weapon_profile_id');
            $table->foreign('keyword_id')->references('id')->on('keywords');
            $table->foreign('weapon_profile_id')->references('id')->on('weapon_profiles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keyword_weapon_profile');
        Schema::dropIfExists('weapon_profiles');
        Schema::dropIfExists('weapons');
    }
};
