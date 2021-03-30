@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
          参数配置
        </h2>
    </div>
    </div>
  </div>
  <div class="row row-deck row-cards">
    <div class="col-lg-12">
      <div class="card">
        <form class="form-update-config">
          <input type="hidden" name="key" value="website.ad">
          <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3 swiper-wraper">
                      <div class="form-label">广告1：</div>
                    <input type="hidden" class="form-control swiper-img" name="ad[0][image]" value="{{$config['ad'][0]['image'] ?? ''}}">
                    <img src="{{$config['ad'][0]['image'] ?? ''}}" alt="" class="carpool-config-swiper">
                      <div class="position-relative fileupload-wrapper mt-3">
                          <button type="button" class="btn btn-primary btn-sm" style="width:90px;height:31px; z-index:0">
                          点击上传
                          </button>
                          <input type="file" name="upload_file" class="position-absolute upload-swiper"
                          accept="image/jpeg,image/png" style="">
                      </div>
                      <input type="text" class="form-control swiper-url mt-3" name="ad[0][url]" value="{{$config['ad'][0]['url'] ?? ''}}" placeholder="链接地址1">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3 swiper-wraper">
                      <div class="form-label">广告2：</div>
                      <input type="hidden" class="form-control swiper-img" name="ad[1][image]" value="{{$config['ad'][1]['image'] ?? ''}}">
                      <img src="{{$config['ad'][1]['image'] ?? ''}}" alt="" class="carpool-config-swiper">
                      <div class="position-relative fileupload-wrapper mt-3">
                          <button type="button" class="btn btn-primary btn-sm" style="width:90px;height:31px; z-index:0">
                          点击上传
                          </button>
                          <input type="file" name="upload_file" class="position-absolute upload-swiper"
                          accept="image/jpeg,image/png" style="">
                      </div>
                      <input type="text" class="form-control swiper-url mt-3" name="ad[1][url]" value="{{$config['ad'][1]['url'] ?? ''}}" placeholder="链接地址2">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3 swiper-wraper">
                      <div class="form-label">广告3：</div>
                      <input type="hidden" class="form-control swiper-img" name="ad[2][image]" value="{{$config['ad'][2]['image'] ?? ''}}">
                      <img src="{{$config['ad'][2]['image'] ?? ''}}" alt="" class="carpool-config-swiper">
                      <div class="position-relative fileupload-wrapper mt-3">
                          <button type="button" class="btn btn-primary btn-sm" style="width:90px;height:31px; z-index:0">
                          点击上传
                          </button>
                          <input type="file" name="upload_file" class="position-absolute upload-swiper"
                          accept="image/jpeg,image/png" style="">
                      </div>
                      <input type="text" class="form-control swiper-url mt-3" name="ad[2][url]" value="{{$config['ad'][2]['url'] ?? ''}}" placeholder="链接地址3">
                    </div>
                </div>
                @csrf
            </div>
          </div>
          <div class="card-footer text-muted">
            <button type="button" class="btn btn-primary btn-update-config">保存配置</button>
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
        parent.find('.carpool-config-swiper').attr('src', image.url);
        parent.find('.swiper-img').val(image.url);
      }
    }
  })
  
  $('.btn-update-config').click(function(event){
      $(event.currentTarget).prop('disabled', true)
      $.ajax({
          url: '/admin/website/ad',
          type: 'post',
          data: $('.form-update-config').serialize(),
          success: function (res) {
              if (res.result) {
                  window.location.href = '/admin/website/ad'
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