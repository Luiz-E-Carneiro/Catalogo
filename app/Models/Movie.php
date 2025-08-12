<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        "title",
        "synopsis",
        "publisher",
        "year",
        "rating",
        "link",
        "cover",
        "banner",
        "category_id",
        //favorite
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
    public function favorited():  BelongsToMany{
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
    public function wish_list(): HasMany {
        return $this->hasMany(Favorite::class);
    }
    public function is_wished() {
        $movie = false;
        if (Auth::check()) {
            $movie = Favorite::where("movie_id", $this->id)->where("user_id", Auth::user()->id)->exists();
        }
        return Auth::check() && $movie;
    }
}
