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
        Schema::create('ranged_weapons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('name', 50);
            $table->text('description')->nullable();
            $table->text('range');
            $table->char('A', 10);
            $table->char('BS', 10);
            $table->char('S', 10);
            $table->char('AP', 10);
            $table->char('D', 10);
            $table->integer('version')->default(1);
            $table->softDeletes();
        });

        Schema::create('keyword_ranged_weapon', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keyword_id');
            $table->unsignedBigInteger('ranged_weapon_id');
            $table->foreign('keyword_id')->references('id')->on('keywords');
            $table->foreign('ranged_weapon_id')->references('id')->on('ranged_weapons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keyword_ranged_weapon');
        Schema::dropIfExists('ranged_weapons');
    }
};
