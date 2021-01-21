@extends('layouts.wechat')

@section('content')
<div class="wrap post-show">
    <div class="breadcrumb">
        信息详情
    </div>
    <div class="post-show-title">
        {{$post->title}}
    </div>
    <div class="post-show-info">
        浏览次数：{{$post->views}} 发布时间：{{$post->created_at->format('m-d')}} 有效期：{{$post->expired_at->format('m-d')}}
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
    <div class="post-show-phone">
        联系方式： {{$post->phone}}  <span class="btn-call-phone">拨打电话</span>
    </div>
    <div class="post-show-tip">
        <dl>
            <dt><strong>提醒：</strong></dt>
            <dd>
                <p>该信息由网友发布，其真实性、准确性和合法性由发布信息的网友负责。</p>
                <p>【在息县网】对其不提供任何保证，不承担任何责任。</p>
                <p>友情提示：提高警惕，谨防诈骗，请留意外地手机号码。</p>
            </dd>
        </dl>
    </div>
</div>
@endsection

@section('extend_js')
<script>
    $(function(){
        $('.post-show-img li').on('click', function(event){
            var $ele = $(event.currentTarget);
            var img = $ele.find('img');
            
            weui.gallery(img.attr('src'));
        });
    });

</script>
@endsection