<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" /><link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script src="<?php bloginfo('stylesheet_directory') ?>/scripts/latest.js" type="text/javascript"></script>
<script src="<?php bloginfo('stylesheet_directory') ?>/scripts/menu.js" type="text/javascript"></script>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body>
<div id="page">

<div id="top"></div>
<div id="header">
	<div id="headerimg">
		<?php if (is_front_page()) { ?> 
     <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
 
<?php } else { ?> 
      <a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a>
 
<?php } ?>		<div class="description"><?php bloginfo('description'); ?></div>
	</div>
</div>
	<div class="clear whitespace"> </div>