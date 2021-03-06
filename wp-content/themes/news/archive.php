<?php
/**
 * Archive Template
 *
 * The archive template is a placeholder for archives views without a more specific template. 
 *
 * @package News
 * @subpackage Template
 */

get_header(); ?>

	<?php do_atomic( 'before_content' ); // Before content hook ?>

	<div id="content">

		<?php do_atomic( 'open_content' ); // Open content hook ?>

		<div class="hfeed">

			<?php get_template_part( 'loop-meta' ); // Get the loop meta box ?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_atomic( 'before_entry' ); // Before loop hook ?>

					<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

						<?php do_atomic( 'open_entry' ); // Open loop hook ?>

						<?php get_the_image( array( 'meta_key' => array( 'Thumbnail' ), 'size' => 'news-thumbnail' ) ); ?>

						<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>

						<?php echo apply_atomic_shortcode( 'byline', '<div class="byline">[entry-published] [entry-comments-link] [entry-popup-shortlink] [entry-edit-link before=" | "]</div>' ); ?>

						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->

						<?php do_atomic( 'close_entry' ); // Close loop hook ?>

					</div><!-- .hentry -->

					<?php do_atomic( 'after_entry' ); // After loop hook ?>

				<?php endwhile; ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // Close content hook ?>

		<?php get_template_part( 'loop-nav' ); ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // After content hook ?>

<?php get_footer(); ?>