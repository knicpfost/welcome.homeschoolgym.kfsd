<!--Start Footer container-->
<div class="container_24 footer-container">
     <div class="grid_24 footer">
          <?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>
     </div>
     <div class="clear"></div>
</div>
<!--End footer container-->
<!--Start footer navigation-->
<div class="container_24 footer-navi">
     <div class="grid_24">
          <div class="navigation">
               <ul>
                    <li><a href="<?php echo home_url(); ?>"><?php echo get_bloginfo('name'); ?> - <?php echo get_bloginfo('description'); ?></a></li>
               </ul>
               <div class="right-navi">
					<?php if ( get_option('colorway_facebook') !='' ) {?>
                    <a href="<?php echo get_option('colorway_facebook'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook-icon.png" alt="facebook" title="facebook"/></a>
                    <?php } else {?>
                    <?php }?>
                    <?php if ( get_option('colorway_twitter') !='' ) {?>
                    <a href="<?php echo get_option('colorway_twitter'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter-icon.png" alt="twitter" title="Twitter"/></a>
                    <?php } else {?>
                    <?php }?>
                    <?php if ( get_option('colorway_rss') !='' ) {?>
                    <a href="<?php echo get_option('colorway_rss'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/rss-icon.png" alt="rss" title="rss"/></a>
                    <?php } else {?>
                    <?php }?>

                    <?php if ( get_option('footer_text') !='' ) {?>
                    <p><?php echo get_option('footer_text'); ?>
                    <?php } else {?>
					<p><a href="http://www.inkthemes.com">Designed &amp; Coded by InkThemes.com</a></p>
                    <?php }?>					
					
					
                    
               </div>
          </div>
     </div>
     <div class="clear"></div>
</div>
<!--End Footer navigation-->
<?php wp_footer(); ?>
</body></html>