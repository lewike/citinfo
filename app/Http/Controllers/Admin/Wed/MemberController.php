<?php

namespace App\Http\Controllers\Admin\Wed;

use Validator;
use App\Model\WedMember;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $data['members'] = WedMember::paginate(30);
        return view('admin.wed.member.index', $data);
    }

    public function create()
    {
        return view('admin.wed.member.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nick_name' => 'required',
            'avatar' => 'required',
            'birthday' => 'required',
            'gender' => 'required',
            'marry' => 'required',
        ], [
            'nick_name.required' => '昵称不能为空',
            'avatar.required' => '头像不能为空',
            'birthday.required' => '生日不能为空',
            'gender.required' => '性别不能为空',
            'marry.required' => '婚姻状况不能为空'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return ['result' => false, 'message' => join('、', $errors->all())];
        }

        $data = $request->only(['nick_name', 'avatar', 'birthday', 'gender', 'marry', 'name', 'real_name', 'car', 'house', 'weight', 'height', 'age', 'email', 'phone', 'images', 'job', 'income', 'education', 'note', 'show', 'vip_level']);
        WedMember::create($data);
        return ['result' => true];
    }
    
    public function edit(WedMember $wedMember)
    {
        $data['member'] = $wedMember;
        return view('admin.wed.member.edit', $data);
    }
}
