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

let page = 1;
let noMore = false;
bs.on('pullingUp', () => {
    if (noMore) {
        return ;
    }
    $('.load-more').addClass('d-none');
    $('.loading').removeClass('d-none');
    axios.get('/wed/list/' + page)
    .then(function (response) {
        if (response.data.result) {
            if (response.data.data.members.length == 0) {
                $('.load-more').addClass('d-none');
                $('.loading').addClass('d-none');
                $('.no-more').removeClass('d-none');
                noMore = true;
                return ;
            }
            response.data.data.members.forEach(function(item){
               let itemHtml = $('.template .item').clone();
               itemHtml.find('img').attr('src', item.avatar);
               itemHtml.appendTo('.masonry-container');
            });
        }
        $('.load-more').removeClass('d-none');
        $('.loading').addClass('d-none');
        page++;
        masonry.layout();
        bs.refresh();
        bs.finishPullUp();
    })
    .catch(function (error) {
        bs.refresh();
        bs.finishPullUp();
    });
 });
