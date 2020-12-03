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

    let currentPage = $('.wrap').data('page');
    $('.weui-tabbar__item').each(function(i, ele){
        let $ele = $(ele);
        if ($ele.data('page') == currentPage) {
            $ele.addClass('weui-bar__item_on');
            $ele.find('img').each(function(i, img){
                let $img = $(img);
                $img.attr('src', $img.data('onit'));
            });
        }
    })
    
    $('.page-loading').addClass('d-none');
})
