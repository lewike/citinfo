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
        <form class="form-update-carpool-config">
          <input type="hidden" name="key" value="carpool">
          <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3 swiper-wraper">
                      <div class="form-label">轮播图1：</div>
                    <input type="hidden" class="form-control swiper-img" name="swipers[image][0]" value="{{$config['swipers']['image'][0] ?? ''}}">
                    <img src="{{$config['swipers']['image'][0] ?? ''}}" alt="" class="carpool-config-swiper">
                      <div class="position-relative fileupload-wrapper mt-3">
                          <button type="button" class="btn btn-primary btn-sm" style="width:90px;height:31px; z-index:0">
                          点击上传
                          </button>
                          <input type="file" name="upload_file" class="position-absolute upload-swiper"
                          accept="image/jpeg,image/png" style="">
                      </div>
                      <input type="text" class="form-control swiper-url mt-3" name="swipers[url][0]" value="{{$config['swipers']['url'][0] ?? ''}}" placeholder="链接地址1">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3 swiper-wraper">
                      <div class="form-label">轮播图2：</div>
                      <input type="hidden" class="form-control swiper-img" name="swipers[image][1]" value="{{$config['swipers']['image'][1] ?? ''}}">
                      <img src="{{$config['swipers']['image'][1] ?? ''}}" alt="" class="carpool-config-swiper">
                      <div class="position-relative fileupload-wrapper mt-3">
                          <button type="button" class="btn btn-primary btn-sm" style="width:90px;height:31px; z-index:0">
                          点击上传
                          </button>
                          <input type="file" name="upload_file" class="position-absolute upload-swiper"
                          accept="image/jpeg,image/png" style="">
                      </div>
                      <input type="text" class="form-control swiper-url mt-3" name="swipers[url][1]" value="{{$config['swipers']['url'][1] ?? ''}}" placeholder="链接地址2">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-3 swiper-wraper">
                      <div class="form-label">轮播图3：</div>
                      <input type="hidden" class="form-control swiper-img" name="swipers[image][2]" value="{{$config['swipers']['image'][2] ?? ''}}">
                      <img src="{{$config['swipers']['image'][2] ?? ''}}" alt="" class="carpool-config-swiper">
                      <div class="position-relative fileupload-wrapper mt-3">
                          <button type="button" class="btn btn-primary btn-sm" style="width:90px;height:31px; z-index:0">
                          点击上传
                          </button>
                          <input type="file" name="upload_file" class="position-absolute upload-swiper"
                          accept="image/jpeg,image/png" style="">
                      </div>
                      <input type="text" class="form-control swiper-url mt-3" name="swipers[url][2]" value="{{$config['swipers']['url'][2] ?? ''}}" placeholder="链接地址3">
                    </div>
                </div>
                @csrf
            </div>
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="">网站标题：</label>
                  <input type="text" class="form-control" name="website" value="{{$config['website'] ?? ''}}">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="">关注公众号二维码：</label>
                  <input type="text" class="form-control" name="follow" value="{{$config['follow'] ?? ''}}">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="">热门线路：</label>
                  <input type="text" class="form-control" name="hotways" value="{{$config['hotways'] ?? ''}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="">免费模式下最大发布数：</label>
                  <input type="text" class="form-control" name="max_free_publish_cnt" value="{{$config['max_free_publish_cnt'] ?? '3'}}">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="">置顶付费选项：</label>
                  <textarea name="sticky" class="form-control" cols="30" rows="10" >{{$config['sticky'] ?? ''}}</textarea>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="">充值赠送金额：</label>
                  <textarea name="recharge" class="form-control" cols="30" rows="10" >{{$config['recharge'] ?? ''}}</textarea>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="">微缘采集id：</label>
                  <input type="text" class="form-control" name="vyuanid" value="{{$config['vyuanid'] ?? ''}}">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="">最大采集数量：</label>
                  <input type="text" class="form-control" name="vyuan_max" value="{{$config['vyuan_max'] ?? ''}}">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="">采集关键字：</label>
                  <input type="text" class="form-control" name="vyuan_keyword" value="{{$config['vyuan_keyword'] ?? ''}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="">主页分享标题：</label>
                  <input type="text" class="form-control" name="share_title" value="{{$config['share_title'] ?? ''}}">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="">主页分享描述：</label>
                  <input type="text" class="form-control" name="share_desc" value="{{$config['share_desc'] ?? ''}}">
                </div>
              </div>
              <div class="col-lg-3">
                <div class="form-group">
                  <label for="">主页分享链接：</label>
                  <input type="text" class="form-control" name="share_link" value="{{$config['share_link'] ?? ''}}">
                </div>
              </div>
                <div class="col-lg-3">
                <div class="form-group">
                  <label for="">主页分享图片：</label>
                  <input type="text" class="form-control" name="share_image" value="{{$config['share_image'] ?? ''}}">
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer text-muted">
            <button type="button" class="btn btn-primary btn-update-carpool-config">保存配置</button>
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
  
  $('.btn-update-carpool-config').click(function(event){
      $(event.currentTarget).prop('disabled', true)
      $.ajax({
          url: '/admin/pinche/config',
          type: 'post',
          data: $('.form-update-carpool-config').serialize(),
          success: function (res) {
              if (res.result) {
                  window.location.href = '/admin/pinche/config'
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