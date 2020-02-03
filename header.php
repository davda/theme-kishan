<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Designfly
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11"><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="main_header" id="mainheader">

	<header>
		<!-- <div class="wrapper"> -->
		<div class="main_logo"  id="mainn_logo">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<?php
			else :
				?>
				<?php
			endif;
			$designfly_description = get_bloginfo( 'description', 'display' );
			if ( $designfly_description || is_customize_preview() ) :
				?>
				<p><?php echo $designfly_description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->
		<div class="main_menu" id="mainn_menu">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>



			</div><!-- #site-navigation -->
	

		<div class="main_search"  id="mainn_search">		
			<input type="text"/>
			
  <button type="submit" class="icon"><i class="fa fa-search"></i></button>
		</div>
		</div>
		</div>
		
		<?php
			
			if(is_front_page()){
				
				echo '<div class="container">';
					echo '<center style="background-color:#e73d2d;"><img id="myImage"  src="http://two.wordpress.test/wp-content/uploads/2019/12/slider-image-e1578147139817.png" alt="SS" width="544px" height="544px"/></center>';
					echo '<div class="arrowl"> <img onclick = "changep()" src="http://two.wordpress.test/wp-content/uploads/2020/01/slider-arrows-2.png" alt="left arrow" /> </div>';
					echo '<div class="arrowr"> <img onclick = "changep()" src="http://two.wordpress.test/wp-content/uploads/2020/01/slider-arrows-3.png" alt="right arrow" /> </div>';
					echo '<div class="stitle">Gearing up the ideas</div>';
					echo '<div class="subtt">It is highly recommended that you make all the theme customization options available in the WordPress Customizer itself so that normal users who don’t have much technical knowledge can find those settings easily.</div>';
					
				echo '</div>';
			}
			
		?>
		
	<div class="featurebg">
			<div class="strip1">
				<div class="div_inner_strip">
					<div class="strip_logo">
						<img src="http://two.wordpress.test/wp-content/uploads/2020/01/feature-icons.png" alt="image" />
					</div>
					<div class="strip_details">
						<a href="#">Advertising</a><p>Advertising is great and best for marketing.</p>
					</div>
				</div>
			</div>
			<div class="strip2">
				<div class="div_inner_strip">
					<div class="strip_logo">
						<img src="http://two.wordpress.test/wp-content/uploads/2020/01/feature-icons-1.png" alt="image" />
					</div>
					<div class="strip_details">
						<a href="#">Multimedia</a><p>Multimedia can be used for advertising in marketing.</p>
					</div>
				</div>
			</div>
			<div class="strip3">
				<div class="div_inner_strip">
					<div class="strip_logo">
						<img src="http://two.wordpress.test/wp-content/uploads/2020/01/feature-icons-2.png" alt="image" />
					</div>
					<div class="strip_details">	
						<a href="#">Photography</a><p>By photography you can create Multimedia.</p>
					</div>
				</div>
			</div>
	</div>
		
	</header><!-- #masthead -->
	<div id="content" class="main_content">
			<?php 
			$ab = 24;
		if (   is_front_page() or get_the_ID() == 24 or get_the_ID() == 170) {
			?>
	<script>
						document.getElementById('content').style.width = "66%";
						document.getElementById('content').style.padding = "2%";

	</script>
		<?php } ?>
	<script>
            var image =  document.getElementById("myImage");

            function changep()
            {
                if (image.getAttribute('src') == "http://two.wordpress.test/wp-content/uploads/2019/12/slider-image-e1578147139817.png")
                {
                    image.src = "http://two.wordpress.test/wp-content/uploads/2019/12/image-5.png";
                }
                else
                {
                    image.src = "http://two.wordpress.test/wp-content/uploads/2019/12/slider-image-e1578147139817.png";
                }
            }
	</script>
	