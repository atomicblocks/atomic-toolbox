<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since 	1.0.0
 * @package Atomic Blocks
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend and backend.
 *
 * @since 1.0.0
 */
function atomic_toolbox_cgb_block_assets() {
	// Styles.
	wp_enqueue_style(
		'atomic_toolbox-cgb-style-css',
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ),
		array( 'wp-blocks' )
		// filemtime( plugin_dir_path( __FILE__ ) . 'editor.css' )
	);
} 
add_action( 'enqueue_block_assets', 'atomic_toolbox_cgb_block_assets' );


/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @since 1.0.0
 */
function atomic_toolbox_cgb_editor_assets() {

	wp_enqueue_script(
		'atomic_toolbox-cgb-block-js',
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element' )
		// filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
	);

	// Pass in REST URL
    // wp_localize_script(
	// 	'atomic_toolbox-cgb-block-js',
	// 	'atomic_globals',
	// 	[
	// 	  'rest_url' => esc_url( rest_url() )
	// 	]);

	wp_enqueue_script(
		'atomic-toolbox-toolbar', 
		plugins_url( '/src/assets/toolbar/jquery.toolbar.js', dirname( __FILE__ ) ), 
		array( 'wp-blocks', 'wp-i18n', 'wp-element' )
		// filemtime( plugin_dir_path( __FILE__ ) . 'block.js' )
	);

	// Styles.
	wp_enqueue_style(
		'atomic_toolbox-cgb-block-editor-css',
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), 
		array( 'wp-edit-blocks' ) 
		// filemtime( plugin_dir_path( __FILE__ ) . 'editor.css' )
	);
}
add_action( 'enqueue_block_editor_assets', 'atomic_toolbox_cgb_editor_assets' );