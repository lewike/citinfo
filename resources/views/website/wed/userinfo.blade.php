@extends('layouts.wed')

@section('content')
<div class="wrap">
    <div class="complete-userinfo-toptip">
        请先完善你的基本信息
    </div>
    <form class="form-complete-userinfo">
    <div class="step-birthday">
        <div class="weui-form">
            <div class="weui-form__text-area">
              <h2 class="weui-form__title">一、你的出生日期:</h2>
            </div>
            <div class="weui-form__control-area">
              <div class="weui-cells__group weui-cells__group_form">
                <div class="weui-cells">
                  <div class="weui-cell weui-cell_active weui-cell_access" id="birthday">
                    <div class="weui-cell__bd">日期</div>
                    <div class="weui-cell__ft birthday"></div>
                    <input type="hidden" name="birthday">
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
    <div class="step-gender">
        <div class="weui-form">
            <div class="weui-form__text-area">
              <h2 class="weui-form__title">二、你的性别:</h2>
            </div>
                <div class="weui-form__control-area">
                  <div class="weui-cells__group weui-cells__group_form">
                    <div class="weui-cells weui-cells_radio">
                        <label class="weui-cell weui-cell_active weui-check__label" for="gender1">
                            <div class="weui-cell__bd">
                                <p>男</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input type="radio" class="weui-check" name="gender" id="gender1" value="1">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                        <label class="weui-cell weui-cell_active weui-check__label" for="gender2">
            
                            <div class="weui-cell__bd">
                                <p>女</p>
                            </div>
                            <div class="weui-cell__ft">'
                                <input type="radio" name="gender" class="weui-check" id="gender2" value="2" checked="checked">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                    </div>
                  </div>
                </div>
          </div>
    </div>
    <div class="step-marry">
        <div class="weui-form">
            <div class="weui-form__text-area">
              <h2 class="weui-form__title">三、你当前的婚姻状况：</h2>
            </div>
                <div class="weui-form__control-area">
                  <div class="weui-cells__group weui-cells__group_form">
                    <div class="weui-cells weui-cells_radio">
                        <label class="weui-cell weui-cell_active weui-check__label" for="marry1">
                            <div class="weui-cell__bd">
                                <p>未婚</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input type="radio" class="weui-check" name="marry" id="marry1" checked="checked">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                        <label class="weui-cell weui-cell_active weui-check__label" for="marry2">
                            <div class="weui-cell__bd">
                                <p>离异</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input type="radio" name="marry" class="weui-check" id="marry2">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                        <label class="weui-cell weui-cell_active weui-check__label" for="marry3">
                            <div class="weui-cell__bd">
                                <p>丧偶</p>
                            </div>
                            <div class="weui-cell__ft">
                                <input type="radio" name="marry" class="weui-check" id="marry3">
                                <span class="weui-icon-checked"></span>
                            </div>
                        </label>
                    </div>
                  </div>
                </div>
          </div>
    </div>
    <div class="step-income">
        <div class="weui-form">
            <div class="weui-form__text-area">
              <h2 class="weui-form__title">四、你当前月收入情况：</h2>
            </div>
            <div class="weui-form__control-area">
              <div class="weui-cells__group weui-cells__group_form">
                <div class="weui-cells">
                    <div class="weui-cell weui-cell_active weui-cell_select weui-cell_select-after">
                        <div class="weui-cell__hd">
                            <label for="" class="weui-label">月收入</label>
                        </div>
                        <div class="weui-cell__bd">
                            <select class="weui-select" name="select2">
                                <option value="2">2000以下</option>
                                <option value="4">2000-4000</option>
                                <option value="6">4000-6000</option>
                                <option value="10">6000-10000</option>
                                <option value="20">10000-20000</option>
                                <option value="21">20000以上</option>
                            </select>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
    </div>
    <div class="step-eduction">
        <div class="weui-form">
            <div class="weui-form__text-area">
              <h2 class="weui-form__title">五、你的学历：</h2>
            </div>
            <div class="weui-form__control-area">
              <div class="weui-cells__group weui-cells__group_form">
                <div class="weui-cells">
                    <div class="weui-cell weui-cell_active weui-cell_select weui-cell_select-after">
                        <div class="weui-cell__hd">
                            <label for="" class="weui-label">学历</label>
                        </div>
                        <div class="weui-cell__bd">
                            <select class="weui-select" name="select2">
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
                </div>
              </div>
            </div>
          </div>
    </div>
    </form>
    <div class="weui-form__opr-area" style="background-color: #FFF">
        <a class="weui-btn weui-btn_primary btn-complete-userinfo" href="javascript:">提 交</a>
    </div>
</div>
@endsection
@section('tabbar')
    
@endsection

@section('extend_js')
<script src="https://res.wx.qq.com/open/libs/weuijs/1.2.1/weui.min.js"></script>
<script>
$(function(){
    $('#birthday').click(function(){
        weui.datePicker({
            start: 1950,
            end: 2004,
            defaultValue: [1991, 6, 9],
            onConfirm: function(result){
                var birthday = result[0].value+'年 '+result[1].value+'月 '+result[2].value+'日'
                $('input[name="birthday"]').val(result[0].value+'-'+result[1].value+'-'+result[2].value);
                $('.birthday').text(birthday);
                console.log(result)
            },
            id: 'birthdayPicker'
        })
    })
    $('.btn-complete-userinfo').click(function(){
        axios.axios.post('/wed/userinfo/complete', $('.form-complete-userinfo').serialize())
        .then(function (response) {
            console.log(response)
        })
        .catch(function (error) {
        })
    })
})
</script>
@endsection