<?php
/**
 * Enqueue assets to be used in theme
 *
 * @package     QCM\Boilerplate\Functions
 * @since       1.0.0
 * @author      Jeseph Meyers
 * @link        https://qcmny.com
 * @license     GNU General Public License 2.0+
 */
namespace QCM\Boilerplate\Functions;

//* Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\enqueue_assets' );
/**
 * Enqueue Scripts and Styles
 *
 * @since 1.0.0
 *
 * @return void
 */
function enqueue_assets() {

	wp_enqueue_style( CHILD_TEXT_DOMAIN . '-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_script( 'genesis-sample-responsive-menu', CHILD_URL . '/assets/js/responsive-menu.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	
    $localized_script_args = array(
		'mainMenu' => __( 'Menu', CHILD_TEXT_DOMAIN ),
		'subMenu'  => __( 'Menu', CHILD_TEXT_DOMAIN ),
	);
	wp_localize_script( CHILD_TEXT_DOMAIN . '-responsive-menu', 'qcm-boilerplateL10n', $localized_script_args );

}