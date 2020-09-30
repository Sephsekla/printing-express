import Flickity from 'flickity-fade';

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


    $('.image-wrapper-outer').each(function(){
        if($(this).find('.image-wrapper').length > 1){
            let slider = new Flickity( // Create a flickity slider on the about page
                $(this).get(0), {
                    cellAlign: 'center',
                    wrapAround: true,
                    autoPlay: true,
                    pageDots: true,
                    fade: true,
                    prevNextButtons: false

                }
            
            )
        }   
    })




})