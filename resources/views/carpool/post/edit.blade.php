@extends('citinfo::layouts.weixin')
@section('title')
{{$config['edit']['title']}}
@endsection
@section('content')
<div class="weui-tab">
    <div class="weui-tab__panel pinche-post">
        <div class="weui-tab__content d-block">
            <div class="weui-panel" style="height: 100%">
                <div class="carpool-show-topbar weui-flex">
                    <div><a href="javascript:" onclick="history.back()">返回</a></div>
                    <div>修改拼车信息</div>
                    <div>&nbsp;</div>
                </div>
                <div class="weui-panel__bd">
                <div class="pinche-post-tips">免责声明：本平台不对任何人提供任何形式的担保，所有信息仅供参考，不承担由此产生的任何民事及法律责任。用户使用本平台即视为同意该免责声明。
                    <div class="close"></div>
                </div>
                <form class="form-edit-carpool">
                    @csrf
                    <input type="hidden" id="carpool_id" value="{{$carpool->id}}">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">拼车类型：</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input carpooltype-readonly" type="text" name="type" value="{{$carpool->type == 'car'?'车找人':'人找车'}}" readonly> <span>【无法修改】</span>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">出发时间：</label></div>
                        <div class="weui-cell__bd">
                        <input class="weui-input btn-select-time" type="text" name="start_at" placeholder="点击选择时间" value="{{$carpool->start_at}}" readonly>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">时间补充：</label></div>
                        <div class="weui-cell__bd">
                        <input class="weui-input" type="text" name="additional" placeholder="选填" value="{{$carpool->additional}}">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">出发地：</label></div>
                        <div class="weui-cell__bd">
                        <input class="weui-input" type="text" name="direction_from" value="{{$carpool->direction_from}}">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">目的地：</label></div>
                        <div class="weui-cell__bd">
                        <input class="weui-input" type="text" name="direction_to" value="{{$carpool->direction_to}}">
                        </div>
                    </div>
                    @if ($carpool->type == 'car')
                    <div class="weui-cell" id="input-directions">
                        <div class="weui-cell__hd"><label class="weui-label">途经：</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" name="directions" placeholder="选填" value="{{$carpool->directions}}">
                        </div>
                    </div>
                    <div class="weui-cell" id="input-cartype">
                        <div class="weui-cell__hd"><label class="weui-label">车型：</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" name="car_type" placeholder="选填" value="{{$carpool->car_type}}">
                        </div>
                    </div>
                    @endif
                    <div class="weui-cell" id="input-seat">
                        <div class="weui-cell__hd">
                            @if ($carpool->type == 'car')
                            <label class="weui-label">空位：</label>
                            @else
                            <label class="weui-label">人数：</label>
                            @endif
                        </div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" name="seat_cnt" value="{{$carpool->seat_cnt}}">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">手机：</label></div>
                        <div class="weui-cell__bd">
                        <input class="weui-input" type="number" name="phone" pattern="[0-9]*" placeholder="请输入联系电话" value="{{$carpool->phone}}">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">更多：</label></div>
                        <div class="weui-cell__bd">
                        <textarea class="weui-textarea" placeholder="还没有说完，再补充点吧" rows="3" name="description">{{$carpool->description}}</textarea>
                        </div>
                    </div>
                </form>
                </div>
                <div class="weui-panel__ft">
                    <button class="weui-btn weui-btn_primary btn-edit-carpool">编辑消息</button>
                </div>
                <div class="weui-form__tips-area">
                    <p class="weui-form__tips start-tips">
                        提示：出发时间到期后信息自动删除
                    </p>
                  </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
{!! $config['tongji'] !!}
</div>
@endsection

@section('extend_js')
<script>
$(function(){
    var itemDate = LWDate.getDateTime()
    $('.btn-select-time').click(function(){
        weui.picker(itemDate.date, itemDate.hour, itemDate.minute, {
            title: '请重新选择出发时间',
            onConfirm: function (e) {
                $('.btn-select-time').val(e[0].value+' '+e[1].value+':'+e[2].value)
            }
        })
    })

    $('.pinche-post-tips .close').click(function (){
        $('.pinche-post-tips').addClass('d-none')
    })
    
    $('.btn-edit-carpool').click(function(){
        var start = $('.btn-select-time').val()
        if (!LWDate.checkStartTime(start)) {
            weui.alert('出发时间不能为过去时间，请重新修改！')
            return false;
        }
        $.ajax({
            url: '/weixin/pinche/edit/'+$('#carpool_id').val(),
            type: 'post',
            data: $('.form-edit-carpool').serialize(),
            success: function (data) {
                if (data.result) {
                    weui.alert('已经成功修改，点击确定返回个人中心', {
                        title: '恭喜你！',
                        buttons: [{
                            label: '确定',
                            type: 'primary',
                            onClick: function(){ window.location.href="/weixin/pinche/user" }
                        }]
                    })
                } else {
                    weui.topTips(data.message, 3000);
                }
            }
        })
    })
})
</script>
@endsection