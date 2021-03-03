window._ = require('lodash');
window.$ = window.jQuery = require('jquery');

import "bootstrap";
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.timeago = require('timeago.js')
window.toastr = require('toastr')
window.toastr.options = {
  'closeButton': false,
  'debug': false,
  'newestOnTop': false,
  'progressBar': false,
  'positionClass': 'toast-top-right',
  'preventDuplicates': false,
  'onclick': true,
  'showDuration': '300',
  'hideDuration': '1000',
  'timeOut': '5000',
  'extendedTimeOut': '1000',
  'showEasing': 'swing',
  'hideEasing': 'linear',
  'showMethod': 'fadeIn',
  'hideMethod': 'fadeOut'
}

let timeagoList = document.querySelectorAll('.timeago');
if (timeagoList.length) {
  timeago.render(timeagoList, 'zh_CN')
}

$(function () {
  $('.expired_time').each(function (_, ele) {
    var $ele = $(ele);
    var expired_day = Math.ceil((Date.parse($ele.data('time')) - (new Date()).getTime()) / 86400000)
    if (expired_day > 0) {
      $ele.text(expired_day + '天');
    } else {
      $ele.text('已失效');
      $ele.closest('tr').addClass('tr-expired-post');
    }
  });
});