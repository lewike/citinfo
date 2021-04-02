@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="page-header">
    <div class="row align-items-center">
      <div class="col-auto">
        <h2 class="page-title">
          添加分类信息
        </h2>
      </div>
    </div>
  </div>
  <div class="row row-deck row-cards">
    <div class="col-lg-12">
      <div class="card">
        <form class="form-create-post">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-2">
                <div class="mb-3">
                  <div class="form-label">分类：</div>
                  <select class="form-select" name="category_path">
                    @foreach ($categories as $category)
                    @if ($category['p_id'])
                    <option value="{{$category['path']}}">- {{$category['name']}}</option>
                    @else
                    <option disabled>{{$category['name']}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-10">
                <div class="mb-3">
                  <label class="form-label">标题：</label>
                  <input type="text" class="form-control" name="title" placeholder="请输入标题">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">内容：</label>
              <textarea class="form-control" name="content" rows="6" placeholder="请输入内容"
                style="margin-top: 0px; margin-bottom: 0px; height: 155px;"></textarea>
            </div>
            <div class="row upload-images">
              <div class="col-lg-12">
                <label class="form-label">图片：</label>
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
            <div class="row">
              <div class="col-lg-3">
                <div class="mb-3">
                  <label class="form-label">联系方式：</label>
                  <input type="text" class="form-control" name="phone" placeholder="请输入电话">
                  <span id="phone-info"></span>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="mb-3">
                  <div class="form-label">有效时间：</div>
                  <select class="form-select" name="expired_day">
                    <option value="7">一周</option>
                    <option value="15">半个月</option>
                    <option value="30">一个月</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer text-muted">
            <button type="button" class="btn btn-primary btn-create-post">添加</button>
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
  });
  $('input[name=phone]').on('blur', function(event){
    var phone = event.currentTarget.value;
    if (/^\d{11}$/.test(phone)) {
      $('#phone-info').text('查询中...');
      axios.get('/admin/post/phone-info/'+phone)
      .then(function (response) {
        if (response.data.result) {
          $('#phone-info').text(response.data.info);
        }
      });
    }
  });
  
  $('#fileupload').fileupload({
    url : '/admin/image/upload',
    type: 'POST',
    dataType: 'json',
    formData: {_token: $('input[name=_token]').val(), action: 'post'},
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
    $('.btn-create-post').click(function(event){
      $(event.currentTarget).prop('disabled', true)
      axios.post('/admin/post/create', $('.form-create-post').serialize())
      .then(function(response){
        var res = response.data;
        if (res.result) {
          window.location.href = '/admin/post'
        } else {
          toastr.error(res.message)
          $(event.currentTarget).prop('disabled', false)
        }
      })
    })
})
</script>
@endsection