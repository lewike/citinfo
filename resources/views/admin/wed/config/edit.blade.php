@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
          参数配置        <span class="text-h4">返回</span>
        </h2>
    </div>
    </div>
  </div>
  <div class="row row-deck row-cards">
    <div class="col-lg-12">
      <div class="card">
        <form class="form-update-wed-config">
          <input type="hidden" name="key" value="wed.swiper">
          <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3 swiper-wraper">
                      <div class="form-label">轮播图1：</div>
                    <input type="hidden" class="form-control swiper-img" name="image[0]" value="{{$swipers['image'][0] ?? ''}}">
                    <img src="{{$swipers['image'][0] ?? ''}}" alt="" class="wed-config-swiper">
                      <div class="position-relative fileupload-wrapper mt-3">
                          <button type="button" class="btn btn-primary btn-sm" style="width:90px;height:31px; z-index:0">
                          点击上传
                          </button>
                          <input type="file" name="upload_file" class="position-absolute upload-swiper"
                          accept="image/jpeg,image/png" style="">
                      </div>
                      <input type="text" class="form-control swiper-url mt-3" name="url[0]" value="{{$swipers['url'][0] ?? ''}}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3 swiper-wraper">
                      <div class="form-label">轮播图2：</div>
                      <input type="hidden" class="form-control swiper-img" name="image[1]" value="{{$swipers['image'][1] ?? ''}}">
                      <img src="{{$swipers['image'][1] ?? ''}}" alt="" class="wed-config-swiper">
                      <div class="position-relative fileupload-wrapper mt-3">
                          <button type="button" class="btn btn-primary btn-sm" style="width:90px;height:31px; z-index:0">
                          点击上传
                          </button>
                          <input type="file" name="upload_file" class="position-absolute upload-swiper"
                          accept="image/jpeg,image/png" style="">
                      </div>
                      <input type="text" class="form-control swiper-url mt-3" name="url[1]" value="{{$swipers['url'][1] ?? ''}}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3 swiper-wraper">
                      <div class="form-label">轮播图3：</div>
                      <input type="hidden" class="form-control swiper-img" name="image[2]" value="{{$swipers['image'][2] ?? ''}}">
                      <img src="{{$swipers['image'][2] ?? ''}}" alt="" class="wed-config-swiper">
                      <div class="position-relative fileupload-wrapper mt-3">
                          <button type="button" class="btn btn-primary btn-sm" style="width:90px;height:31px; z-index:0">
                          点击上传
                          </button>
                          <input type="file" name="upload_file" class="position-absolute upload-swiper"
                          accept="image/jpeg,image/png" style="">
                      </div>
                      <input type="text" class="form-control swiper-url mt-3" name="url[2]" value="{{$swipers['url'][2] ?? ''}}">
                    </div>
                </div>
                @csrf
            </div>
          </div>
          <div class="card-footer text-muted">
            <button type="button" class="btn btn-primary btn-update-wed-config">保存配置</button>
            <button type="button" class="btn btn-link">返回</button>
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
  $('.upload-swiper').fileupload({
    url : '/admin/image/upload',
    type: 'POST',
    dataType: 'json',
    formData: {_token: $('input[name=_token]').val(), action: 'swiper'},
    done: function (e, data) {
      if (! data.result.result) {
        toastr.error(data.result.message.upload_file)
      } else {
        var image = data.result.data
        var parent = $(e.target).parents('.swiper-wraper');
        parent.find('.wed-config-swiper').attr('src', image.url);
        parent.find('.swiper-img').val(image.url);
      }
    }
  })
  
  $('.btn-update-wed-config').click(function(event){
      $(event.currentTarget).prop('disabled', true)
      $.ajax({
          url: '/admin/wed/config',
          type: 'post',
          data: $('.form-update-wed-config').serialize(),
          success: function (res) {
              if (res.result) {
                  window.location.href = '/admin/wed/config'
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