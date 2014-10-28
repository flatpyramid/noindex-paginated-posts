<?php
/**
 * Plugin Name:  Noindex Paginated Posts
 * Plugin URI:   http://www.wpsitecare.com/
 * Description:  Applies noindex rules to everything other than the root page of paginated entries. Requires the WordPress SEO by Yoast plugin.
 * Version:      1.0.0
 * Author:       Robert Neu
 * Author URI:   http://www.wpsitecare.com/
 * License:      GPL-2.0+
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  noindex-paginated-posts
 * Domain Path:  /languages
 */

// Define the root plugin file.
if ( ! defined( 'NOINDEX_PP_FILE' ) ) {
	define( 'NOINDEX_PP_FILE', __FILE__ );
}

// Load the main plugin class.
require_once( plugin_dir_path( NOINDEX_PP_FILE ) . '/includes/class-plugin.php' );

/**
* Helper function for grabbing an instance of the main plugin class.
*
* @since  1.0.0
* @return object an instance of the main plugin class
*/
function sitecare_noindex_paginated_posts() {
	$plugin = new SiteCare_Noindex_Paginated_Posts;
	return $plugin;
}

// Get the plugin running!
sitecare_noindex_paginated_posts()->run();
