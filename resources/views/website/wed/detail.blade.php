@extends('layouts.wed', ['page' => 'home'])

@section('content')
<div class="wrap">
    <div class="user-detail">
        <div class="user-detail-header">
            <div class="user-avatar">
                <img src="{{$member['avatar']}}" alt="">
            </div>
        </div>
    </div>
    <div class="user-detail-info">
        <div><strong>{{$member['name']}}</strong></div>
        <div class="gender-{{$member['gender']}}">{{$member['age']}}</div>
    </div>
    <div class="detail-card">
        <div class="detail-card-header">基本资料</div>
        <div class="detail-card-body detail-baseinfo">
            <dl>
                <dt>工&#12288;&#12288;作：</dt>
                <dd>{{$member['job']}}</dd>
            </dl>
            <dl>
                <dt>
                    收&#12288;&#12288;入：
                </dt>
                <dd>
                    {{$member['income_cn']}}
                </dd>
            </dl>
            <dl>
                <dt>
                    车&#12288;&#12288;房：
                </dt>
                <dd>
                    <span>{{$member['car'] ? '无车' : '有车'}}</span>
                    <span>{{$member['house'] ? '无房' : '有房'}}</span>
                </dd>
            </dl>
            <dl>
                <dt>
                    婚&#12288;&#12288;姻：
                </dt>
                <dd>
                    {{$member['marry_cn']}}
                </dd>
            </dl>
            <dl>
                <dt>
                    自我介绍：
                </dt>
                <dd>
                    {{$member['intro']}} Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta reprehenderit debitis cumque atque repudiandae eos fugit molestiae nemo cum dolore numquam tempora nihil sit voluptatibus, quod, quia nesciunt, dolores perferendis?
                </dd>
            </dl>
            <dl>
                <dt>
                    择偶要求： 
                </dt>
                <dd>
                    {{$member['demands']}} Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi sint reprehenderit, illo sit perspiciatis maiores magni dolores animi commodi, impedit minima hic, fugiat sunt error esse eos. Sunt, tenetur temporibus.
                </dd>
            </dl>
        </div>
    </div>

    <div class="detail-card">
        <div class="detail-card-header">Ta的标签</div>
        <div class="detail-card-body detail-tags">
            <div class="none-tags">Ta还没有留下标签</div>
        </div>
    </div>
    <div class="detail-card">
        <div class="detail-card-header">Ta的相册</div>
        <div class="detail-card-body detail-images">
            @if (!$member['images'])
            <div class="none-images">Ta还没有上传照片，通过红娘联系Ta!</div>
            @else 
            <ul>
                <li><img src="" alt=""></li>
                <li></li>
                <li></li>
            </ul>
            @endif
        </div>
    </div>

    <div class="contact-us">
        <img src="http://www.dtwmsj.com/uploads/20201208/c9420b24a81d84348f4e8cba1566808b.png">
        <p>长按识别二维码</p>
        <p>联系红娘迅速牵线</p>
    </div>
</div>
@endsection