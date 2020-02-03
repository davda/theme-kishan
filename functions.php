<?php
/**
 * Designfly functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Designfly
 */


 
require_once get_parent_theme_file_path( '/better-comments.php' );



if ( ! function_exists( 'designfly_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function designfly_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Designfly, use a find and replace
		 * to change 'designfly' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'designfly', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'designfly' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'designfly_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'designfly_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function designfly_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'designfly_content_width', 640 );
}
add_action( 'after_setup_theme', 'designfly_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function designfly_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'designfly' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'designfly' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'designfly_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function designfly_scripts() {
	wp_enqueue_style( 'designfly-style', get_stylesheet_uri() );

	wp_enqueue_script( 'designfly-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'designfly-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'designfly_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');


function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}



add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 50, 50);




// Register and load the widget
function wpb_load_widget() {
    register_widget( 'wpb_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
 
// Creating the widget 
class wpb_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'wpb_widget', 
 
// Widget name will appear in UI
__('WPBeginner Widget', 'wpb_widget_domain'), 
 
// Widget description
array( 'description' => __( 'Sample widget based on WPBeginner Tutorial', 'wpb_widget_domain' ), ) 
);
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
 
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )





wpb_set_post_views(get_the_ID());

?>
<?php
	if(is_singular())
	{
		?>




													
													






<h1 class="sidebar_h1"> Recent Posts </h1> <hr>
			<?php $the_query = new WP_Query( 'posts_per_page=5' ); ?>
			
			<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
			
			<div>
				<div class="outer_tile_div">
					<div class="image_div_sidebar">
					<?php the_post_thumbnail(); ?>
					</div>
					<div class="post_sidebar_links">
						<div>
                        <a href="<?php the_permalink() ?>" class="red_link">
							<?php the_title(); ?>  </a>
						</div>
						<div>
							by <a href="#" class="red_link"> 
							<?php the_author();   ?> </a> on 
							<a href="#" class="red_link"> 
							<?php echo get_the_date('',get_the_ID()); ?> </a>
						</div>
					</div>
				</div>
			</div>
			
			<?php 
			endwhile;

?>

			<h1 class="sidebar_h1"> Related Posts </h1> <hr>
			<?php
			//for use in the loop, list 5 post titles related to first tag on current post
			
			$post_id_current = get_transient( 'post_id' );
			$tags = wp_get_post_tags($post_id_current);
			if ($tags) {
			$first_tag = $tags[0]->term_id;
			$args=array(
			'tag__in' => array($first_tag),
			'post__not_in' => array($post_id_current),
			'posts_per_page'=>5,

			);
			$my_query = new WP_Query($args);
			if( $my_query->have_posts() ) {
			while ($my_query->have_posts()) : $my_query->the_post(); ?>
					<div>
						<div class="outer_tile_div">
							<div class="image_div_sidebar">
							<?php the_post_thumbnail(); ?>
							</div>
							<div class="post_sidebar_links">
								<div>
									<a href="<?php the_permalink() ?>" class="red_link">
									<?php the_title(); ?>  </a>
								</div>
								<div>
									by <a href="#" class="red_link"> 
									<?php the_author();   ?> </a> on 
									<a href="#" class="red_link"> 
									<?php echo get_the_date('',get_the_ID()); ?> </a>
								</div>
							</div>
						</div>
					</div>
			<?php
			endwhile;
			}
			wp_reset_query();
			}else
			{
				echo '<div class="no_posts_sidebar">No related posts to this article.</div>';
			}
			?>





<?php


			wp_reset_postdata();	}
?>
	<h1 class="sidebar_h1"> Popular Posts </h1> <hr>
	<?php 
	$popularpost = new WP_Query( array( 'posts_per_page' => 4, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
	while ( $popularpost->have_posts() ) : $popularpost->the_post();?>
	<div>
            <div class="outer_tile_div">
                <div class="image_div_sidebar">
				<?php the_post_thumbnail(); ?>
                </div>
                <div class="post_sidebar_links">
                    <div>
                        <a href="<?php the_permalink() ?>" class="red_link">
						<?php the_title(); ?>  </a>
                    </div>
                    <div>
                        by <a href="#" class="red_link"> 
						<?php the_author();   ?> </a> on 
						<a href="#" class="red_link"> 
						<?php echo get_the_date('',get_the_ID()); ?> </a>
                    </div>
                </div>
            </div>
		</div>
		
		<?php
	/* echo wpb_get_post_views(get_the_ID());
	echo "<br>"; */
	endwhile;?>
	 </div>
			<?php
}
         
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'wpb_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class wpb_widget ends here


/* //Read More //
function new_excerpt_more($more) {
	global $post;
	return '… <a href="'. get_permalink($post->ID) . '">' . 'Read More &raquo;' . '</a>';
	}
	add_filter('excerpt_more', 'new_excerpt_more');  */


	function wpb_widgets_init() {
 
		register_sidebar( array(
			'name' => __( 'Main Sidebar', 'wpb' ),
			'id' => 'sidebar-1',
			'description' => __( 'The main sidebar appears on the right on each page except the front page template', 'wpb' ),
			'before_widget' => '<div class="main_sidebarr">',
			'after_widget' => '</div>',
			'before_title' => '',
			'after_title' => '',
		) );
		}
	 
	add_action( 'widgets_init', 'wpb_widgets_init' );





	function portfolio_post_type() {

		$labels = array(
			'name'               => 'Portfolio',
			'singular_name'      => 'Portfolio',
		);
	
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'rewrite'            => array( 'slug' => 'portfolio' ),
			'has_archive'        => true
		);
	
		register_post_type( 'portfolio', $args );
	
	}
	add_action( 'init', 'portfolio_post_type' );

/* 
	add_filter('comment_form_fields', 'custom_fields');
	function custom_fields($fields) {
	
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : ’ );
	
		unset( $fields['comment'] ); 

		$fields[ 'comment' ] = '<p class="comment-form-author">'.'<label for="comment">Post Your Comment</label>'.
		  ( $req ? '' : ’ ).
		  '<input id="comment" name="comment" type="textarea" tabindex="1"' . $aria_req . ' /></p>';

		$fields[ 'author' ] = '<p class="comment-form-author">'.
		  '<label for="author">Nameeeee</label>'.
		  ( $req ? '' : ’ ).
		  '<input id="author" name="author" type="text" value="'. esc_attr( $commenter['comment_author'] ) .
		  '" size="30" tabindex="1"' . $aria_req . ' /></p>';
	
		$fields[ 'email' ] = '<p class="comment-form-email">'.
		  '<label for="email">Email</label>'.
		  ( $req ? '' : ’ ).
		  '<input id="email" name="email" type="text" value="'. esc_attr( $commenter['comment_author_email'] ) .
		  '" size="30"  tabindex="2"' . $aria_req . ' /></p>';
	
		$fields[ 'url' ] = '<p class="comment-form-url">'.
		  '<label for="url">Website</label>'.
		  '<input id="url" name="url" type="text" value="'. esc_attr( $commenter['comment_author_url'] ) .
		  '" size="30"  tabindex="3" /></p>';
	
	  return $fields;
	} */






	// Modify comments header text in comments
add_filter( 'genesis_title_comments', 'child_title_comments');
function child_title_comments() {
    return __(comments_number( '<h3>No Responses</h3>', '<h3>1 Response</h3>', '<h3>% Responses...</h3>' ), 'genesis');
}
 
// Unset URL from comment form
function crunchify_move_comment_form_below( $fields ) { 
	


	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : ’ );

	
	unset( $fields['comment'] ); 
	unset($fields['cookies']);
	unset($fields['author']);
	unset($fields['email']);
	unset($fields['url']);
	$fields['comment'] = 
		'<label for="comment">Post Your Comment</label><textarea id="comment" name="comment" rows="8" aria-required="true"></textarea>';
	$fields['author'] = '<div class="input_below"> <div class="comment_input_fields1"><label for="author">Name</label><input class="inputt"  id="author"  name="author" type="text" value="' .
                esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div> ' ;
    $fields['email'] = '<div class="comment_input_fields2"><label for="email">Email</label><input  class="inputt" id="email"  name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30"' . $aria_req . ' /></div> ';
    $fields['url'] = '<div class="comment_input_fields3"><label for="url">Website</label><input class="inputt" id="url" name="url"  type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div>';

			   
    return $fields; 
} 
add_filter( 'comment_form_fields', 'crunchify_move_comment_form_below' ); 
 
// Add placeholder for Name and Email
function modify_comment_form_fields($fields){
	

		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : ’ );
		unset($fields['title_reply_to']);
/* 
		unset($fields['comment-notes']);
		$fields['title_reply'] = '';
	$fields['comment-notes'] = '';
	$fields['comment_notes_after'] = ''; */
    
    return $fields;
}
add_filter('comment_form_default_fields','modify_comment_form_fields');





 function include_thickbox_scripts()
{
    wp_enqueue_script('thickbox', null, array('jquery'));
    wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
}
add_action('wp_enqueue_scripts', 'include_thickbox_scripts');