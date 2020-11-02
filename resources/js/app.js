require('./bootstrap');

import DuckTimer from 'duck-timer';

$(function() {
    $('.count-down').each(function(i, e){
        const timer = new DuckTimer({interval: 1000});
        var endTime = $(e).data('time');
        timer.setCountdown(endTime).onInterval(function(t){
            var remainTime = t.remain.toData();
            $(e).text(
                `${remainTime.day}天${remainTime.hour}小时${remainTime.min}分${remainTime.sec}秒`
            )
        }).onTimeout(function(t) {
            $(e).text(
                '已结束'
            )
        }).start();
    })
})
