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
 * @package Designfly
 */

get_header();
?>

	<div id="primary" class="content-area">
	
		<main id="main" class="site-main">
		<div class="wrapper">
		<?php
		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text">LET'S BLOG</h1><hr>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				
				the_post();

				
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				
				 get_template_part( 'template-parts/content', get_post_type() );
				 
				 
				 
				add_filter( 'the_content_more_link', 'modify_read_more_linkk' );
				
				
				
					
			endwhile;
			

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
		<div class="pagination">
			<?php echo paginate_links( $args = array(

				'show_all' => true,
				'prev_next' => false
			)
				
			);?>
		</div>

		
		



		
			
		</main><!-- #main -->
	</div>
	</div><!-- #primary -->


	<?php get_sidebar();?>

<?php
get_footer();

function modify_read_more_linkk() {
	return '<a class="more-link" href="' . get_permalink() . '">Read More</a>';
}