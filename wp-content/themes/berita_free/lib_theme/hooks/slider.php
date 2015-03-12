<?php 

add_action( 'bizz_slider', 'bizz_slider_area' );

function bizz_slider_area() {

?>

<?php 
		if ($GLOBALS['optd']['bizzthemes_slid_nxt'] <> '')
		    $nxt_img = $GLOBALS['optd']['bizzthemes_slid_nxt'];
		else
		    $nxt_img = BIZZ_THEME_IMAGES .'/arr-right-trans.png';
		if ($GLOBALS['optd']['bizzthemes_slid_prev'] <> '')
		    $prev_img = $GLOBALS['optd']['bizzthemes_slid_prev'];
		else
		    $prev_img = BIZZ_THEME_IMAGES .'/arr-left-trans.png';
?>

<?php bizz_slider_before(); ?>

<div class="slider-area clearfix">
<div class="container_16">
<div id="loopedSlider" class="clearfix">
    <div class="grid_2 prev" style="padding-top: <?php echo stripslashes($GLOBALS['opt']['bizzthemes_sliderb_height']); ?>px">
		<a href="#" class="previous"><img src="<?php echo $prev_img; ?>" alt="Back" /></a> 
	</div>
    <div class="grid_12">
	    <div class="container" style="height:<?php echo stripslashes($GLOBALS['opt']['bizzthemes_slider_height']); ?>px;">
		<div class="slides">
<?php 
			$sliderpages = get_inc_att("slider_pag");
			$sliderarray=split(",",$sliderpages);
			$sliderarray = array_diff($sliderarray, array(""));
			$count = 0;
			foreach ( $sliderarray as $key => $slideritem ) {
			    $islide = get_posts('post_type=page&include='.$slideritem.'');
				foreach ($islide as $pst) {
				setup_postdata($pst);
				$count++;
?>
				    <div id="slide-<?php echo $count; ?>" class="slide">
					    <div class="format_text">
						<div class="fix"></div>
						<?php the_content(); ?>
						<div class="fix"></div>
					    </div><!-- /.format_text -->
					</div><!-- /.slide -->
<?php					
				}
			}
?>
		</div><!-- /.slides -->
		</div><!-- /.container -->	
	</div><!-- /.grid_12 -->
	<div class="grid_2 nxt" style="padding-top: <?php echo stripslashes($GLOBALS['opt']['bizzthemes_sliderb_height']); ?>px">
		<a href="#" class="next"><img src="<?php echo $nxt_img; ?>" alt="Forward" /></a> 
	</div>
</div><!-- /#loopedSlider -->
</div><!-- /.container_16 -->
</div><!-- /.slider-area -->

<?php wp_reset_query(); ?>

<?php bizz_slider_after(); ?>

<?php } ?>