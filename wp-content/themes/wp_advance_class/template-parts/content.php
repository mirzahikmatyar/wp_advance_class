<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_Advance_Class
 */

?>
<?php
$post_class = "col-md-12";
if ( ! is_singular() ){
	$post_class = "col-md-6 col-lg-4";
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				wp_advance_class_posted_on();
				wp_advance_class_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php wp_advance_class_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		if ( !is_singular() ){
			the_excerpt();
		} else {
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wp_advance_class' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp_advance_class' ),
				'after'  => '</div>',
			)
		);
		}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php wp_advance_class_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
