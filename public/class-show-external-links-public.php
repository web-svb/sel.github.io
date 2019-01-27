<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 * @package    Show_External_Links
 * @subpackage Show_External_Links/public
 */

namespace SELinks\pub;

class Show_External_Links_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param      string $plugin_name The name of the plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct ( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version     = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles () {
        wp_enqueue_style( $this->plugin_name . 'css_1', plugin_dir_url( __FILE__ ) . 'css/show-external-links-public.css', [], $this->version, 'all' );
        wp_enqueue_style( $this->plugin_name . 'css_2', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', [], $this->version, 'all' );
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts () {
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/show-external-links-public.js', [ 'jquery' ], $this->version, false );
    }

}
