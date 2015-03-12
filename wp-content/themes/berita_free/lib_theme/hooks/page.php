<?php 

add_action( 'bizz_page', 'bizz_page_area' );

add_action( 'bizz_headline_p_inside', 'bizz_headline' );
add_action( 'bizz_breadcrumb_p_inside', 'bizz_breadcrumb' );
add_action( 'comments_template_p_inside', 'comments_template' );
add_action( 'bizz_404_error_inside', 'bizz_404_error' );

function bizz_page_area() { 

?>

<?php bizz_page_before(); ?>

<div class="content-area clearfix">
<div class="container_12">
	
	<?php if ( $GLOBALS['opt']['bizzthemes_sidebar_align'] != 'alignright' ) { bizz_sidebar(); } ?>
		
	<div class="grid_8">
		
		<div class="front">
		
		    <?php if ( $GLOBALS['opt']['bizzthemes_breadcrumbs'] == 'true') { ?>
			    <?php bizz_breadcrumb_p_inside(); ?>
			<?php } ?>
			
			<?php bizz_headline_p_inside(); ?>
			
		    <?php if (have_posts()) : $count = 0; ?>
			<?php while (have_posts()) : the_post(); $postcount++;?>
				
				<div class="single sing clearfix">
					<div class="format_text">
					    <?php the_content(); ?>
					</div><!-- /.format_text -->
				</div><!-- /.single -->
				
			<?php endwhile; else: ?>
			
                <div class="single clearfix">
				    <?php bizz_404_error_inside(); ?>
				</div><!-- /.single -->
				
			<?php endif; ?>
						
		</div><!--/.front-->
		
		<?php if (comments_open() && $GLOBALS['opt']['bizzthemes_comments_pag']=='true') : ?>
		    <?php comments_template_p_inside(); ?>
	    <?php endif; ?>

	</div><!--/.grid_8-->
		
	<?php if ( $GLOBALS['opt']['bizzthemes_sidebar_align'] == 'alignright' ) { bizz_sidebar(); } ?>
		        
</div><!--/.container_12-->
</div><!-- /.content-area -->
		
<?php bizz_page_after(); ?>
		
<?php } ?>