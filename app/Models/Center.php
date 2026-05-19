<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;

    public $fillable = [
        'center_id',
        'short_name',
        'pretty_name'
    ];
}
