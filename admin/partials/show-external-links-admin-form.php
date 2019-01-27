<?php

/**
 * Used to mark up the form in the admin panel of the plugin
 *
 * @since      1.0.0
 * @package    Show_External_Links
 * @subpackage Show_External_Links/admin/partials
 */

echo '
<form action="" method="post">
    <h2>' . __( 'Show External Links Settings', 'show-external-links' ) . '</h2>
        <h4>' . __( 'Skip sites', 'show-external-links' ) . '</h4>
            <p>
                <textarea name="sel_skip_sites" rows="15" cols="100" placeholder="' . __( 'Domains or links, all from a new line.', 'show-external-links' ) . PHP_EOL . PHP_EOL . __( 'For example:', 'show-external-links' ) . PHP_EOL . 'example.com' . PHP_EOL . 'example.org' . PHP_EOL . PHP_EOL . __( 'or with parameters:', 'show-external-links' ) . PHP_EOL . 'https://example.com/page/' . PHP_EOL . 'https://example.org/?param=page' . PHP_EOL . PHP_EOL . __( 'URLs and parameters are truncated, only the domain remains.', 'show-external-links' ) . '
                ">' . $option_value . '</textarea>
            </p>
            <p>
                <input type="submit" value="' . __( 'Submit', 'show-external-links' ) . '">
            </p>
</form>';