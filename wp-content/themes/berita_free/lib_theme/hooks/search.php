<?php 

add_action( 'bizz_search', 'bizz_search_area' );

add_action( 'bizz_headline_se_inside', 'bizz_headline' );
add_action( 'bizz_breadcrumb_se_inside', 'bizz_breadcrumb' );
add_action( 'bizz_wp_pagenavi_se_top', 'bizz_wp_pagenavi' );
add_action( 'bizz_wp_pagenavi_se_bottom', 'bizz_wp_pagenavi' );
add_action( 'bizz_subheadline_se_inside', 'bizz_subheadline' );
add_action( 'bizz_post_meta_se_inside', 'bizz_post_meta' );
add_action( 'bizz_404_error_inside', 'bizz_404_error' );

function bizz_search_area() { 

?>

<?php if (is_paged()) $is_paged = true; ?>

<?php bizz_search_before(); ?>

<div class="content-area clearfix">
<div class="container_12">
	
	<?php if ( $GLOBALS['opt']['bizzthemes_sidebar_align'] != 'alignright' ) { bizz_sidebar(); } ?>
		
	<div class="grid_8">
	<div class="front">
	
	    <?php if (function_exists('bizz_wp_pagenavi') && is_paged()) { ?>
		    <div class="lpagination clearfix">
		        <?php bizz_wp_pagenavi_se_top(); ?>
		    </div>
        <?php } ?>
		
		    <?php if ( $GLOBALS['opt']['bizzthemes_breadcrumbs'] == 'true') { ?>
			    <?php bizz_breadcrumb_se_inside(); ?>
			<?php } ?>
			
			<?php bizz_headline_se_inside(); ?>
			
		    <?php if (have_posts()) : $count = 0; ?>
			<?php while (have_posts()) : the_post(); $postcount++;?>
				
				<div class="single clearfix">
				    <div class="headline">
					    <?php bizz_subheadline_se_inside(); ?>
				        <?php bizz_post_meta_se_inside(); ?>
					</div><!-- /.headline -->
					<?php if ($GLOBALS['opt']['bizzthemes_thumb_show'] == 'true') {
							bizz_get_image('image',$GLOBALS['opt']['bizzthemes_thumb_width'],$GLOBALS['opt']['bizzthemes_thumb_height'],'thumbnail '.$GLOBALS['opt']['bizzthemes_thumb_align']);
					} ?> 
					<div class="format_text">
					    <?php if ( $GLOBALS['opt']['bizzthemes_archive_full'] == 'true' ) { ?>
							<?php the_content(__(''.stripslashes($GLOBALS['opt']['bizzthemes_readmore_text']).'')); ?>
                        <?php } else { ?>
							<?php the_excerpt(); ?>
							<?php if ( $GLOBALS['opt']['bizzthemes_readmore'] == 'true' ) { ?>
							    <span class="read-more"><a rel="nofollow" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php echo stripslashes($GLOBALS['opt']['bizzthemes_readmore_text']); ?></a></span>
                            <?php } ?>
						<?php } ?>
					</div><!-- /.format_text -->
				</div><!-- /.single -->
				
			<?php endwhile; else: ?>
			
                <div class="single clearfix">
				    <?php bizz_404_error_inside(); ?>
				</div><!-- /.single -->
				
			<?php endif; ?>
			
		<?php if (function_exists('bizz_wp_pagenavi')) { ?>
	        <div class="fix"><!----></div>
		    <div class="lpagination fpagination clearfix">
		        <?php bizz_wp_pagenavi_se_bottom(); ?>
		    </div>
        <?php } ?>
						
	</div><!--/.front-->
	</div><!--/.grid_8-->
		
	<?php if ( $GLOBALS['opt']['bizzthemes_sidebar_align'] == 'alignright' ) { bizz_sidebar(); } ?>
		        
</div><!--/.container_12-->
</div><!-- /.centent-area -->

<?php bizz_search_after(); ?>
		
<?php } ?>