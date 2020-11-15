@extends('layouts.website')

@section('content')
<nav class="breadcrumb">
    <a class="breadcrumb-item" href="/">首页</a>
    <a class="breadcrumb-item" href="/fenlei/{{$fenlei->ename}}">{{$fenlei->name}}</a>
    <a class="breadcrumb-item" href="/category/{{$category->id}}">{{$category->name}}</a>
</nav>
<div class="content row">
    <div class="col position-relative mb-5 mr-2">
        <div class="expired_layer rounded d-none"></div>
        <div class="px-3">
            <h4 class="text-center py-3">{{$post->title}}</h4>
            <div class="text-center border-bottom text-md pb-2 text-secondary"> 信息编号: <span
                    class="text-danger mr-2"><strong>{{$post->id}}</strong></span> 访问: <span class="post-views"></span>次
                <span class="px-2">发布日期: {{$post->created_at->format('Y-m-d')}}</span> 有效期: <span
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
    <div class="col-md-auto index-ad">
        <div class="manage-post mb-3" id="manage-post">
            <div class="border-bottom pb-2">
                <strong>信息管理</strong>
            </div>
            <ul class="list-unstyled text-center mt-3">
                <li class="mb-3">
                    <button class="btn btn-success btn-sm btn-manage-post" data-action="refesh"><i class="fas fa-fw fa-sync" aria-hidden="true"></i>&nbsp;刷新信息，靠前显示</button>
                </li>
                <li class="mb-3">
                    <button class="btn btn-danger btn-sm btn-manage-post" data-action="expired"><i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;信息失效，不再显示</button></li>
                <li class="mb-3">
                    <button class="btn btn-info btn-sm btn-manage-post" data-action="delay_expired"><i class="fas fa-fw fa-clock" aria-hidden="true"></i>&nbsp;信息有效期延长一周</button>
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
    <div class="modal" tabindex="-1" id="follow-dialog" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fab fa-weixin"></i> 身份验证，请用微信扫描二维码</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="" alt="" width="215px" height="215px">
                </div>
                <div class="modal-footer">
                    <span class="text-danger">注意：请使用发布该信息的微信扫描！</span>
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
    var timer = null;
    $('.btn-edit-post').click(function () {
        $(event.currentTarget).prop('disabled', true)
        axios.get('/weixin/qrcode').then(response => {
            if (response.data.result) {
                $('#follow-dialog img').attr('src', response.data.data.url);
                $('#follow-dialog').modal('show');
                timer = setInterval(function () {
                    axios.get('/weixin/check-login').then(response => {
                        if (response.data.result) {
                            $('#follow-dialog').modal('hide');
                            clearInterval(timer);
                            $.ajax({
                                url: '/post/edit',
                                type: 'POST',
                                data: $('.form-edit-post').serialize(),
                                success: function (res) {
                                    if (res.result) {
                                        toastr.success('修改成功，等待缓存更新后刷新页面！')
                                    } else {
                                        toastr.error(res.message)
                                    }
                                },
                                complete: function () {
                                    $(event.currentTarget).prop('disabled', false)
                                }
                            })
                        }
                    })
                }, 2000);
            }
        })
        return false
    })

    $('#follow-dialog').on('hide.bs.modal', function (e) {
        clearInterval(timer);
        $('.btn-edit-post').prop('disabled', false);
    })

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