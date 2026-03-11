<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'codename',
        'zone',
        'user_id',
        'commander_mvp',
        'heavy_mvp',
        'scout_mvp',
        'ammo_mvp',
        'medic_mvp',
        'lfstats_id',
        'modifier'
        ];
    use HasFactory;
}
