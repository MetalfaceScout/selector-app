<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LfstatsPlayer extends Model
{
    use HasFactory;
    protected $connection = 'lfstats';
    protected $table = 'players';

    protected $fillable = ['player_name', 'id', 'newbie', 'last_center_name'];

    public function save(array $options = []) {
        throw new Exception('This is a read only model.');
    }

    public function delete() {
        throw new Exception('This is a read only model.');
    }

    public function update(array $attributes = [], array $options = []) {
        throw new Exception('This is a read only model.');
    }

}
