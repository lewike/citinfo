@extends('layouts.wed', ['page' => 'profile'])

@section('content')
<div class="wrap">
    <div class="profile-top-wrap">
        <div class="profile-avatar">
            <img src="https://imgavater.ui.cn/avatar/5/7/4/9/919475.jpg?imageMogr2/auto-orient/crop/!842x842a75a0/thumbnail/148x148" alt="">
        </div>
        <div class="profile-info">
            <div class="profile-info-name">姓名 <span>未实名认证</span></div>
            <div class="profile-info-percent">资料完成度100%</div>
        </div>
    </div>
    <div class="profile-photos">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <div class="weui-uploader">
                    <div class="weui-uploader__hd">
                        <p class="weui-uploader__title">上传更多生活照片，让对方更了解自己</p>
                    </div>
                    <div class="weui-uploader__bd">
                        <ul class="weui-uploader__files" id="uploaderFiles"></ul>
                        <div class="weui-uploader__input-box">
                            <input id="uploader" class="weui-uploader__input" type="file" accept="image/*" capture="camera" multiple=""/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="profile-menu">
        <ul>
            <li class="d-flex align-items-center justify-content-between" data-url="/wed/profile/edit">
                <div class="d-flex align-items-center">
                    <img src="/images/wed/icons/detail.png" alt="">
                    我的资料
                </div>
                <div class="d-flex align-items-center">
                    <div class="font-small">完成度80%</div>
                    <img class="arrow-next" src="/images/wed/icons/next.png" alt="">
                </div>
            </li>
            <li class="d-flex align-items-center">
                <img src="/images/wed/icons/hartbeat.png" alt="">
                联系红娘
            </li>
            <li class="d-flex align-items-center">
                <img src="/images/wed/icons/show.png" alt="">
                隐藏我的信息
            </li>
        </ul>
    </div>
</div>
@endsection

@section('extend_js')
<script>
    $(function(){
        $('.profile-menu li').click(function(event){
            window.location.href = $(event.currentTarget).data('url')
        })
    })

var uploadCount = 0, uploadList = [];
var uploadCountDom = document.getElementById("uploadCount");
weui.uploader('#uploader', {
    url: '/wed/upload/img',
    auto: true,
    type: 'file',
    fileVal: 'fileVal',
    compress: {
        width: 1600,
        height: 1600,
        quality: .8
    },
    onBeforeQueued: function(files) {
        if(["image/jpg", "image/jpeg", "image/png"].indexOf(this.type) < 0){
            weui.alert('请上传图片');
            return false;
        }
        if(this.size > 5 * 1024 * 1024){
            weui.alert('请上传不超过10M的图片');
            return false;
        }
        if (files.length > 5) { // 防止一下子选中过多文件
            weui.alert('最多只能上传5张图片，请重新选择');
            return false;
        }
        if (uploadCount + 1 > 5) {
            weui.alert('最多只能上传5张图片');
            return false;
        }

        ++uploadCount;
        uploadCountDom.innerHTML = uploadCount;
    },
    onQueued: function(){
        uploadList.push(this);
        console.log(this);
    },
    onBeforeSend: function(data, headers){
        // $.extend(data, { test: 1 }); // 可以扩展此对象来控制上传参数
    },
    onProgress: function(procent){
        console.log(this, procent);
    },
    onSuccess: function (ret) {
        console.log(this, ret);
    },
    onError: function(err){
        console.log(this, err);
    }
});
</script>
@endsection