window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.toastr = require('toastr');

import MetisMenu from 'metismenujs';
import "@fortawesome/fontawesome-free/js/all.js";

const mm = new MetisMenu('#admin-menu');

$(function(){
    var pathname = location.pathname;
    var currentele = $("a[href='"+pathname+"']");
    currentele.addClass('mm-active');
    currentele.parents('ul.dropdown-menu').addClass('mm-show');
    currentele.parents('li.nav-item').addClass('mm-active');
})