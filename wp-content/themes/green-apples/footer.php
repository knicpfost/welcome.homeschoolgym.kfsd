

</div> <!-- end #page  -->
<div class="clear whitespace"> </div><div id="footer"><!-- If you'd like to support WordPress, having the "powered by" link somewhere on your blog is the best way; it's our only promotion or advertising. -->
<p>
		<a href="http://wordpress.org/">Powered by WordPress</a> | <a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a> | <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a>
		<!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->
		<!-- optional link to RoseCityGardens.com -->
| <a href="http://rosecitygardens.com" title="free WordPress themes">Green Apple WordPress&trade; Theme by RoseCityGardens.com</a></p></div>
<div id="absnav">
<ul id="nav"><?php wp_list_pages('sort=menu_order&depth=3&title_li='); ?></ul>
</div>
<?php wp_footer(); ?>
</body>
</html>