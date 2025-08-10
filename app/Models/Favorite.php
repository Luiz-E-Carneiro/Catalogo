<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Favorite extends Model
{
    /** @use HasFactory<\Database\Factories\FavoriteFactory> */
    use HasFactory;

    protected $fillable = [
        'movie_id', 
        'user_id'
    ];

    public function user(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }

    public function movie(): BelongsToMany{
        return $this->belongsToMany(Movie::class);
    }
}
