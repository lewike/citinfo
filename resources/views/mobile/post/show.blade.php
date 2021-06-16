@extends('layouts.mobile')

@section('content')
<div class="wrap post-show">
    <div class="breadcrumb weui-flex">
        <div><a href="/"><img src="/images/mobile/back.png" alt=""></a></div>
        <div class="weui-flex__item text-center">
            <h4>信息详情</h4> 
        </div>
        <div><a href="javascript:location.reload()"><img src="/images/mobile/reload.png" alt=""></a></div>
    </div>
    <div class="card">
    <div class="post-show-title">
        {{$post->title}}
    </div>
    <div class="post-show-info">
        浏览：{{$post->views}}次 发布时间：{{$post->created_at->format('Y-m-d')}}
    </div>
    <div class="post-show-content">
        {!!$post['content']!!}
    </div>
    @if ($post['images'])
    <ul class="post-show-img">
        @foreach ($post['images'] as $image)
        <li class="">
            <img src="{{$image}}" alt="">
        </li>
        @endforeach
    </ul>
    @endif
    </div>
    <div class="card">
        <div class="card-title">联系方式</div>   
        <div class="post-show-phone">
            <span class="post-phone">{{ substr_replace($post->phone,'****',3,4)}}</span>  <span class="btn-call-phone" data-id="{{$post->id}}">拨打电话</span>
            <div class="post-phone-local">归属地：{{$post->phone_local}}</div>
        </div>
    </div>
    <div class="card">
        <div class="card-title title-danger">重要提醒</div>
        <div class="post-show-tip">
            <dl>
                <dd>
                    <p>该信息由网友发布，其真实性、准确性和合法性由发布信息的网友负责。</p>
                    <p>【在息县网】对其不提供任何保证，不承担任何责任。</p>
                    <p>友情提示：提高警惕，谨防诈骗，请留意外地手机号码。</p>
                </dd>
            </dl>
        </div>
</div>
</div>
@endsection

@section('extend_js')
<script>
    $(function(){
        var postId = {{$post->id}};
        axios.get('/post/view/'+postId);
        $('.post-show-img li').on('click', function(event){
            var $ele = $(event.currentTarget);
            var img = $ele.find('img');
            
            weui.gallery(img.attr('src'));
        });
        $('.btn-call-phone').click(function(){
            axios.get('/post/phone/'+postId)
            .then(function (response) {
                window.location.href='tel:'+response.data.data.phone;
            })
            .catch(function (error) {
            })
        })
    });

</script>
@endsection