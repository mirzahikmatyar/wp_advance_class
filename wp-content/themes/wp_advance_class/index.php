<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WPAdvanceClass
 */

get_header();
?>
	<div class="container mt-2">
		<main id="primary" class="site-main">

			<?php
			if ( have_posts() ) :
			?>

				<div class="row">

				<?php
				if ( is_home() && ! is_front_page() ) :
					?>
					<header>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header>
					<?php
				endif;

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					
					if ( is_sticky() ){
						get_template_part( 'template-parts/content', 'sticky' );
					} else {
						get_template_part( 'template-parts/content', get_post_type() );
					}

				endwhile;
				?>
			</div>

			<?php
				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</main><!-- #main -->
	</div>
<?php
get_footer();
