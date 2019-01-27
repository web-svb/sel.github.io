<?php

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Show_External_Links
 * @subpackage Show_External_Links/includes
 */

namespace SELinks\includes;

class Show_External_Links_i18n
{
    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain () {
        load_plugin_textdomain( 'show-external-links', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' );
    }
}