@extends('layouts.carpool')
@section('title')
@endsection
@section('content')
<div class="weui-tab">
    <div class="weui-tab__panel pinche-post">
        <div class="weui-tab__content d-block">
            <div class="weui-panel" style="height: 100%">
                <div class="carpool-topbar weui-flex">
                    <div><a href="/pinche">首页</a></div>
                    <div>发布拼车信息</div>
                    <div><a href="javascript:location.reload()">重置</a></div>
                </div>
                <div class="weui-panel__bd">
                <div class="pinche-post-tips">免责声明：本平台不对任何人提供任何形式的担保，所有信息仅供参考，不承担由此产生的任何民事及法律责任。用户使用本平台即视为同意该免责声明。
                    <div class="close"></div>
                </div>
                <form class="form-create-carpool">
                    @csrf
                    <div class="weui-cell weui-cell_select weui-cell_select-after">
                        <div class="weui-cell__hd"><label class="weui-label">拼车类型</label></div>
                        <div class="weui-cell__bd">
                        <select class="weui-select" name="type" id="select-type">
                            <option value="">请选择拼车类型</option>
                            <option value="car">车找人</option>
                            <option value="people">人找车</option>
                        </select>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">出发时间</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input btn-select-time" type="text" name="start_at" placeholder="点击选择时间" readonly>
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">时间补充</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" name="additional" placeholder="选填">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">出发地</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" name="direction_from">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">目的地</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" name="direction_to">
                        </div>
                    </div>
                    <div class="weui-cell" id="input-directions">
                        <div class="weui-cell__hd"><label class="weui-label">途径</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" name="directions" placeholder="选填">
                        </div>
                    </div>
                    <div class="weui-cell" id="input-cartype">
                        <div class="weui-cell__hd"><label class="weui-label">车型</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="text" name="car_type" placeholder="选填" value="">
                        </div>
                    </div>
                    <div class="weui-cell" id="input-seat">
                        <div class="weui-cell__hd"><label class="weui-label label-car">空位</label><label class="weui-label label-people">人数</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="number" name="seat_cnt"  pattern="[0-9]*" placeholder="只需要输入数字">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">手机</label></div>
                        <div class="weui-cell__bd">
                            <input class="weui-input" type="number" name="phone" pattern="[0-9]*" placeholder="请输入联系电话">
                        </div>
                    </div>
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">更多</label></div>
                        <div class="weui-cell__bd">
                            <textarea class="weui-textarea" placeholder="还没有说完，再补充点吧" rows="3" name="description"></textarea>
                        </div>
                    </div>
                </form>
                </div>
                <div class="weui-panel__ft weui-form__tips-area">
                    <button class="weui-btn weui-btn_primary btn-create-carpool">发布消息</button>
                </div>
                <div class="weui-form__tips-area">
                    <p class="weui-form__tips">
                    点击发布信息即表示<a href="/pinche/rule">已阅读拼车说明</a>
                    </p>
                    <p class="weui-form__tips start-tips">
                        提示：出发时间到期后信息自动删除
                    </p>
                  </div>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
{!! $config['tongji'] ?? '' !!}
</div>
@endsection

@section('extend_js')
<script>
$(function(){
    var config = {!!$app->jssdk->buildConfig(['chooseWXPay'], false)!!};
    wx.config(config);

    var itemDate = LWDate.getDateTime()
    $('.btn-select-time').click(function(){
        weui.picker(itemDate.date, itemDate.hour, itemDate.minute, {
            title: '请选择出发时间',
            onConfirm: function (e) {
                $('.btn-select-time').val(e[0].value+' '+e[1].value+':'+e[2].value)
            }
        })
    })

    $('#select-type').change(function (e) {
        var type = e.target.value
        if (type == 'car') {
            $('#input-directions').removeClass('d-none')
            $('#input-cartype').removeClass('d-none')
            $('#input-seat').removeClass('seat-cnt')
        }
        if (type == 'people') {
            $('#input-directions').addClass('d-none')
            $('#input-cartype').addClass('d-none')
            $('#input-seat').addClass('seat-cnt')
        }
    })

    $('.pinche-post-tips .close').click(function (){
        $('.pinche-post-tips').addClass('d-none')
    })
    
    $('.btn-create-carpool').click(function(event){
        event.target.disabled = true;
        var start = $('.btn-select-time').val()
        if (!LWDate.checkStartTime(start)) {
            weui.topTips('出发时间不能为过去时间，请重新修改！', 3000)
            event.target.disabled = false;
            return false;
        }

        axios.post('/pinche/post', $('.form-create-carpool').serialize())
        .then(function (response) {
            if (response.data.result) {
                weui.alert('已经成功发布，你可以使用置顶来获得更好的效果!', {
                    title: '恭喜你！',
                    buttons: [{
                        label: '确定',
                        type: 'primary',
                        onClick: function(){ window.location.href="/pinche/user" }
                    }]
                })
            } else {
                event.target.disabled = false;
                weui.topTips(response.data.message, 3000);
            }
        })
        .catch(function (error) {
            event.target.disabled = false;
        });
    });
})
</script>
@endsection