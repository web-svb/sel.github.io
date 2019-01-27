<?php
/**
 * This class adds the plugin settings page to the admin panel menu.
 *
 * @since      1.0.0
 * @package    Show_External_Links
 * @subpackage Show_External_Links/admin/partials
 */

namespace SELinks\includes;

class Show_External_Links_Add_Menu
{
    /**
     * Add a Top-Level Menu.
     *
     * @since 1.0.0
     */
    public function plugin_menu () {
        add_menu_page( 'Search External Links', 'SELinks', 'activate_plugins', __FILE__, [ $this, 'get_form' ], '
dashicons-admin-links', 999 );
        $this->set_options();
    }

    /**
     * HTML code form.
     *
     * @since 1.0.0
     */
    public function get_form () {
        if ( is_multisite() ) {
            $option = get_site_option( 'sel_skip_sites' );
        } else {
            $option = get_option( 'sel_skip_sites' );
        }
        $option_value = isset( $option ) && !empty( $option ) && $option !== 0 ? $option : '';
        $option_value = str_ireplace( [ ",", SHOW_EXTERNAL_LINKS_DOMAIN ], [ "\n", "" ], $option_value );
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/show-external-links-admin-form.php';
    }

    /**
     * Write option to database.
     *
     * @since 1.0.0
     */
    private function set_options () {
        if ( isset( $_POST['sel_skip_sites'] ) ) {
            $option = $this->sanitize_sel();
            if ( is_multisite() ) {
                update_site_option( 'sel_skip_sites', $option );
            } else {
                update_option( 'sel_skip_sites', $option );
            }
        }
    }

    /**
     * Sanitize data from text field.
     *
     * @since 1.0.0
     * @return bool|string
     */
    private function sanitize_sel () {
        foreach ( explode( "\n", $_POST['sel_skip_sites'] ) as $site ) {
            $tmp = sanitize_text_field( $site );
            $tmp = preg_replace_callback_array( [
                '/(https?:\/\/)?([^\/]+)(\/[^\,]+)?/ui' => function( $match ) {
                    return mb_strtolower( $match[2] );
                }, '/[^a-zа-яё\.\-,0-9]+/ui'            => function( $match ) {
                    return '';
                } ], $tmp );

            if ( $tmp ) {
                $out[] = $tmp;
            }
        }

        $result = ( isset( $out ) && is_array( $out ) && count( $out ) > 0 ) ? implode( ',', array_unique( $out ) ) : 0;

        return $result;
    }
}