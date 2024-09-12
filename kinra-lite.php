<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://pointilis.com
 * @since             1.0.0
 * @package           Kinra_Lite
 *
 * @wordpress-plugin
 * Plugin Name:       Kinra Lite
 * Plugin URI:        https://https://pointilis.com
 * Description:       A simple plugin for commerce and job posting.
 * Version:           1.0.0
 * Author:            Pointilis Noktah Teknologi
 * Author URI:        https://https://pointilis.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kinra-lite
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
define( 'KINRA_LITE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-kinra-lite-activator.php
 */
function activate_kinra_lite() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kinra-lite-activator.php';
	Kinra_Lite_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-kinra-lite-deactivator.php
 */
function deactivate_kinra_lite() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kinra-lite-deactivator.php';
	Kinra_Lite_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_kinra_lite' );
register_deactivation_hook( __FILE__, 'deactivate_kinra_lite' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-kinra-lite.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_kinra_lite() {

	$plugin = new Kinra_Lite();
	$plugin->run();

}
run_kinra_lite();
