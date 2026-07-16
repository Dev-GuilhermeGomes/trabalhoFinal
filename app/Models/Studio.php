<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    protected $fillable = ['name', 'logo'];

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}