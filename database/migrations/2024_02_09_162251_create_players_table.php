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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codename');
            $table->string('link')->nullable();
            $table->unsignedFloat('avg_mvp');
            $table->unsignedFloat('mvp_per_minute');
            $table->unsignedFloat('avg_avg_acc');
            $table->unsignedFloat('games_won');
            $table->unsignedFloat('games_played');
            $table->unsignedFloat('hit_diff');
            $table->unsignedFloat('commander_avg_mvp');
            $table->unsignedFloat('commander_avg_acc');
            $table->unsignedFloat('heavy_avg_mvp');
            $table->unsignedFloat('heavy_avg_acc');
            $table->unsignedFloat('scout_avg_mvp');
            $table->unsignedFloat('scout_avg_acc');
            $table->unsignedFloat('ammo_avg_mvp');
            $table->unsignedFloat('ammo_avg_acc');
            $table->unsignedFloat('medic_avg_mvp');
            $table->unsignedFloat('medic_avg_acc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
