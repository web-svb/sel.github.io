<?php

/**
 * The core plugin class.
 *
 * @since      1.0.0
 * @package    Show_External_Links
 * @subpackage Show_External_Links/includes
 */

namespace SELinks\includes;

use SELinks\pub\Show_External_Links_Public;
use SELinks\admin\Show_External_Links_Admin;

class Show_External_Links
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Show_External_Links_Loader $loader Maintains and registers all hooks for the
     * plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $plugin_name The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * @since    1.0.0
     */
    public function __construct () {
        if ( defined( 'SHOW_EXTERNAL_LINKS_VERSION' ) ) {
            $this->version = SHOW_EXTERNAL_LINKS_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'show-external-links';

        $this->load_dependencies();
        $this->set_locale();
        // At the moment, additional scripts and styles in the admin panel are not needed
        //        $this->define_admin_hooks();
        $this->define_public_hooks();
        $this->search_links();
        $this->add_menu();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Show_External_Links_Loader. Orchestrates the hooks of the plugin.
     * - Show_External_Links_i18n. Defines internationalization functionality.
     * - Show_External_Links_Admin. Defines all hooks for the admin area.
     * - Show_External_Links_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies () {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-show-external-links-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-show-external-links-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-show-external-links-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-show-external-links-public.php';

        /**
         * The class responsible for finding and selecting external links.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-show-external-links-search-and-highlight.php';

        /**
         * This class adds a top-level item (page) to the admin panel menu.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-show-external-links-add-menu.php';

        $this->loader = new Show_External_Links_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Show_External_Links_i18n class in order to set the domain and to register
     * the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale () {
        $plugin_i18n = new Show_External_Links_i18n();

        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks () {
        $plugin_admin = new Show_External_Links_Admin( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks () {
        $plugin_public = new Show_External_Links_Public( $this->get_plugin_name(), $this->get_version() );

        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );

        // At the moment, additional scripts in the front part are not needed.
        //                $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
    }

    /**
     * Search and selection of external links.
     *
     * @since    1.0.0
     * @access   private
     */
    private function search_links () {
        if ( is_admin() ) return false;
        $component = new Show_External_Links_Search_And_Highlight();
        $this->loader->add_action( 'get_header', $component, 'get_html' );
    }

    /**
     * Adds a top-level item (page) to the admin panel menu.
     *
     * @since    1.0.0
     * @access   private
     */
    private function add_menu () {
        $component = new Show_External_Links_Add_Menu();
        $this->loader->add_action( 'admin_menu', $component, 'plugin_menu' );
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run () {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name () {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    Show_External_Links_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader () {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version () {
        return $this->version;
    }
}