<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'upload_file' => 'required|image|mimes:jpeg,jpg,png|max:50120',
            'action' => 'required|in:post,avatar,wed',
        ];
    }

    public function messages()
    {
        return [
            'upload_file.mimes' => '请确认上传图片类型是否为jpg、png',
            'upload_file.max' => '上传图片尺寸大了一些，可以尝试缩小尺寸后重试！'
        ];
    }
}
