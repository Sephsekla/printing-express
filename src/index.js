import './sass/style.scss';

import './js/menu.js';
import initMenu from './js/menu.js';

$ = jQuery;

initMenu();

$(document).ready(function(){

    $('.woocommerce-product-gallery__image').click(function(e){
        e.preventDefault();
        $(this).css("border","2px solid blue");

        $('.woocommerce-product-gallery').data('thumb',$(this).data('thumb'));
    })
})