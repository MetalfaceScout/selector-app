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
            
            $table->string('codename');

            $table->string('zone')->default('player-pool');

            $table->integer('slot')->default(-1);

            $table->integer('user_id')->default(0);

            $table->float('commander_mvp')->default(4);

            $table->float('heavy_mvp')->default(4);

            $table->float('scout_mvp')->default(4);

            $table->float('ammo_mvp')->default(4);

            $table->float('medic_mvp')->default(4); 
        
            $table->integer('lfstats_id')->default(-1);
            
            $table->timestamps();
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
