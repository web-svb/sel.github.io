<?php

/**
 * The the pop-up window code.
 *
 *
 * @link       https://web-svb.github.io/sel.github.io
 * @since      1.0.1
 *
 * @package    Show_External_Links
 * @subpackage Show_External_Links/public/partials
 */

$sel_skip_sites = is_multisite() ? get_site_option( 'sel_skip_sites' ) : get_option( 'sel_skip_sites' );
$note           = ( false === $sel_skip_sites || empty( $sel_skip_sites ) ) ? '' : '<br /><span class="sel-note">(' . __( 'except for excluded sites', 'show-external-links' ) . ')</span>';

$popup = '
            <div style="display:block" class="modal" id="modal-one" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-header">
                        <h2>' . __( 'External links found!', 'show-external-links' ) . '</h2>  
                            <a href="#modal-one" class="btn-close" aria-hidden="true">×</a>      
                    </div>
                    <div class="modal-body">
                        <p>' . sprintf( _n( 'On this page %s link', 'There are %s links on this page', $number_of_links, 'show-external-links' ), $number_of_links ) . ':' . $note . '
                        </p>
                        ' . $list_of_links . '
                        <br /><p>
                        ' . __( 'If you do not see all the links on the page, check the source code.', 'show-external-links' ) . '</p>
                    </div>
                    <div class="modal-footer"> <a href="#modal-one" class="btn">' . __( 'Close', 'show-external-links' ) . '</a>            
                    </div>
                </div>
            </div>';

