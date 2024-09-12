<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://pointilis.com
 * @since      1.0.0
 *
 * @package    Kinra_Lite
 * @subpackage Kinra_Lite/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Kinra_Lite
 * @subpackage Kinra_Lite/includes
 * @author     Pointilis Noktah Teknologi <pointilis.noktah.teknologi@gmail.com>
 */
class Kinra_Lite_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'kinra-lite',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
