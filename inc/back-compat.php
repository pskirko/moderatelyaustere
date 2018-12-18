<?php
/**
 * Moderately Austere back compat functionality
 *
 * Prevents Moderately Austere from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 *
 * @package WordPress
 * @subpackage Moderately_Austere
 * @since Moderately Austere 1.0
 */

/**
 * Prevent switching to Moderately Austere on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Moderately Austere 1.0
 */
function moderatelyaustere_switch_theme() {
	switch_theme( WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'moderatelyaustere_upgrade_notice' );
}
add_action( 'after_switch_theme', 'moderatelyaustere_switch_theme' );

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Moderately Austere on WordPress versions prior to 4.7.
 *
 * @since Moderately Austere 1.0
 *
 * @global string $wp_version WordPress version.
 */
function moderatelyaustere_upgrade_notice() {
	$message = sprintf( __( 'Moderately Austere requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'moderatelyaustere' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since Moderately Austere 1.0
 *
 * @global string $wp_version WordPress version.
 */
function moderatelyaustere_customize() {
	wp_die( sprintf( __( 'Moderately Austere requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'moderatelyaustere' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'moderatelyaustere_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since Moderately Austere 1.0
 *
 * @global string $wp_version WordPress version.
 */
function moderatelyaustere_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Moderately Austere requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'moderatelyaustere' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'moderatelyaustere_preview' );
