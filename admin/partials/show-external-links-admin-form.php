<?php

/**
 * Used to mark up the form in the admin panel of the plugin
 *
 * @link       https://web-svb.github.io/sel.github.io
 * @since      1.0.0
 *
 * @package    Show_External_Links
 * @subpackage Show_External_Links/admin/partials
 */

$option_value = false !== get_option( 'sel_skip_sites' ) ? get_option( 'sel_skip_sites' ) : '';
echo '<form action="" method="post">
            <h3>' . __( 'Skip sites', 'show-external-links' ) . '</h3>
            <p>' . __( 'For example:', 'show-external-links' ) . '
             google.com,yahoo.com,bing.com</p>
            <p>
                <input type="text" name="skip_sites" value="' . $option_value . '" >
            </p>
            <p>
                <input type="submit" value="' . __( 'Submit', 'show-external-links' ) . '">
            </p>
        </form>';

