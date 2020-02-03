<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Designfly
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments_area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<hr>
		<h2 class="comments_title">
			<?php
				$designfly_comment_count = get_comments_number();
			?>
			Comments
		</h2><!-- .comments-title -->
		<hr>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'avatar_size' => 0,
				'callback' => 'better_comments'
			) );
/* 
			$args = array(
				'post_id' => get_the_ID(),   // Use post_id, not post_ID
					'count'   => true // Return only the count
			);
			$comments_count = get_comments( $args );
			echo $comments_count; */

			/* $comments = get_comments( array( 'post_id' => get_the_ID(  ) ) );
			
			foreach ( $comments as $comment ) :
				echo "<br>".$comment->comment_author;
				echo "<br>".$comment->comment_content;
				echo "<br><br><br>";
			endforeach; */

			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'designfly' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().
?>
	<hr style="width:100%;float:left;margin-top:20px;"> 
	<?php
	comment_form();

	?>

</div><!-- #comments -->
