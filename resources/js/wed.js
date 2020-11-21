require('./bootstrap');

import {Swiper, Autoplay, Pagination} from 'swiper';
import 'swiper/swiper-bundle.css';
import MiniMasonry from "minimasonry";
import BScroll from 'better-scroll';

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

window.masonry = new MiniMasonry({
    baseWidth: document.querySelector('.masonry-container').clientWidth/2 - 20,
    ultimateGutter: 3,
    container: '.masonry-container'
}); 

let bs = new BScroll('.weui-tab__panel', {
    pullUpLoad: true
});

let page = 2;
let loading = false;
bs.on('pullingUp', () => {
    if (loading) {
        return ;
    }
    $('.load-more').addClass('d-none');
    $('.loading').removeClass('d-none');
    loading = true;
    axios.get('/wed/list/' + page)
    .then(function (response) {
        $('.load-more').removeClass('d-none');
        $('.loading').addClass('d-none');
        loading = false;
    })
    .catch(function (error) {
        loading = false;
    });
  bs.finishPullUp();
});
