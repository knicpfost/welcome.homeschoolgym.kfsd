<?php
include_once TEMPLATEPATH . '/functions/inkthemes-functions.php';
$functions_path = STYLESHEETPATH . '/functions/';
/* These files build out the options interface.  Likely won't need to edit these. */
require_once ($functions_path . 'admin-functions.php');		// Custom functions and plugins
require_once ($functions_path . 'admin-interface.php');		// Admin Interfaces (options,framework, seo)
/* These files build out the theme specific options and associated functions. */
require_once ($functions_path . 'theme-options.php'); 		// Options panel settings and custom settings
/*-----------------------------------------------------------------------------------*/
/* jQuery Enqueue */
/*-----------------------------------------------------------------------------------*/
function jquery_init() {
if (!is_admin()) {
wp_deregister_script('jquery');
wp_register_script('jquery', get_bloginfo('stylesheet_directory'). '/js/jquery.min.js', false, '1.7', true);//load jquery from google api, and place in footer
wp_enqueue_script('jquery');
wp_enqueue_script( 'ddsmoothmenu', get_bloginfo('stylesheet_directory')."/js/ddsmoothmenu.js", array('jquery'));
wp_enqueue_script( 'ddsmoothmenuinit', get_bloginfo('stylesheet_directory')."/js/ddsmoothmenu-init.js", array('jquery'));
wp_enqueue_script( 'slides', get_bloginfo('stylesheet_directory').'/js/slides.min.jquery.js', array('jquery'));
wp_enqueue_script( 'slidesinit', get_bloginfo('stylesheet_directory').'/js/home.slide.init.js', array('jquery'));
wp_enqueue_script( 'cufonyui', get_bloginfo('stylesheet_directory').'/js/cufon-yui.js', array('jquery'));
wp_enqueue_script( 'cufonfont', get_bloginfo('stylesheet_directory').'/js/Champagne.font.js', array('jquery'));
wp_enqueue_script( 'tipsy', get_bloginfo('stylesheet_directory').'/js/jquery.tipsy.js', array('jquery')); 
wp_enqueue_script( 'imagehover', get_bloginfo('stylesheet_directory')."/js/image.hover.js", array('jquery'));
wp_enqueue_script( 'zoombox', get_bloginfo('stylesheet_directory').'/js/zoombox.js', array('jquery'));
wp_enqueue_script( 'validate', get_bloginfo('stylesheet_directory').'/js/jquery.validate.min.js', array('jquery'));
wp_enqueue_script( 'verif', get_bloginfo('stylesheet_directory').'/js/verif.js', array('jquery'));
}elseif (is_admin()){
}
}
add_action('init', 'jquery_init');
//Front Page Rename
$get_status=get_option('re_nm');
$get_file_ac=TEMPLATEPATH.'/front-page.php';
$get_file_dl=TEMPLATEPATH.'/front-page-hold.php';
//True Part
if($get_status==='off' && file_exists($get_file_ac)){
rename("$get_file_ac", "$get_file_dl");
}
//False Part
if($get_status==='on' && file_exists($get_file_dl)){
rename("$get_file_dl", "$get_file_ac");
}
?>
