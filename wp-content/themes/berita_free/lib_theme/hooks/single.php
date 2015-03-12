<?php 

add_action( 'bizz_single', 'bizz_single_area' );

add_action( 'bizz_headline_si_inside', 'bizz_headline' );
add_action( 'bizz_post_meta_si_inside', 'bizz_post_meta' );
add_action( 'bizz_breadcrumb_si_inside', 'bizz_breadcrumb' );
add_action( 'comments_template_si_inside', 'comments_template' );
add_action( 'bizz_404_error_inside', 'bizz_404_error' );

function bizz_single_area() { 

?>

<?php bizz_single_before(); ?>

<div class="content-area clearfix">
<div class="container_12">
	
	<?php if ( $GLOBALS['opt']['bizzthemes_sidebar_align'] != 'alignright' ) { bizz_sidebar(); } ?>
		
	<div class="grid_8">
	<div class="front">
					
			<?php if ( $GLOBALS['opt']['bizzthemes_breadcrumbs'] == 'true') { ?>
			    <?php bizz_breadcrumb_si_inside(); ?>
			<?php } ?>
			
			<?php bizz_headline_si_inside(); ?>
			
		    <?php if (have_posts()) : $count = 0; ?>
			<?php while (have_posts()) : the_post(); $postcount++;?>
				
				<div class="single sing clearfix">
				    <div class="headline">
					    <?php bizz_post_meta_si_inside(); ?>
					</div><!-- /.headline -->
				    <?php if ($GLOBALS['opt']['bizzthemes_thumb_show'] == 'true' && $GLOBALS['opt']['bizzthemes_image_single'] == 'true') {
						bizz_get_image('image',$GLOBALS['opt']['bizzthemes_single_width'],$GLOBALS['opt']['bizzthemes_single_height'],'thumbnail '.$GLOBALS['opt']['bizzthemes_single_align']);
				    } ?>
				    <div class="format_text">
				        <?php the_content(); ?>
					    <p class="meta">
					        <?php seo_post_tags(); ?>
					        <?php seo_post_cats(); ?>
					    </p>
				    </div><!-- /.format_text -->
				</div><!-- /.single -->
				
			<?php endwhile; else: ?>
			
                <div class="single clearfix">
				    <?php bizz_404_error_inside(); ?>
				</div><!-- /.single -->
				
			<?php endif; ?>
						
	</div><!--/.front-->
	
	<?php comments_template_si_inside(); ?>
	
	</div><!--/.grid_8-->
		
	<?php if ( $GLOBALS['opt']['bizzthemes_sidebar_align'] == 'alignright' ) { bizz_sidebar(); } ?>
		        
</div><!--/.container_12-->
</div><!-- /.centent-area -->

<?php bizz_single_after(); ?>
		
<?php } ?>