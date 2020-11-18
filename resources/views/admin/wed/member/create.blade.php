@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
          添加会员
        </h2>
    </div>
    </div>
  </div>
  <div class="row row-deck row-cards">
    <div class="col-lg-12">
      <div class="card">
        <form class="form-create-wed-member">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <div class="form-label">昵称：</div>
                        <input type="text" class="form-control" name="nick_name">
                      </div>
                      @csrf
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <div class="form-label">真实姓名：</div>
                        <input type="text" class="form-control" name="name">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">出生年月日：</label>
                        <input type="date" class="form-control" name="birthday">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">年龄：</label>
                        <input type="number" class="form-control" name="age">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">体重：</label>
                        <input type="text" class="form-control" name="weight">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">身高：</label>
                        <input type="text" class="form-control" name="height">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">性别：</label>
                        <select class="form-select" name="gender"">
                          <option value="1">男</option>
                          <option value="2">女</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">实名认证：</label>
                        <select class="form-select" name="real_name">
                          <option value="0">未认证</option>
                          <option value="1">已认证</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">有车：</label>
                        <select class="form-select" name="car">
                          <option value="0">无</option>
                          <option value="1">有</option>
                          <option value="2">已认证</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">有房：</label>
                        <select class="form-select" name="house">
                          <option value="0">无</option>
                          <option value="1">有</option>
                          <option value="2">已认证</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">婚姻状况：</label>
                        <select class="form-select" name="marry">
                          <option value="1">未婚</option>
                          <option value="2">离异</option>
                          <option value="3">丧偶</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">学历：</label>
                        <select class="form-select" name="education">
                          <option value="1">中专以下</option>
                          <option value="2">中专</option>
                          <option value="3">大专</option>
                          <option value="4">本科</option>
                          <option value="5">硕士</option>
                          <option value="6">博士</option>
                          <option value="7">博士后</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">收入：</label>
                        <select class="form-select" name="income">
                          <option value="2">2000以下</option>
                          <option value="4">2000-4000</option>
                          <option value="6">4000-6000</option>
                          <option value="10">6000-10000</option>
                          <option value="20">10000-20000</option>
                          <option value="21">20000以上</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">会员等级：</label>
                        <select class="form-select" name="vip_level">
                          <option value="1">普通会员</option>
                          <option value="2">vip</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">是否显示：</label>
                        <select class="form-select" name="show">
                          <option value="0">隐藏</option>
                          <option value="1">显示</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">工作：</label>
                        <input type="text" class="form-control" name="job">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">联系方式：</label>
                        <input type="text" class="form-control" name="phone">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="mb-3">
                        <label class="form-label">备注：</label>
                        <input type="text" class="form-control" name="note">
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3 ml-3">
                  <div class="form-label">头像： <span></span></div>
                  <input type="hidden" class="form-control" name="avatar">
                  <img src="/images/wed_default_avatar.png" alt="" class="user-avatar">
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
            <button type="button" class="btn btn-primary btn-create-wed-member">添加</button>
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
  $('.btn-create-wed-member').click(function(event){
      $(event.currentTarget).prop('disabled', true)
      $.ajax({
          url: '/admin/wed/member/create',
          type: 'post',
          data: $('.form-create-wed-member').serialize(),
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