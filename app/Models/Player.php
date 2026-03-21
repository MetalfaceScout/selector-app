<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function getMVPFromIndex($index) {
        switch ($index) {
            case 0:
                return $this->commander_mvp;
            case 1:
                return $this->heavy_mvp;
            case 2:
            case 3:
                return $this->scout_mvp;
            case 4:
                return $this->ammo_mvp;
            case 5:
                return $this->medic_mvp;
            default:
                return null;
        }
    }

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
