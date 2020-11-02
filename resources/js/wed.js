require('./bootstrap');

import {Swiper, Autoplay, Pagination} from 'swiper';
import 'swiper/swiper-bundle.css';
import MiniMasonry from "minimasonry";

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

var masonry = new MiniMasonry({
    baseWidth: document.querySelector('.masonry-container').clientWidth/2 - 20,
    ultimateGutter: 3,
    container: '.masonry-container'
}); 