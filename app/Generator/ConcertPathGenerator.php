<?php

namespace App\Generator;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator as BasePathGenerator;

class ConcertPathGenerator implements BasePathGenerator {
    /*
     * Get the path for the given media, relative to the root storage path.
     */
    public function getPath(Media $media): string {
        return 'concerts/' . $media->model_id . '/';
    }

    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media): string {
        return '';
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    public function getPathForResponsiveImages(Media $media): string {
        return '';
    }
}