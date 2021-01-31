<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       honuselles@gmial.com
 * @since      1.0.0
 *
 * @package    Discount_Test_Case
 * @subpackage Discount_Test_Case/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Discount_Test_Case
 * @subpackage Discount_Test_Case/includes
 * @author     test <honuselles@gmial.com>
 */
class Discount_Test_Case_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'discount-test-case',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
