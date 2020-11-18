@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
          编辑会员
        </h2>
    </div>
    </div>
  </div>
  <div class="row row-deck row-cards">
    <div class="col-lg-12">
      <div class="card">
        <form class="form-edit-wed-member">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <div class="form-label">昵称：</div>
                        <input type="text" class="form-control" name="nick_name" value="{{$member['nick_name']}}">
                      </div>
                      @csrf
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <div class="form-label">真实姓名：</div>
                        <input type="text" class="form-control" name="name" value="{{$member['name']}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">出生年月日：</label>
                        <input type="date" class="form-control" name="birthday" value="{{$member['birthday']}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">年龄：</label>
                        <input type="number" class="form-control" name="age" value="{{$member['age']}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">体重：</label>
                        <input type="text" class="form-control" name="weight" value="{{$member['weight']}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">身高：</label>
                        <input type="text" class="form-control" name="height" value="{{$member['height']}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">性别：</label>
                        <select class="form-select" name="gender">
                          <option value="1" @if($member['gender'] == 1) selected @endif>男</option>
                          <option value="2" @if($member['gender'] == 2) selected @endif>女</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">实名认证：</label>
                        <select class="form-select" name="real_name">
                          <option value="0" @if($member['real_name'] == 0) selected @endif>未认证</option>
                          <option value="1" @if($member['real_name'] == 1) selected @endif>已认证</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">有车：</label>
                        <select class="form-select" name="car">
                          <option value="0" @if($member['car'] == 0) selected @endif>无</option>
                          <option value="1" @if($member['car'] == 1) selected @endif>有</option>
                          <option value="2" @if($member['car'] == 2) selected @endif>已认证</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">有房：</label>
                        <select class="form-select" name="house">
                          <option value="0" @if($member['house'] == 0) selected @endif>无</option>
                          <option value="1" @if($member['house'] == 1) selected @endif>有</option>
                          <option value="2" @if($member['house'] == 2) selected @endif>已认证</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">婚姻状况：</label>
                        <select class="form-select" name="marry">
                          <option value="1" @if($member['marry'] == 1) selected @endif>未婚</option>
                          <option value="2" @if($member['marry'] == 2) selected @endif>离异</option>
                          <option value="3" @if($member['marry'] == 3) selected @endif>丧偶</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">学历：</label>
                        <select class="form-select" name="education">
                          <option value="1" @if($member['education'] == 1) selected @endif>中专以下</option>
                          <option value="2" @if($member['education'] == 2) selected @endif>中专</option>
                          <option value="3" @if($member['education'] == 3) selected @endif>大专</option>
                          <option value="4" @if($member['education'] == 4) selected @endif>本科</option>
                          <option value="5" @if($member['education'] == 5) selected @endif>硕士</option>
                          <option value="6" @if($member['education'] == 6) selected @endif>博士</option>
                          <option value="7" @if($member['education'] == 7) selected @endif>博士后</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">收入：</label>
                        <select class="form-select" name="income">
                          <option value="2" @if($member['income'] == 2) selected @endif>2000以下</option>
                          <option value="4" @if($member['income'] == 4) selected @endif>2000-4000</option>
                          <option value="6" @if($member['income'] == 6) selected @endif>4000-6000</option>
                          <option value="10" @if($member['income'] == 10) selected @endif>6000-10000</option>
                          <option value="20" @if($member['income'] == 20) selected @endif>10000-20000</option>
                          <option value="21" @if($member['income'] == 21) selected @endif>20000以上</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">会员等级：</label>
                        <select class="form-select" name="vip_level">
                          <option value="1" @if($member['vip_level'] == 1) selected @endif>普通会员</option>
                          <option value="2" @if($member['vip_level'] == 2) selected @endif>vip</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">是否显示：</label>
                        <select class="form-select" name="show">
                          <option value="0" @if($member['show'] == 0) selected @endif>隐藏</option>
                          <option value="1" @if($member['show'] == 1) selected @endif>显示</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">工作：</label>
                        <input type="text" class="form-control" name="job" value="{{$member['job']}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">联系方式：</label>
                        <input type="text" class="form-control" name="phone" value="{{$member['phone']}}">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">备注：</label>
                      <input type="text" class="form-control" name="note" value="{{$member['note']}}">
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3 ml-3">
                  <div class="form-label">头像： <span></span></div>
                  <input type="hidden" class="form-control" name="avatar">
                    <img src="{{$member['avatar']}}" alt="" class="user-avatar">
                  <div class="position-relative fileupload-wrapper mt-3">
                    <button type="button" class="btn btn-primary btn-sm" style="width:90px;height:31px; z-index:0">
                      点击上传
                    </button>
                    <input id="avatar_upload" type="file" name="upload_file" class="position-absolute"
                      accept="image/jpeg,image/png" style="">
                  </div>
                </div>
                <div class="upload-images ml-3">
                  <label class="form-label">生活照片：</label>
                  <ul class="post-images-120 list-inline w-100">
                    @if ($member->images)
                    @foreach ($member->images as $image)
                    <li class="list-inline-item"><img src="{{$image}}">
                      <div><span>删除</span></div><input type="hidden" name="images[]" value="{{$image}}">
                    </li>
                    @endforeach
                    @endif
                  </ul>
                  <div class="position-relative fileupload-wrapper">
                    <button type="button" class="btn btn-primary btn-sm" style="width:90px;height:31px; z-index:0">
                      点击上传
                    </button>
                    <input id="fileupload" type="file" name="upload_file" class="position-absolute"
                      accept="image/jpeg,image/png" style="">
                    @csrf
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer text-muted">
            <button type="button" class="btn btn-primary btn-edit-wed-member">保存</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('extend_js')
<script type="text/javascript" src="/js/uploadfile.js"></script>
<script>
$(function(){
  $('.post-images-120').on('click', 'div span', function () {
    $(this).closest('li').remove()
    if ($('.post-images-120 li').length < 6) {
      $('.fileupload-wrapper').removeClass('hidden')
    }
  })

  $('#avatar_upload').fileupload({
    url : '/admin/image/upload',
    type: 'POST',
    dataType: 'json',
    formData: {_token: $('input[name=_token]').val(), action: 'avatar'},
    done: function (e, data) {
      if (! data.result.result) {
        toastr.error(data.result.message.upload_file)
      } else {
        var image = data.result.data
        $('.user-avatar').attr('src', image.url);
        $("input[name='avatar'").val(image.url);
      }
    }
  })
  
  $('#fileupload').fileupload({
    url : '/admin/image/upload',
    type: 'POST',
    dataType: 'json',
    formData: {_token: $('input[name=_token]').val(), action: 'wed'},
    done: function (e, data) {
      if (! data.result.result) {
        toastr.error(data.result.message.upload_file)
      } else {
        var image = data.result.data
        $('<li class="list-inline-item"><img src="'+ image.url+'"><div><span>删除</span></div><input type="hidden" name="images[]" value="'+image.url+'"></li>').appendTo('.post-images-120')
        if ($('.post-images-120 li').length == 6) {
          $('.fileupload-wrapper').addClass('hidden');
        }
      }
    }
  })
  $('.btn-edit-wed-member').click(function(event){
      $(event.currentTarget).prop('disabled', true)
      $.ajax({
          url: '/admin/wed/member/edit/{{$member['id']}}',
          type: 'post',
          data: $('.form-edit-wed-member').serialize(),
          success: function (res) {
              if (res.result) {
                  window.location.href = '/admin/wed/member'
              } else {
                  toastr.error(res.message)
                  $(event.currentTarget).prop('disabled', false)
              }
          }
      })
  })
})
</script>
@endsection