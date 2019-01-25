<?php
/**
 * This class adds the plugin settings page to the admin panel menu.
 *
 * @since      1.0.0
 * @package    Show_External_Links
 * @subpackage Show_External_Links/includes
 * @author     webaction <web.dev.svb@gmail.com>
 */

class Show_External_Links_Add_Menu
{
    public function plugin_menu () {
        add_menu_page( 'Search External Links', 'SELinks', 8, __FILE__, [ $this, 'get_form' ] );

        $this->set_options();
    }

    public function get_form () {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/show-external-links-admin-form.php';
    }

    private function set_options () {
        if ( isset( $_POST['skip_sites'] ) ) {
            $options = sanitize_text_field( str_replace( ' ', '', $_POST['skip_sites'] ) );
            update_option( 'sel_skip_sites', $options );
        }
    }
}