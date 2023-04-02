<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Concert extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public const UPCOMING_EVENTS = 'upcoming';
    public const PAST_EVENTS = 'past';

    protected $fillable = [
        'event_name',
        'club_id',
        'added_by_user_id',
        'description',
        'event_start_date',
        'event_end_date',
        'income',
        'facebook_event_url',
        'liveset_url',
        'is_expired'
    ];

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'club_id', 'id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'added_by_user_id', 'id');
    }
}
