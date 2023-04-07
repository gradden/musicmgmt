<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FileService
{
    public function getImage(string $classType, string $uuid)
    {
        $file = DB::table('media')->where('uuid', $uuid)->first();
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

        $response = response()->make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}