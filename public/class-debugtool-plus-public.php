<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://apropos86.io
 * @since      1.0.0
 *
 * @package    Debugtool_Plus
 * @subpackage Debugtool_Plus/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Debugtool_Plus
 * @subpackage Debugtool_Plus/public
 * @author     Laird Sapir <laird@apropos86.io>
 */
class Debugtool_Plus_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		$enqueue = false;
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Debugtool_Plus_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Debugtool_Plus_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script(
			'debugtool',
			'//debugtool.com/app/app/js/debugtool.min.js',
			array( 'jquery' ),
			DEBUGTOOL_PLUS_VERSION,
			true
		);

		$options = get_option( 'debugtool', array() );

		$show_to_roles = array();
		//Get the settings for the plugin.
		$debug_administrator_view = $options['debug_administrator_view'] ?? 0;
		if ( $debug_administrator_view ) {
			$show_to_roles[] = 'administrator';
		}

		$debug_editor_view = $options['debug_editor_view'] ?? 0;
		if ( $debug_editor_view ) {
			$show_to_roles[] = 'editor';
		}

		$debug_contributor_view = $options['debug_contributor_view'] ?? 0;
		if ( $debug_contributor_view ) {
			$show_to_roles[] = 'contributor';
		}

		$debug_author_view = $options['debug_author_view'] ?? 0;
		if ( $debug_author_view ) {
			$show_to_roles[] = 'author';
		}

		$debug_subscriber_view = $options['debug_subscriber_view'] ?? 0;
		if ( $debug_subscriber_view ) {
			$show_to_roles[] = 'subscriber';
		}

		//print_r( $show_to_roles );
		// Get Current User ID and Roles
		$current_user_id = get_current_user_id();
		$user_meta       = get_userdata( $current_user_id );
		$user_roles      = $user_meta->roles;

		foreach ( $user_roles as $role ) {
			if ( in_array( $role, $show_to_roles, true ) ) {
				$enqueue = true;
			}
		}

		$debugtool_user_ids = $options['debugtool_user_ids'] ?? '';
		$debugtool_user_ids = explode( ',', $debugtool_user_ids );

		// Only enqueue the script if the user role should be shown the debugtool OR the USER has been
		// Added to the array of users to be shown the debugtool.
		if ( in_array( (string) $current_user_id, $debugtool_user_ids, true ) ) {
			$enqueue = true;
		}

		if ( ! empty( $enqueue ) ) {
			wp_enqueue_script( 'debugtool' );
		}
	}


	public function add_script_attributes( $tag, $handle ) {
		if ( 'debugtool' === $handle ) {
			$tag = str_replace( ' src', ' async src', $tag );
		}
		return $tag;
	}
}
