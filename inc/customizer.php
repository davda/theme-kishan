<?php
/**
 * Designfly Theme Customizer
 *
 * @package Designfly
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function designfly_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'designfly_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'designfly_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'designfly_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function designfly_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function designfly_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function designfly_customize_preview_js() {
	wp_enqueue_script( 'designfly-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'designfly_customize_preview_js' );
function starter_customize_register( $wp_customize ) 
{
    $wp_customize->add_section( 'starter_new_section_name' , array(
        'title'    => __( 'Visible Section Name', 'starter' ),
        'priority' => 30
    ) );   

    $wp_customize->add_setting( 'starter_new_setting_name' , array(
        'default'   => '#555555',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
        'label'    => __( 'Header Colorrrrrr', 'starter' ),
        'section'  => 'starter_new_section_name',
        'settings' => 'starter_new_setting_name',
    ) ) );
}
add_action( 'customize_register', 'starter_customize_register');