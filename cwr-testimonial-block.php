<?php
/**
 * Plugin Name:       Testimonial Block
 * Description:       A Gutenberg block to display a testimonial slider
 * Version:           0.99.1
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Author:            Chris Richardson
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       cwr-testimonial-block
 *
 * @package           cwr-testimonial-block
 */

define( '__ROOT__', plugin_dir_path( __FILE__ ) );

require_once( __ROOT__ . 'src/testimonial-pages.php' );
require_once( __ROOT__ . 'src/block.php' );

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_cwr_testimonial_block_block_init() {
	register_block_type( __DIR__ . '/build',
	  array(
		  'render_callback' => 'cwr_testimonial_render_callback',
	  )
	);
}
add_action( 'init', 'create_block_cwr_testimonial_block_block_init' );
