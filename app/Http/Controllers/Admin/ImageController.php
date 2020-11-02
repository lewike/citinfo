<?php

namespace App\Http\Controllers\Admin;

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
        $path = $file->storeAs('post_images/'.date('ymd'), $filename, 'upload');
        
        $path = '/upload/'.$path;
        File::create([
            'action' => 'post_images',
            'type' => $file->getClientMimeType(),
            'path' => $path,
            'size' => $file->getSize(),
            'md5' => $md5,
        ]);

        return ['result' => true, 'data' => ['url' => $path, 'origin_url' => $path]];
    }
}
