<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LfstatsPlayerName extends Model
{
    use HasFactory;
    protected $connection = 'lfstats';
    protected $table = 'players';

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
