<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['studio_id', 'name', 'cover_image', 'release_date', 'genre', 'pegi', 'platform'];

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}