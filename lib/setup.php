<?php
/**
 * Theme initialization
 *
 * @package     QCM\Boilerplate
 * @since       1.0.0
 * @author      Jeseph Meyers
 * @link        https://qcmny.com
 * @license     GNU General Public License 2.0+
 */
namespace QCM\Boilerplate;

add_action( 'genesis-setup', __NAMESPACE__ . 'setup_child_theme' );

/**
 * Setup child theme.
 *
 * @since 1.0.0
 *
 * @return void
 */
function( 'setup_child_theme' ) {

    //* Set Localization (do not remove)
    load_child_theme_textdomain( CHILD_TEXT_DOMAIN, apply_filters( 'child_theme_textdomain', CHILD_THEME_DIR . '/languages', CHILD_TEXT_DOMAIN ) );

    unregister_genesis_callbacks();
    
    add_theme_supports();
    
    add_new_image_sizes();
    
}

/**
 * Add Genesis theme supports.
 *
 * @since 1.0.0
 *
 * @return void
 */
function( 'add_theme_supports') {
    
    $config = array(
        'html5' => array( 
            'caption', 
            'comment-form', 
            'comment-list', 
            'gallery', 
            'search-form' 
        ),
        'genesis-accessibility' => array( 
            '404-page', 
            'drop-down-menu', 
            'headings', 
            'rems', 
            'search-form', 
            'skip-links' 
        ),
        'custom-header' => array(
            'width'           => 600,
            'height'          => 160,
            'header-selector' => '.site-title a',
            'header-text'     => false,
            'flex-height'     => true,
        ),
        'genesis-menus' => array( 
            'primary' => __( 'After Header Menu', CHILD_TEXT_DOMAIN ), 
            'secondary' => __( 'Footer Menu', CHILD_TEXT_DOMAIN ) 
        ),
        'genesis-responsive-viewport' => null.
        'custom-background' => null,
        'genesis-after-entry-widget-area' => null,
        'genesis-footer-widgets' => 3,
    );
    
    foreach ( $config as $feature => $args ) {
		add_theme_support( $feature, $args );
	}

}

/**
 * Add new image sizes.
 *
 * @since 1.0.0
 *
 * @return void
 */
function adds_new_image_sizes() {
	$config = array(
		'featured-image' => array(
			'width'  => 720,
			'height' => 400,
			'crop'   => true,
		),
	);
	foreach( $config as $name => $args ) {
		$crop = array_key_exists( 'crop', $args ) ? $args['crop'] : false;
		add_image_size( $name, $args['width'], $args['height'], $crop );
	}
}

add_filter( 'genesis_theme_settings_defaults', __NAMESPACE__ . '\set_theme_settings_defaults' );
/**
 * Set theme settings defaults.
 *
 * @since 1.0.0
 *
 * @param array $defaults
 *
 * @return array
 */
function set_theme_settings_defaults( array $defaults ) {
	$config = get_theme_settings_defaults();
	$defaults = wp_parse_args( $config, $defaults );
	return $defaults;
}
add_action( 'after_switch_theme', __NAMESPACE__ . '\update_theme_settings_defaults' );
/**
 * Sets the theme setting defaults.
 *
 * @since 1.0.0
 *
 * @return void
 */
function update_theme_settings_defaults() {
	$config = get_theme_settings_defaults();
	if ( function_exists( 'genesis_update_settings' ) ) {
		genesis_update_settings( $config );
	}
	update_option( 'posts_per_page', $config['blog_cat_num'] );
}
/**
 * Get the theme settings defaults.
 *
 * @since 1.0.0
 *
 * @return array
 */
function get_theme_settings_defaults() {
	return array(
		'blog_cat_num'              => 12,
		'content_archive'           => 'full',
		'content_archive_limit'     => 0,
		'content_archive_thumbnail' => 0,
		'posts_nav'                 => 'numeric',
		'site_layout'               => 'content-sidebar',
	);
}