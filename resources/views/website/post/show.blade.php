@extends('layouts.website')

@section('content')
<nav aria-label="breadcrumb" class="py-3">
    <ol class="breadcrumb">
        <li class="text-muted">当前位置：</li>
      <li class="breadcrumb-item"><a href="/">首页</a></li>
      <li class="breadcrumb-item"><a href="/fenlei/{{$fenlei->ename}}">{{$fenlei->name}}</a></li>
      <li class="breadcrumb-item"><a href="/category/{{$category->id}}">{{$category->name}}</a></li>
    </ol>
</nav>
<div class="content row">
    <div class="col">
        <div class="position-relative mb-3">
            <div class="expired_layer rounded d-none"></div>
            <div class="p-3">
            <h4 class="text-center py-3">{{$post->title}}</h4>
            <div class="text-center border-bottom text-md pb-2 text-secondary"> 信息编号: <span
                    class="text-danger mr-2"><strong>{{$post->id}}</strong></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;浏览: <span class="post-views"></span>次
                <span class="px-2">&nbsp;&nbsp;&nbsp;发布日期: {{$post->created_at->format('Y-m-d')}}</span> &nbsp;&nbsp;&nbsp;有效期: <span
                    class="expired_day text-danger mr-2" data-datetime="{{$post->expired_at}}">天</span></div>
            <div class="p-4 show-post-content">
                {!!$post->content!!}
            </div>
            <ul class="row list-unstyled px-4">
                @forelse ($post->getImages() as $image)
                <li class="col-4 py-2"><a href="{{$image}}" data-lightbox="post-image"><img src="{{$image}}!400x400"
                            width="100%" class="rounded"></a></li>
                @empty
                @endforelse
            </ul>
            <div class="post-contact">
                <div class="border-bottom pb-2"><strong>联系方式</strong></div>
                <p class="mt-3">联系电话：<span class="contact-phone">{{$contact_phone}}</span>
                    归属地：<span>{{$post->phone_local}}</span></p>
            </div>
            <div class="py-2 border text-danger bg-light post-tips my-4 text-md">
                <p><strong>友情提示:</strong></p>
                <p>该信息由网友发布，其真实性、准确性和合法性由发布信息的网友负责</p>
                <p>【在息县网】对其不提供任何保证，不承担任何责任</p>
                <p>友情提示：提高警惕，谨防诈骗，请留意外地手机号码。</p>
            </div>
            <div>
                <div class="pb-2">
                    <div class="btn-group dropright">
                        <button class="btn btn-link btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          我要举报
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">虚假信息</a>
                            <a class="dropdown-item" href="#">无效信息</a>
                            <a class="dropdown-item" href="#">重复信息</a>
                            <a class="dropdown-item" href="#">分类错误</a>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-md-auto index-ad">
        <div class="manage-post mb-3" id="manage-post">
            <div class="border-bottom pb-2">
                <strong>信息管理</strong>
            </div>
            <ul class="list-unstyled text-center mt-3">
                <li class="mb-3">
                    <button class="btn btn-success btn-sm btn-manage-post" data-action="refesh" data-postid="{{$post->id}}"><i class="fas fa-fw fa-sync" aria-hidden="true"></i>&nbsp;刷新信息，靠前显示</button>
                </li>
                <li class="mb-3">
                    <button class="btn btn-danger btn-sm btn-manage-post" data-action="expired" data-postid="{{$post->id}}"><i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;信息失效，不再显示</button></li>
                <li class="mb-3">
                    <button class="btn btn-primary btn-sm btn-manage-post" data-action="delay_expired" data-postid="{{$post->id}}"><i class="fas fa-fw fa-clock" aria-hidden="true"></i>&nbsp;信息有效期延长一周</button>
                </li>
            </ul>
        </div>
        <div class="border-bottom pb-2">
            <strong>赞助商广告</strong>
        </div>
        <ul class="list-unstyled my-4">
            <li class="text-center">欢迎投放广告!</li>
        </ul>
    </div>

    <div class="modal" tabindex="-1" id="wechat-auth-dialog">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">需要身份验证，请打开微信扫一扫</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
              <img src="" alt="" width="215px" height="215px">
            </div>
            <div class="modal-footer">
                <span class="text-danger">注意：需要使用发布该信息的微信扫码才能操作</span> 
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@section('extend_js')
<script type="text/javascript" src="/js/lightbox.js"></script>
<script>
    $(function () {
        var checkTimer;
        $('#wechat-auth-dialog').on('hide.bs.modal', function (e) {
            clearInterval(checkTimer);
            $('.btn-manage-post').prop('disabled', false);
        });

        $('.btn-manage-post').on('click', function (event) {
            var $ele = $(event.currentTarget);
            $ele.prop('disabled', true);
            var action = $ele.data('action');
            var id = $ele.data('postid');
            var wechatChecking = false;
            axios.get('/wechat/qrcode?scene=edit-post').then(response => {
                if (response.data.result) {
                $('#wechat-auth-dialog img').attr('src', response.data.data.url);
                $('#wechat-auth-dialog').modal('show');
                checkTimer = setInterval(() => {
                    axios.get('/wechat/check').then(response => {
                    if (response.data.result) {
                        if (! wechatChecking) {
                            $('#wechat-auth-dialog').modal('hide');
                            wechatChecking = true;
                            clearInterval(checkTimer);
                            axios.post('/post/manage', {action: action, id: id})
                                .then(response => {
                                if (response.data.result) {
                                    toastr.success('修改成功，等待缓存更新后刷新页面！');
                                } else {
                                    toastr.error(response.data.message);
                                }
                            });   
                            }
                        }
                        });
                    }, 2000);
                }
            });
            return false;
        });
    

    lightbox.option({
        albumLabel: '%1/%2'
    })

    var postId = {{ $post-> id }};

    $.get('/post/views/' + postId, function (res) {
        $('.post-views').text(res)
    });

    var expired_day = Math.ceil((Date.parse($('.expired_day').data('datetime')) - (new Date()).getTime()) / 86400000)
    if (parseInt(expired_day) > 0) {
        $('.expired_day').text(expired_day + '天')
    } else {
        $('.expired_day').text('已过期')
        if ($('.expired_layer').hasClass('d-none')) {
            $('.expired_layer').removeClass('d-none')
            $('.manage-post').addClass('d-none')
            $('.contact-phone').addClass('d-none')
        }
    }
})
</script>
@endsection