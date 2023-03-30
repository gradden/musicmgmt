<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Concert extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
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
}
