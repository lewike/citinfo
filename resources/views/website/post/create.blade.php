@extends('layouts.website')

@section('content')
<nav class="breadcrumb">
  <a class="breadcrumb-item" href="/">首页</a>
  <a class="breadcrumb-item" href="/post">免费发布信息</a>
</nav>
<div class="content row">
  <div class="col-12 text-center pt-4"><h5>免费发布信息</h5></div>
  <div class="col-12 px-5 py-3">
      <div class="mx-2 px-4 py-3 border text-md text-danger bg-light">
        <span class="font-weight-bold">发布须知：</span><br>
        <span>一、网站采用信息审核制，信息需经审核且通过后才会显示，发布信息请遵守相关法律法规</span><br>
        <span>二、互联网违禁及其它有风险的信息不予审核，包括：出国劳务、移民、医疗药品、发票、贷款、信用卡、股票基金、现货期货、刷淘宝信誉等</span><br>
        <span>三、为保证良性秩序：①每用户每日限发1条信息 ②3日内禁止发布重复信息 ③禁止同一单位或个人用多个号码发布重复信息</span>
      </div>
  </div>
  <form class="form-create-post">
  <div class="col mx-3 p-3 ">
    <h6>第一步：请选择信息栏目</h6>
    <div class="row px-4 py-2 text-md post-select-category">
      @foreach ($categories as $category)
        <div class="col-auto">{{$category['data']->name}}</div>
        <div class="col">
        @foreach ($category['child'] as $subcategory)
        <a href="#" data-path="{{$subcategory->path}}">{{$subcategory->name}}</a>
        @endforeach
        </div>
        <div class="w-100"></div>
      @endforeach
    </div>
    <div class="post-category-selected d-none p-3">栏目：<span class="text-danger px-2"></span> <a href="#" class="btn btn-info btn-sm post-category-reselect">重新选择栏目</a></div>
    <input type="hidden" name="category_path" id="category-path">
    @csrf
  </div>
  <div class="col mx-3 p-3">
    <h6>第二步：填写详情</h6>
    <div class="p-3">
    <div class="form-inline row py-2 align-items-start">
      <label class="col-auto col-form-label">内容：&#12288;&#12288;</label>
      <textarea name="content" class="form-control" cols="80" rows="5" placeholder="在这里输入你要发布的内容，请勿在这里留联系方式，如发布招聘请注明单位名和职位名，如发布房产请注明位置、楼层和面积，请客观、真实准确描述，遵守相关法律法规！"></textarea>
    </div>
    <div class="form-inline row py-2">
      <label class="col-auto col-form-label">图片：&#12288;&#12288;</label>
      <div>
        <ul class="post-images-120 list-inline w-100">
        </ul>
          <div class="position-relative fileupload-wrapper">
            <button type="button" class="btn btn-primary btn-sm" style="width:90px;height:31px; z-index:0">
              点击上传
            </button> 
            <input id="fileupload" type="file" name="upload_file" class="position-absolute" accept="image/jpeg,image/png" style="">
            @csrf
          </div>
      </div>
    </div>
    <div class="form-inline row py-2">
      <label class="col-auto col-form-label">有效期：&#12288;</label>
        <select class="form-control form-control-sm" name="expired_day">
          <option value="3" selected>3 天</option>
          <option value="7">7 天</option>
          <option value="15">15 天</option>
          <option value="30">30 天</option>
        </select>
      <small class="text-muted ml-3">信息超过该时间自动过期</small>
    </div>
    <div class="form-inline row py-2">
        <label class="col-auto col-form-label">联系电话：</label>
        <input type="text" class="form-control form-control-sm" name="phone">
        <small class="text-muted ml-3">请正确填写手机号，便于联系</small>
    </div>
    </div>
  </div>
  <div class="col">
    <span class="d-block mx-5 px-4 py-3 border text-md text-danger bg-light">请认真阅读本页上方“发布须知”，以及【网站声明】、【使用帮助】文档内容。点击“↙现在发布”即代表你已阅读并同意我们的服务条款</span>
  </div>
  <div class="col text-center pt-3">
    <button type="button" class="btn btn-success btn-post">已经填写完整，现在发布</button>
  </div>
  </form>
  <div class="modal" tabindex="-1" id="follow-dialog" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">打开微信"扫一扫"扫描二维码</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <img src="" alt="" width="215px" height="215px">
        </div>
        <div class="modal-footer">
          <span>发布前请扫码关注我们的公众号，便于对已发布的信息管理，同时你也可以通过微信公众号进行信息管理。</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('extend_js')
<script type="text/javascript" src="/js/uploadfile.js"></script>
<script>
var formSubmitting = false;
var setFormSubmitting = function() { formSubmitting = true; };
window.onload = function() {
    window.addEventListener("beforeunload", function (e) {
        if (formSubmitting) {
            return undefined;
        }
        var confirmationMessage = '该页面信息尚未提交，确定退出？';
        (e || window.event).returnValue = confirmationMessage; 
        return confirmationMessage;
    });
};

$(function(){
  var timer = null;
  $('.btn-post').click(function(){
    axios.get('/weixin/qrcode').then(response => {
      if (response.data.result) {
        $('#follow-dialog img').attr('src', response.data.data.url);
        $('#follow-dialog').modal('show');
        timer = setInterval(function(){
          axios.get('/weixin/check-login').then(response => {
            if (response.data.result) {
              $('#follow-dialog').modal('hide');
              clearInterval(timer);
              $.ajax({
                url: '/post/create',
                type: 'POST',
                data: $('.form-create-post').serialize(),
                success: function (data) {
                  if (data.result) {
                    setFormSubmitting()
                    window.location.href = '/post/create/success'
                  } else {
                    toastr.error(data.message)
                  }
                }
              })
            } 
          })
        }, 2000);
      }
    })
  });
  $('#myModal').on('hide.bs.modal', function (e) {
    clearInterval(timer);
  })
})

$(function(){
  $('.post-select-category a').click(function(){
    $('.post-select-category').addClass('d-none')
    $('.post-category-selected span').text($(this).text())
    $('.post-category-selected').removeClass('d-none')
    $('#category-path').val($(this).data('path'))
    return false
  })
  $('.post-category-reselect').click(function(){
    $('.post-select-category').removeClass('d-none')
    $('.post-category-selected').addClass('d-none')
  })

  $('.post-images-120').on('click', 'div span', function () {
    $(this).closest('li').remove()
    if ($('.post-images-120 li').length < 6) {
      $('.fileupload-wrapper').removeClass('hidden')
    }
  })
  $('#fileupload').fileupload({
    url : '/image/upload',
    type: 'POST',
    dataType: 'json',
    formData: {_token: $('input[name=_token]').val(), 'action': 'post'},
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
})
</script>
@endsection