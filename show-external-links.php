<?php

/**
 * Show External Links
 *
 * @link              https://web-svb.github.io/sel.github.io
 * @since             1.0.0
 * @package           Show_External_Links
 *
 * @wordpress-plugin
 * Plugin Name:       Show External Links
 * Plugin URI:        https://web-svb.github.io/sel.github.io
 * Description:       With the plugin Show External Links easy to find all the external links on the pages of the site.
 * Version:           1.0.1
 * Author:            web-svb <web.dev.svb@gmail.com>
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       show-external-links
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 *
 * @since 1.0.0
 */
define( 'SHOW_EXTERNAL_LINKS_VERSION', '1.0.1' );

/**
 * Current domain.
 *
 * @since 1.0.1
 */
define( 'SHOW_EXTERNAL_LINKS_DOMAIN', !empty( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'] );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-show-external-links-activator.php
 */
function activate_show_external_links () {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-show-external-links-activator.php';
    \SELinks\includes\Show_External_Links_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-show-external-links-deactivator.php
 *
 * @since    1.0.0
 */
function deactivate_show_external_links () {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-show-external-links-deactivator.php';
    \SELinks\includes\Show_External_Links_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_show_external_links' );
register_deactivation_hook( __FILE__, 'deactivate_show_external_links' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 *
 * @since    1.0.0
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-show-external-links.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_show_external_links () {
    $plugin = new \SELinks\includes\Show_External_Links();
    $plugin->run();
}

run_show_external_links();