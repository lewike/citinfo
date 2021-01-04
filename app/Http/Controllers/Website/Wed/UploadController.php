<?php

namespace App\Http\Controllers\Website\Wed;

use Auth;
use App\Model\WedMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function save(Request $request)
    {
        $file = $request->file('upload-file');
        $md5 = md5_file($file->path());
        $filename = $md5.'.'.$file->guessExtension();

        $path = $file->storeAs('wed/img/'.date('ymd'), $filename, 'upload');

        $user = Auth::user();
        $wedMember = WedMember::where('user_id', $user->id)->first();

        $path = '/upload/'.$path;
        $images = $wedMember->images;
        $images[] = $path;
        $wedMember->images = $images;
        $wedMember->save();
        // File::create([
        //     'action' => 'wed',
        //     'type' => $file->getClientMimeType(),
        //     'path' => $path,
        //     'size' => $file->getSize(),
        //     'md5' => $md5,
        // ]);

        return ['result' => true, 'data' => ['url' => $path]];
    }
}
