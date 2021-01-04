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
    <div class="profile-photos" id="uploader">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <div class="weui-uploader">
                    <div class="weui-uploader__hd">
                        <p class="weui-uploader__title">上传更多生活照片，让对方更了解自己</p>
                    </div>
                    <div class="weui-uploader__bd">
                        <ul class="weui-uploader__files" id="uploaderFiles">
                            @foreach ($member->images as $image)
                            <li class="weui-uploader__file" data-id="{{$loop->index}}" style="background-image: url('{{$image}}');">  </li>
                            @endforeach
                        </ul>
                        <div class="weui-uploader__input-box">
                            <input id="uploaderInput" class="weui-uploader__input" type="file" accept="image/*" multiple=""/>
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
        
        $('.weui-uploader__file').each(function(i, ele){
            var url = ele.getAttribute('style') || '';
            var id = ele.getAttribute('data-id');
            
            if(url){
                url = url.match(/url\((.*?)\)/)[1].replace(/"/g, '');
            }
            
            uploadList.push({id:id, url:url, stop:function(){}});
            uploadCount++;
        })
    })
    
    var uploadCount = 0, uploadList = [];
    weui.uploader('#uploader', {
    url: '/wed/upload',
    auto: true,
    type: 'file',
    fileVal: 'upload-file',
    compress: {
        width: 1200,
        height: 1200,
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
        this.id = uploadCount;
    },
    onQueued: function(){
        uploadList.push(this);
    },
    onBeforeSend: function(data, headers){
        // $.extend(data, { test: 1 }); // 可以扩展此对象来控制上传参数
    },
    onProgress: function(procent){
    },
    onSuccess: function (ret) {
        uploadCount++;
        this.url = ret.data.url;
    },
    onError: function(err){
        weui.alert('上传失败，请稍后重试！');
    }
});

document.querySelector('#uploaderFiles').addEventListener('click', function(e){
    var target = e.target;

    while(!target.classList.contains('weui-uploader__file') && target){
        target = target.parentNode;
    }
    if(!target) return;

    var url = target.getAttribute('style') || '';
    var id = target.getAttribute('data-id');

    if(url){
        url = url.match(/url\((.*?)\)/)[1].replace(/"/g, '');
    }
    var gallery = weui.gallery(url, {
        className: 'custom-name',
        onDelete: function(){
            weui.confirm('确定删除该图片？', function(){
                for (var i = 0, len = uploadList.length; i < len; ++i) {
                    var file = uploadList[i];
                    if(file.id == id){
                        file.stop();
                        _.pullAt(uploadList, i);
                        sycnUpload();
                        break;
                    }
                }
                target.remove();
                gallery.hide();
            });
        }
    });
});

function sycnUpload()
{
    var images = _.map(uploadList, _.property('url'));
    axios.post('/wed/profile/images', {images: images})
        .then(function (response) {

        })
        .catch(function (error) {
        })
}

</script>
@endsection