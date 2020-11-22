require('./bootstrap');

import { Swiper, Autoplay, Pagination } from 'swiper';
import 'swiper/swiper-bundle.css';

$(function () {
    Swiper.use([Autoplay, Pagination])
    const swiper = new Swiper('.swiper-container', {
      loop: true,
      autoplay: {
        delay: 5000,
      },
      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
      },
    });

    $('.weui-tabbar__item').on('click', function () {
        window.location.href = $(this).data('page');
    });
})
