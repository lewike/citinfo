@extends('layouts.wechat')

@section('content')
<div class="wrap" data-page="/post/create">
    <div class="breadcrumb weui-flex">
        <div><a href="/wx">主页</a></div>
        <div class="weui-flex__item text-center">
            <h4>免费发布消息</h4>
        </div>
        <div><a href="javascript:location.reload()">重置</a></div>
    </div>
            <div class="weui-panel" style="height: 100%">
                <div class="weui-panel__bd">
                <form class="form-create-post">
                    @csrf
                    <div class="weui-form__control-area">
                    <div class="content-label">↓↓↓在下面填写信息详细内容↓↓↓</div>
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <textarea class="weui-textarea" placeholder="请在这里填写，需要注意：
①此内容框中禁止留任何联系方式；
②如发布招聘，应写明单位名称和职位名称；
③如发布房产，应写明小区名称、楼层和面积；
④应客观、真实、准确地表述信息；
⑤应遵守计算机、互联网及广告相关的法律法规。" rows="6" name="content" id="create-content" autofocus></textarea>
                        </div>
                    </div>
                    <div class="weui-cell weui-cell_select weui-cell_select-after">
                        <div class="weui-cell__hd"><label class="weui-label">有效时间</label></div>
                        <div class="weui-cell__bd">
                        <select class="weui-select" name="expired_day">
                            <option value="3">三天</option>
                            <option value="7">一周</option>
                            <option value="15">半个月</option>
                            <option value="30">一个月</option>
                        </select>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">联系电话</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="number" name="phone" id="create-phone" pattern="[0-9]*" placeholder="请输入联系电话">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__bd" id="uploader">
                            <div class="weui-uploader">
                                <div class="weui-uploader__hd">
                                    <p class="weui-uploader__title">图片上传</p>
                                </div>
                                <div class="weui-uploader__bd">
                                    <ul class="weui-uploader__files" id="upload_files">
                                    </ul>
                                    <div class="weui-uploader__input-box">
                                        <input id="uploader_file" class="weui-uploader__input" type="file" accept="image/*" multiple="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="weui-form__opr-area">
                        <button class="weui-btn weui-btn_primary btn-create-post">发布消息</button>
                    </div>
                </form>

                </div>
                <div class="weui-panel__ft">
                    
                </div>
            </div>
        </div>
@endsection

@section('extend_js')
<script>
$(function(){
    $('#upload_files').on('click', 'li', function() {
      var $this = $(this);
      weui.actionSheet([{
        label: '删除',
        onClick: function () {
          var id = $this.data('id');
          $('input[data-id="'+id+'"]').remove();
          $this.remove();
        }
      }])
    })

    $('.btn-create-post').click(function(){
        var content = $('#create-content').val();
        if (content.length < 20) {
            weui.topTips('信息内容字数太少，再多写点吧', {
                duration: 3000,
            });
            return false;
        }
        var phone = $('#create-phone').val();
        if (phone.length != 11) {
            weui.topTips('手机号码不对，你再看看！', {
                duration: 3000,
            });
            return false;
        }
        
        axios.post('/wx/post/create', $('.form-create-post').serialize())
        .then(function (response) {
            if (response.data.result) {
                weui.confirm('您的信息已经提交，需要经过管理员审核之后才能显示，请耐心等待！', {
                    buttons: [{
                        label: '回到首页',
                        type: 'primary',
                        onClick: function(){ window.location.href = '/wx';}
                    }, {
                        label: '再发一条',
                        type: 'default',
                        onClick: function(){ window.location.reload(); }
                    }]
                });
            } else {
                weui.alert(response.data.message);
            }
        })
        .catch(function (error) {
        })
        return false;
    })
})
var uploadCount = 0, uploadList = [];
weui.uploader('#uploader', {
    url: '/wx/post/upload',
    auto: true,
    type: 'file',
    fileVal: 'image',
    compress: {
        width: 1600,
        height: 1600,
        quality: 1
    },
    onBeforeQueued: function(files) {
        if(["image/jpg", "image/jpeg", "image/png", "image/gif"].indexOf(this.type) < 0){
            weui.alert('请上传图片');
            return false;
        }
        if(this.size > 10 * 1024 * 1024){
            weui.alert('请上传不超过10M的图片');
            return false;
        }
        if (files.length > 6) { // 防止一下子选中过多文件
            weui.alert('最多只能上传5张图片，请重新选择');
            return false;
        }
        if (uploadCount + 1 > 6) {
            weui.alert('最多只能上传6张图片');
            return false;
        }

        ++uploadCount;
    },
    onQueued: function(){
        uploadList.push(this);
    },
    onBeforeSend: function(data, headers){
    },
    onProgress: function(procent){
    },
    onSuccess: function (ret) {
        $('#upload_files').append('<input type="hidden" name="images[]" value="'+ret.img+'" data-id="'+this.id+'">');
    },
    onError: function(err){
    }
});
</script>
@endsection