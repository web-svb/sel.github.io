<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @link       https://web-svb.github.io/sel.github.io
 * @since      1.0.1
 *
 * @package    Show_External_Links
 */

// If uninstall not called from WordPress, then exit.
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}
if ( is_multisite() ) {
    delete_site_option( 'sel_skip_sites' );
} else {
    delete_option( 'sel_skip_sites' );
}