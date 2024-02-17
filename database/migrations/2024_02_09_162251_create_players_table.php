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
            $table->unsignedFloat('avg_mvp');
            $table->unsignedFloat('mvp_minute');
            $table->unsignedFloat('accuracy');
            $table->unsignedFloat('hit_diff');
            $table->unsignedFloat('win_rate');
            $table->unsignedFloat('commander_avg_mvp');
            $table->unsignedFloat('commander_accuracy');
            $table->unsignedFloat('commander_win_rate');
            $table->unsignedFloat('heavy_avg_mvp');
            $table->unsignedFloat('heavy_accuracy');
            $table->unsignedFloat('heavy_win_rate');
            $table->unsignedFloat('scout_avg_mvp');
            $table->unsignedFloat('scout_accuracy');
            $table->unsignedFloat('scout_win_rate');
            $table->unsignedFloat('ammo_avg_mvp');
            $table->unsignedFloat('ammo_accuracy');
            $table->unsignedFloat('ammo_win_rate');
            $table->unsignedFloat('medic_avg_mvp');
            $table->unsignedFloat('medic_accuracy');
            $table->unsignedFloat('medic_mvp');
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
