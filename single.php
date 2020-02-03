<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Designfly
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				
				?>
				<div class="content_single_post">
					<?php comments_template(); ?>
				</div>
				<?php
			endif;

		endwhile; // End of the loop.
		?>

				<?php
				//for use in the loop, list 5 post titles related to first tag on current post
				set_transient( 'post_id', $post->ID );
				?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
