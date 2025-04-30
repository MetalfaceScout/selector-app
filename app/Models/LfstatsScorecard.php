<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;


class LfstatsScorecard extends Model
{
    use HasFactory;
    protected $connection = 'lfstats';
    protected $table = 'scorecards';

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
