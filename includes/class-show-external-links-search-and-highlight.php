<?php
/**
 * Class of search and selection of external links
 *
 * @since      1.0.1
 * @package    Show_External_Links
 * @subpackage Show_External_Links/includes
 * @author     webaction <web.dev.svb@gmail.com>
 */

class Show_External_Links_Search_And_Highlight
{
    // Current site domain
    private $domain;
    // Link search pattern
    private $links_pattern;

    public function __construct () {

        $this->domain = !empty( $_SERVER['HTTP_HOST'] ) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];

        $this->get_skip_sites();

        $this->links_pattern = '/(<a[^>]+((https?:\/\/|www)(?!(' . addslashes( $this->get_skip_sites() ) . '))[\w\.\/\-=?#]+)[^>]+>)(.*?)<\/a>/ui';
    }

    /**
     * Retrieving the page's HTML code and passing it to the show_external_links method.
     *
     * @since 1.0.1
     */
    public function get_html () {
        if ( current_user_can( 'activate_plugins' ) ) {
            ob_start( [ $this, 'external_links_highlight' ] );
        }
    }

    /**
     * Search and processing links in HTML code.
     *
     * @param $html
     *
     * @return null|string|string[]
     * @since 1.0.1
     */
    public function external_links_highlight ( $html ) {
        $html = str_replace( [ "\t", "\n", "\r" ], '', $html );

        preg_match_all( $this->links_pattern, $html, $out );

        $list_of_links   = array_map( function( $link ) {
            return wp_parse_url( $link, PHP_URL_HOST );
        }, $out[2] );
        $repetition_rate = array_count_values( $list_of_links );
        $str_links       = '';

        foreach ( $repetition_rate as $key => $value ) {
            $str_links .= $key . ' (' . $value . ')<br />';
        }

        $html = preg_replace( $this->links_pattern, '\1<span class="external-links" data-tooltip="\2">\5</span></a>', $html, -1, $count );
        $html = preg_replace( '/<body([^>]*?)>/ui', '<body\1>' . $this->get_popup( $count, $str_links ), $html );

        return $html;
    }

    /**
     * Site that are not considered when working with external links
     *
     * @since 1.0.1
     * @return string
     */
    private function get_skip_sites () {

        $sel_skip_sites = ( is_multisite() ) ? get_site_option( 'sel_skip_sites' ) : get_option( 'sel_skip_sites' );

        if ( false !== $sel_skip_sites && !empty( $sel_skip_sites ) ) {
            return $this->domain . '|' . str_ireplace( [ ',', ' ' ], [ '|', '' ], $sel_skip_sites );
        } else {
            return $this->domain;
        }
    }

    /**
     * Returns popup code.
     *
     * @param $number_of_links
     * @param $list_of_links
     *
     * @since 1.0.1
     * @return bool
     */
    private function get_popup ( $number_of_links, $list_of_links ) {

        if ( $number_of_links === 0 ) {
            return false;
        }

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/show-external-links-public-popup.php';

        return $popup;
    }
}