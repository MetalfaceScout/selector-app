<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //This needs to be a collection of players each assigned to a slot

    protected $guarded = ['id'];

    use HasFactory;
}
