<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://apropos86.io
 * @since      1.0.0
 *
 * @package    Debugtool_Plus
 * @subpackage Debugtool_Plus/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Debugtool_Plus
 * @subpackage Debugtool_Plus/includes
 * @author     Laird Sapir <laird@apropos86.io>
 */
class Debugtool_Plus_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'debugtool-plus',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
