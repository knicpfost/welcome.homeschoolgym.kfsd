<?php 

add_action( 'bizz_sidebar', 'bizz_sidebar_area' );

function bizz_sidebar_area() { 

?>

<?php bizz_sidebar_before(); ?>

<div class="grid_4">
	<div class="sidebar <?php if ( $GLOBALS['opt']['bizzthemes_sidebar_align'] == 'alignleft' ) { ?>sidebar-left<?php } ?>">
	<?php 
	if ( ( function_exists('dynamic_sidebar') && (is_sidebar_active(1)) ) ) :
	    dynamic_sidebar(1);
	endif; 
	?>
	</div><!-- /sidebar -->
</div><!--/grid_4-->

<?php bizz_sidebar_after(); ?>

<?php }

add_action( 'bizz_widgets', 'bizz_widgets_area' );

function bizz_widgets_area() { 

?>

<?php bizz_widgets_before(); ?>

    <?php if (function_exists('dynamic_sidebar') && (is_sidebar_active(2) || is_sidebar_active(3) || is_sidebar_active(4)) ) { ?>
	    <div class="grid_4"><?php dynamic_sidebar(2); ?></div>
		<div class="grid_4"><?php dynamic_sidebar(3); ?></div>
	    <div class="grid_4 last"><?php dynamic_sidebar(4); ?></div>
	<?php } ?>

<?php bizz_widgets_after(); ?>

<?php } ?>