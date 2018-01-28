<?php
/**
 * Plugin Name: Atomic Toolbox
 * Plugin URI: http://atomicblocks.com
 * Description: Atomic Blocks
 * Author: atomicblocks
 * Author URI: http://atomicblocks.com
 * Version: 1.0.0
 * License: GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package ATOMIC BLOCKS
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Initialize the blocks
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';

/**
 * Register the custom post types
 */
require_once plugin_dir_path( __FILE__ ) . 'src/custom-post-types/cpt.php';