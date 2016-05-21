<?php
/**
 * @package Noindex Paginated Posts
 * @version 1.1.0
 *
 * Plugin Name:  Noindex Paginated Posts
 * Plugin URI:   http://www.wpsitecare.com/
 * Description:  Force the WordPress SEO by Yoast plugin to noindex sub-pages of paginated posts.
 * Version:      1.1.0
 * Author:       Robert Neu
 * Author URI:   http://www.wpsitecare.com/
 * License:      GPL-2.0+
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  noindex-paginated-posts
 * Domain Path:  /languages
 * Git URI:      https://github.com/wpsitecare/noindex-paginated-posts
 * GitHub Plugin URI: https://github.com/wpsitecare/noindex-paginated-posts
 * GitHub Branch: master
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
	static $plugin;
	if ( null === $plugin ) {
		$plugin = new SiteCare_Noindex_Paginated_Posts();
	}
	return $plugin;
}

// Get the plugin running!
sitecare_noindex_paginated_posts()->run();
