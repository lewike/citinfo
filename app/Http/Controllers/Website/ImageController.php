<?php

namespace App\Http\Controllers\Website;

use App\Model\File;
use App\Http\Requests\UploadRequest;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function upload(UploadRequest $request)
    {
        $validated = $request->validated();

        $file = $validated['upload_file'];
        $md5 = md5_file($file->path());
        $filename = $md5.'.'.$file->guessExtension();

        $action = $validated['action'];
        $path = $file->storeAs($action.'/img/'.date('ymd'), $filename, 'upload');
        
        $path = '/upload/'.$path;
        File::create([
            'action' => $action,
            'type' => $file->getClientMimeType(),
            'path' => $path,
            'size' => $file->getSize(),
            'md5' => $md5,
        ]);

        return ['result' => true, 'data' => ['url' => $path, 'origin_url' => $path]];
    }
}
