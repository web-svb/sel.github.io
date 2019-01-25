<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://web-svb.github.io/sel.github.io
 * @since             1.0.0
 * @package           Show_External_Links
 *
 * @wordpress-plugin
 * Plugin Name:       Show External Links
 * Plugin URI:        https://web-svb.github.io/sel.github.io
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            webaction <web.dev.svb@gmail.com>
 * Author URI:        https://web-svb.github.io/sel.github.io
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
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-show-external-links-activator.php
 */
function activate_show_external_links () {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-show-external-links-activator.php';
    Show_External_Links_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-show-external-links-deactivator.php
 */
function deactivate_show_external_links () {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-show-external-links-deactivator.php';
    Show_External_Links_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_show_external_links' );
register_deactivation_hook( __FILE__, 'deactivate_show_external_links' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
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
    $plugin = new Show_External_Links();
    $plugin->run();
}

run_show_external_links();