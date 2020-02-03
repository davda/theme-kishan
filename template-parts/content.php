<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Designfly
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="content_single_post">

	<header class="entry-header">
		<?php
		if ( is_singular() ) :
													the_title( '<h1 class="single_post_title">', '</h1>' );

													
												global $post;
												if ( 'post' === get_post_type() ) :
													?>
													<div class="entry-meta">
														<div style="width:100%;">
															<div style="width:70%;float:left;" >
																<?php
																echo 'by <a href="#" class="red_link"> '.get_the_author(  ).'</a>';
																echo ' on '. get_the_date('',get_the_ID());
																?>
															</div>
															<div align="right" style="width:30%;float:right;color:#ef4634;">
																<?php
																echo get_comments_number(get_the_ID())." Comments";
																?>
															</div>
															<hr style="width:100%;float:left;">
															<div style="width:100%;float:left">
																<?php echo get_the_content( );?>
																
															</div>
														</div>
													</div><!-- .entry-meta -->
													
												<?php endif; ?>
											</header><!-- .entry-header -->
										</article>


										<?php
		elseif(get_queried_object_id() == 25) : ///// for loop page 
										?>
										<div class="loop_title_head">
										<div class="loop_date_div">
											<p style="font-size:25px;margin:0px;padding:0px;">  
												<?php echo get_the_date( 'j' ); ?> 
											</p>
											<p style="font-size:14px;margin:0px;padding:0px;">  
												<?php echo get_the_date( 'M' ); ?> 
											</p>
										</div>
										<?php
										the_title( '<div class="loop_title_div"><h1 class="" ><a style="font-size:20px;color:white;text-decoration:none;margin-left:10px;" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1></div>' );
										?>
										</div>
										<div class="post_details">
											<div class="post_detail_thumbnail">
												<?php 
													set_post_thumbnail_size( 150, 150);
													the_post_thumbnail(); 
													set_post_thumbnail_size( 50, 50);
												?>
											</div>
											<div class="post_detail_description">
														<?php
															//set_post_thumbnail_size( 400, 220);
															//the_post_thumbnail( $size );
														global $post;
														if ( 'post' === get_post_type() ) :
															?>
															<div class="entry-meta">
																<div style="width:100%;">
																	<div style="width:70%;float:left;" >
																		<?php
																		echo 'by <a href="#" class="red_link"> '.get_the_author(  ).'</a>';
																		echo ' on '. get_the_date('',get_the_ID());
																		?>
																	</div>
																	<div align="right" style="width:30%;float:right;color:#ef4634;">
																		<?php
																		echo get_comments_number(get_the_ID())." Comments";
																		?>
																	</div>
																	<hr style="width:100%;float:left;">
																	<div style="width:100%;float:left">
																		<?php 
																			//echo get_the_content( 'READ MORE ', false,get_the_ID(  )); 
																			$content = get_the_content();
																			$content = preg_replace('/(<)([img])(\w+)([^>]*>)/', "", $content);
																			$content = apply_filters('the_content', $content);
																			$content = str_replace(']]>', ']]&gt;', $content);
																			echo $content;
																		?>
																	</div>
																</div>
															</div><!-- .entry-meta -->
											</div>	
										</div>
									<?php endif; ?>

									</header><!-- .entry-header -->
								<?php
		endif;

		if(get_the_ID(  ) == 170)    // for portfolio page
		{?>





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
														designfly_posted_on();
														designfly_posted_by();
														?>
													</div><!-- .entry-meta -->
												<?php endif; ?>
											</header><!-- .entry-header -->

											<?php designfly_post_thumbnail(); ?>


									<div class="entry-content">
											<?php
											the_content( sprintf(
												wp_kses(
													/* translators: %s: Name of current post. Only visible to screen readers */
													__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'designfly' ),
													array(
														'span' => array(
															'class' => array(),
														),
													)
												),
												get_the_title()
											) );

											wp_link_pages( array(
												'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'designfly' ),
												'after'  => '</div>',
											) );
											?>
										</div><!-- .entry-content -->






		<?php
		}?>
	
		
	
	
			<?php 
				if(get_queried_object_id() != 25)
					designfly_entry_footer(); 
			?>
	</div>