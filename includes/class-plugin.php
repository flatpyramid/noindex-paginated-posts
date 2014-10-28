<?php
/**
 * Noindex Paginated Posts Plugin Init.
 *
 * @package     NoindexPaginatedPosts
 * @author      Robert Neu
 * @copyright   Copyright (c) 2014, WP Site Care
 * @license     GPL-2.0+
 * @since       1.0.0
 */

//* Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Main plugin class.
 */
class SiteCare_Noindex_Paginated_Posts {

	/**
	 * Method to initialize the plugin.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function run() {
		self::load_textdomain();
		register_activation_hook( NOINDEX_PP_FILE,  array( $this, 'require_yoast' ) );
		add_filter( 'wpseo_robots', array( $this, 'noindex_paginated_posts' ) );
	}

	/**
	* Plugin localization support.
	*
	* @since  1.0.0
	* @return void
	*/
	public static function load_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'noindex-paginated-posts' );
		load_textdomain( 'noindex-paginated-posts', WP_LANG_DIR . '/noindex-paginated-posts/' . $locale . '.mo' );
		load_plugin_textdomain( 'noindex-paginated-posts', false, dirname( plugin_basename( NOINDEX_PP_FILE ) ) . '/languages' );
	}

	/**
	* Install
	*
	* Runs on plugin install and checks to make sure WordPress SEO is activated.
	*
	* @since  1.0.0
	* @return void
	*/
	public function require_yoast() {
		// Deactivate if WordPress SEO isn't active.
		if ( ! defined( 'WPSEO_VERSION' ) ) {
			deactivate_plugins( NOINDEX_PP_FILE ); // Deactivate ourself
			wp_die( __( 'Sorry, you can\'t activate unless you have installed WordPress SEO by Yoast.', 'noindex-paginated-posts' ) );
		}
	}

	/**
	* Force the robots meta output of Yoast's plugin to use noindex on paginated
	* posts for everything other than the first page.
	*
	* @since  1.0.0
	* @param  $robotsstr string the existing robots meta rules
	* @return string the modifed robots meta rules
	*/
	public function noindex_paginated_posts( $robotsstr ) {
		$paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : false;
		// Return early if we're not on a singular paginated post.
		if ( ! is_singular() || ! $paged ) {
			return $robotsstr;
		}
		// Convert the robots string into an array so we can manipulate it.
		$robots = explode( ',', $robotsstr );
		// Delete index from the array if it exists.
		if ( ( $key = array_search( 'index', $robots ) ) !== false ) {
			unset( $robots[ $key ] );
		}
		$follow = 'follow';
		// If the post has been nofollowed, let's keep that rule.
		if ( in_array( 'nofollow', $robots ) ) {
			$follow = 'nofollow';
		}
		// Set up our new indexation rules.
		$new_robots = array(
			'noindex',
			$follow,
		);
		$robots = array_unique( array_merge( $robots, $new_robots ) );
		arsort( $robots );
		// Return the updated robots array as a string for output.
		return rtrim( implode( ',',  $robots ), ',' );
	}

}
