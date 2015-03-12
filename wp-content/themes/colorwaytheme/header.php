<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	wp_title( '|', true, 'right' );
	// Add the blog name.
	bloginfo( 'name' );
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'cloriato' ), max( $paged, $page ) );
	?>
</title>
<?php
if(is_page_template( 'home-template.php' )){?>
<?php if(get_option('colorway_keyword')!=''){ ?>
<meta name="keywords" content="<?php echo get_option('colorway_keyword'); ?>" />
<?php } else{}?>
<?php if(get_option('colorway_description')!=''){ ?>
<meta name="description" content="<?php echo get_option('colorway_description'); ?>" /> 
<?php } else{}?>
<?php if(get_option('colorway_author')!=''){ ?>
<meta name="author" content="<?php echo get_option('colorway_author'); ?>" />
<?php } else{}?>
<?php }?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/text.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/960_24_col.css" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ddsmoothmenu.css" type="text/css" media="all"/>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/<?php echo get_option('colorway_altstylesheet'); ?>.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/zoombox.css" media="screen" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<!--[if gte IE 9]>
<script type="text/javascript">
Cufon.set('engine', 'canvas');
</script>
<![endif]-->
<script type="text/javascript">
	Cufon.replace('h1')('h2')('h3')('h4')('h5')('h6');
	
  $(function() {    
    $('.social_logo a').tipsy();
  }); 
  
  $(function() { 
    $('a.zoombox').zoombox();
});
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60456417-1', 'auto');
  ga('send', 'pageview');
</script>
</head>
<body background="<?php if(get_option('inkthemes_bodybg')!='')
{ echo get_option('inkthemes_bodybg');} 
else {?>
<?php bloginfo('template_url'); ?>/images/body-bg.png
<?php }?>" <?php body_class(); ?>>
<!--Start Container Div-->
<div class="container_24 container">
<!--Start Header Grid-->
<div class="grid_24 header">
     <div class="logo"> <a href="<?php bloginfo( 'url' ); ?>"><img src="<?php if ( get_option('colorway_logo') !='' ) {?><?php echo get_option('colorway_logo'); ?><?php } else {?><?php bloginfo('template_url'); ?>/images/logo.png<?php }?>" alt="<?php bloginfo('name'); ?>" /></a> </div>
     <!--Start MenuBar-->
     <div class="menu-bar">
          <div id="MainNav">
               <?php inkthemes_nav(); ?>
          </div>
     </div>
     <!--End MenuBar-->
</div>
<div class="clear"></div>
<!--End Header Grid-->
