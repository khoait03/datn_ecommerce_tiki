<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewMedia extends Model
{
    protected $table = 'review_media';
    use HasFactory;

    protected $fillable = [
        'review_id',
        'review_media',
    ];

    public function review(): BelongsTo
    {
        return $this->BelongsTo(Review::class);
    }
}
