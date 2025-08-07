<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Movie extends Model
{
    /** @use HasFactory<\Database\Factories\MovieFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'synopsis',
        'year',
        'image',
        'link',
        'category_id'
    ];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
