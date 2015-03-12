<?php 

add_action( 'bizz_page_404', 'bizz_page_404_area' );

add_action( 'bizz_404_error_inside', 'bizz_404_error' );

function bizz_page_404_area() { 

?>

<?php bizz_page_404_before(); ?>

<div class="content-area clearfix">
<div class="container_12">
	
	<?php if ( $GLOBALS['opt']['bizzthemes_sidebar_align'] != 'alignright' ) { bizz_sidebar(); } ?>
		
	<div class="grid_8">
		
		<div class="front">
					
			<?php bizz_headline(); ?>
				
				<div class="single sing clearfix">
				    <?php bizz_404_error_inside(); ?>
				</div><!-- /.single -->
						
		</div><!--/.front-->

	</div><!--/.grid_8-->
		
	<?php if ( $GLOBALS['opt']['bizzthemes_sidebar_align'] == 'alignright' ) { bizz_sidebar(); } ?>
		        
</div><!--/.container_12-->
</div><!-- /.centent-area -->

<?php bizz_page_404_after(); ?>
		
<?php } ?>