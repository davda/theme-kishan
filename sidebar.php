<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Designfly
 */
?>
</div><!-- #content -->
<?php
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<?php
    
    if( get_the_ID(  ) != 170)
    {

    
    
 if ( is_active_sidebar( 'sidebar-1' ) ) :
    ?>
        <div class="main_sidebar">
            <?php
            dynamic_sidebar( 'sidebar-1' );  
            ?>
        </div>
    <?php
 endif;
}
?>
