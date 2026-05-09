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
        Schema::create('wargears', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('name', 50);
            $table->text('description');
            $table->integer('version')->default(1);
            $table->boolean('is_deleted')->default(false);
        });

        Schema::create('ability_wargear', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wargear_id');
            $table->unsignedBigInteger('ability_id');
            $table->foreign('wargear_id')->references('id')->on('wargears');
            $table->foreign('ability_id')->references('id')->on('abilities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ability_wargear');
        Schema::dropIfExists('wargears');
    }
};
