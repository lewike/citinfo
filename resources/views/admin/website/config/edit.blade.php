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
        <form class="form-update-website-config">
          <input type="hidden" name="key" value="website">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 mb-2">
                <div class="form-group">
                  <label for="">网站名：</label>
                  <input type="text" class="form-control" name="website" value="{{$config['website'] ?? ''}}">
                </div>
              </div>
              <div class="col-lg-6 mb-2">
                <div class="form-group">
                  <label for="">首页SEO标题：</label>
                  <input type="text" class="form-control" name="index_seo_title" value="{{$config['index_seo_title'] ?? ''}}">
                </div>
              </div>
              <div class="col-lg-6 mb-2">
                <div class="form-group">
                  <label for="">首页SEO描述：</label>
                  <textarea class="form-control" name="index_seo_desc" id="" rows="3">{{$config['index_seo_desc'] ?? ''}}</textarea>
                </div>
              </div>
              <div class="col-lg-6 mb-2">
                <div class="form-group">
                  <label for="">首页SEO关键字：</label>
                  <textarea class="form-control" name="index_seo_keywords" rows="3">{{$config['index_seo_keywords'] ?? ''}}</textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 mb-2">
                <div class="form-group">
                  <label for="">统计代码：</label>
                    <textarea class="form-control" name="tongji"rows="3">{{$config['tongji'] ?? ''}}</textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer text-muted">
            <button type="button" class="btn btn-primary btn-update-website-config">保存配置</button>
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
  
  $('.btn-update-website-config').click(function(event){
      $(event.currentTarget).prop('disabled', true);
      axios.post('/admin/website/config', $('.form-update-website-config').serialize())
      .then(function (response) {
        if (response.data.result)
        {
          window.location.href = '/admin/website/config';
        } else {
          toastr.error(response.data.message);
          $(event.currentTarget).prop('disabled', false);
        }
      })
      .catch(function (error) {
        toastr.error(error);
        $(event.currentTarget).prop('disabled', false);
      })
      
  })
})
</script>
@endsection