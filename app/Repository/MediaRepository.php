<?php

namespace App\Repository;

use App\Models\Concert;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaRepository
{
    public function searchWithConcerts(string $input)
    {
        return Media::leftJoin('concerts', 'model_id', '=', 'concerts.id')
            ->where('model_type', '=', (string)Concert::class)
            ->where(function ($query) use ($input) {
                $query->where('concerts.event_name', 'LIKE', '%' . $input . '%')
                    ->orWhere('concerts.description', 'LIKE', '%' . $input . '%')
                    ->orWhere('file_name', 'LIKE', '%' . $input . '%');
            })
            ->orderBy('concerts.event_start_date', 'DESC')
            ->get();
    }
}