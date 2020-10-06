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
    });

    $('ul.products').each(function(){

        let children = $(this).find('li').length;

        switch(children){
            case 0:
            case 1:
                $(this).addClass("no-slider");
                break;
            case 2:
                $(this).addClass("slider-sm");
                break;
            case 3:
            case 4:
                $(this).addClass("slider-med");
                break;
            case 5:
            case 6:
                $(this).addClass("slider-lg");
            break;
        }


        if(children > 1){
            let slider = new Flickity( // Create a flickity slider on the about page
                $(this).get(0), {
                    cellSelector: '.product',
                    cellAlign: 'center',
                    wrapAround: true,
                    autoPlay: false,
                    pageDots: false,
                    fade: false,
                    prevNextButtons: true,
                    groupCells: true,
                    initialIndex: 2,
                    watchCSS: true,

                }
            
            )
        }   
    })




})