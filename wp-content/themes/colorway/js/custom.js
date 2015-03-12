//Cufon Replacement
Cufon.replace('h2')('h3')('h4')('h5')('h6');
//Tipsy	
jQuery(function() {    
    jQuery('.social_logo a').tipsy();
}); 
jQuery(function(){
    jQuery('ul.sf-menu').superfish();
})
//Fade images
jQuery(document).ready(function(){
    jQuery(".columns img, .post .postimg").hover(function() {
        jQuery(this).stop().animate({
            opacity: "0.5"
        }, '500');
    },
    function() {
        jQuery(this).stop().animate({
            opacity: "1"
        }, '500');
    });
});