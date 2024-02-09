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
            $table->string('avg_mvp');
            $table->string('mvp_minute');
            $table->string('accuracy');
            $table->string('hit_diff');
            $table->string('win_rate');
            $table->string('commander_avg_mvp');
            $table->string('commander_accuracy');
            $table->string('commander_win_rate');
            $table->string('heavy_avg_mvp');
            $table->string('heavy_accuracy');
            $table->string('heavy_win_rate');
            $table->string('scout_avg_mvp');
            $table->string('scout_accuracy');
            $table->string('scout_win_rate');
            $table->string('ammo_avg_mvp');
            $table->string('ammo_accuracy');
            $table->string('ammo_win_rate');
            $table->string('medic_avg_mvp');
            $table->string('medic_accuracy');
            $table->string('medic_mvp');
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
