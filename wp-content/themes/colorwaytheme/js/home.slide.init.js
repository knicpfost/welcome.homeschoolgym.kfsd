// JavaScript Document
jQuery(window).load(function(){
    jQuery('#slides').slides({
        effect: 'fade',
        slideSpeed: 600,
        fadeSpeed:350,
        generateNextPrev: true,
        generatePagination: true,
        preload: true,
        preloadImage: 'img/loading.gif',
        play: 5000,
        pause: 2500,
        hoverPause: true,
	crossfade: true
    });
    jQuery( '#slides .pagination' ).wrap( '<div id="slider_pag" />' );
    jQuery( '#slides #slider_pag' ).wrap( '<div id="slider_nav" />' );
});