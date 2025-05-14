<?php
	
require get_template_directory() . '/core/includes/class-tgm-plugin-activation.php';

/**
 * Recommended plugins.
 */
function vr_gaming_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Kirki Customizer Framework', 'vr-gaming' ),
			'slug'             => 'kirki',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'WooCommerce', 'vr-gaming' ),
			'slug'             => 'woocommerce',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Mosaic Gallery Advanced Gallery', 'vr-gaming' ),
			'slug'             => 'mosaic-gallery-advanced-gallery',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	vr_gaming_tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'vr_gaming_register_recommended_plugins' );