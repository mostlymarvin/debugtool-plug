<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://apropos86.io
 * @since             1.0.0
 * @package           Debugtool_Plus
 *
 * @wordpress-plugin
 * Plugin Name:       Debugtool Plus
 * Plugin URI:        [plugin uri]
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Laird Sapir
 * Author URI:        https://apropos86.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       debugtool-plus
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DEBUGTOOL_PLUS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-debugtool-plus-activator.php
 */
function activate_debugtool_plus() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-debugtool-plus-activator.php';
	Debugtool_Plus_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-debugtool-plus-deactivator.php
 */
function deactivate_debugtool_plus() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-debugtool-plus-deactivator.php';
	Debugtool_Plus_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_debugtool_plus' );
register_deactivation_hook( __FILE__, 'deactivate_debugtool_plus' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-debugtool-plus.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_debugtool_plus() {

	$plugin = new Debugtool_Plus();
	$plugin->run();

}
run_debugtool_plus();
