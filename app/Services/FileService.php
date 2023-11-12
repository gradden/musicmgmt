<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileService
{
    public function getImage(string $classType, string $uuid)
    {
        $file = Media::query()->where('uuid', $uuid)->first();
        if ($file == null)
        {
            throw new NotFoundHttpException();
        }
        
        $path = storage_path('/app/' . $file->disk . '/' . $classType . '/' . $file->model_id . '/' . $file->file_name);

        if (!File::exists($path)) 
        {
            throw new NotFoundHttpException();
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = response()->make($file, Response::HTTP_OK);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function deletePreviousIfExists(string $type): void
    {
        $file = DB::table('media')
            ->where('model_type', User::class)
            ->where('model_id', auth()->id())
            ->whereJsonContains('custom_properties', [$type => true])
            ->first();

        if ($file)
        {
            DB::table('media')
                ->where('model_type', User::class)
                ->where('model_id', auth()->id())
                ->whereJsonContains('custom_properties', [$type => true])->delete();
            File::delete(storage_path('/app/' . $file->disk . '/user_profile_pic/' . $file->model_id . '/' . $file->file_name));
        }
    }
}