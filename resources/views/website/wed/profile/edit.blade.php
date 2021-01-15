@extends('layouts.wed', ['page' => 'profile'])

@section('content')
<div class="wrap">
    <div class="weui-form">
        <div class="weui-form__text-area">
          <h2 class="weui-form__title">个人相亲资料</h2>
          <div class="weui-form__desc">完善的资料，会得到更多的曝光机会！</div>
        </div>
        <div class="weui-form__control-area">
          <div class="weui-cells__group weui-cells__group_form">
            <div class="weui-cells weui-cells_form">
              <div class="weui-cell weui-cell_active">
                <div class="weui-cell__hd"><label class="weui-label">昵称</label></div>
                <div class="weui-cell__bd">
                    <input id="js_input" class="weui-input" placeholder="填一个自己喜欢的称呼">
                </div>
              </div>
              <div class="weui-cell weui-cell_active weui-cell_access" id="showDatePicker">
                <div class="weui-cell__hd">你的生日</div>
                <div class="weui-cell__bd" id="birthday" style="text-align: right"></div>
                <input type="hidden" name="birthday">
                <div class="weui-cell__ft">
                </div>
              </div>
              <div class="weui-cell weui-cell_active weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">性别</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="gender">
                        <option value="1">男</option>
                        <option value="2">女</option>
                    </select>
                </div>
            </div>
              <div class="weui-cell weui-cell_active">
                <div class="weui-cell__hd"><label class="weui-label">身高</label></div>
                <div class="weui-cell__bd">
                    <input id="js_input" class="weui-input" placeholder="填写你的身高，单位cm" type="number" pattern="[0-9]*">
                </div>
              </div>
              <div class="weui-cell weui-cell_active">
                <div class="weui-cell__hd"><label class="weui-label">体重</label></div>
                <div class="weui-cell__bd">
                    <input id="js_input" class="weui-input" placeholder="填写你的体重，单位kg" type="number" pattern="[0-9]*">
                </div>
              </div>
                <div class="weui-cell weui-cell_active">
                    <div class="weui-cell__hd"><label class="weui-label">工作</label></div>
                    <div class="weui-cell__bd">
                        <input id="js_input" class="weui-input" placeholder="">
                    </div>
              </div>
              <div class="weui-cell weui-cell_active weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">车辆</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="education">
                        <option value="0">无车</option>
                        <option value="1">有车</option>
                    </select>
                </div>
            </div>
            <div class="weui-cell weui-cell_active weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">房产</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="education">
                        <option value="0">无房</option>
                        <option value="1">有房</option>
                    </select>
                </div>
            </div>
              <div class="weui-cell weui-cell_active weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">学历</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="education">
                        <option value="1">中专以下</option>
                        <option value="2">中专</option>
                        <option value="3">大专</option>
                        <option value="4">本科</option>
                        <option value="5">硕士</option>
                        <option value="6">博士</option>
                        <option value="7">博士后</option>
                    </select>
                </div>
            </div>
            <div class="weui-cell weui-cell_active weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">收入</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="income">
                        <option value="2">2000以下</option>
                        <option value="4">2000-4000</option>
                        <option value="6">4000-6000</option>
                        <option value="10">6000-10000</option>
                        <option value="20">10000-20000</option>
                        <option value="21">20000以上</option>
                    </select>
                </div>
            </div>
            <div class="weui-cell weui-cell_active weui-cell_select weui-cell_select-after">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">婚姻情况</label>
                </div>
                <div class="weui-cell__bd">
                    <select class="weui-select" name="income">
                        <option value="1">未婚</option>
                        <option value="2">离异</option>
                        <option value="3">丧偶</option>
                    </select>
                </div>
            </div>
          
            <div class="weui-cell ">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">自我介绍</label>
                </div>
                <div class="weui-cell__bd">
                    <textarea class="weui-textarea" placeholder="写点什么，介绍一下吧" rows="3"></textarea>
                </div>
            </div>

            <div class="weui-cell ">
                <div class="weui-cell__hd">
                    <label for="" class="weui-label">择偶要求</label>
                </div>
                <div class="weui-cell__bd">
                    <textarea class="weui-textarea" placeholder="还有什么要求，写一写" rows="3"></textarea>
                </div>
            </div>
            </div>

           
          </div>
        </div>
        <div class="weui-form__tips-area">
            <p class="weui-form__tips">
                请务必填写真实有效信息
            </p>
          </div>
        <div class="weui-form__opr-area">
            <a class="weui-btn weui-btn_primary" href="#">保 存</a>
          </div>
      </div>
</div>
@endsection

@section('extend_js')
<script>
$(function(){
    $('#showDatePicker').on('click', function () {
        weui.datePicker({
            start: 1950,
            end: 2003,
            onChange: function (result) {
            },
            onConfirm: function (result) {
                console.log(result);
                $('#birthday').text(result[0].value+'-'+result[1].value+'-'+result[2].value);
            },
            title: '你的生日'
        });
    });
})
</script>
@endsection