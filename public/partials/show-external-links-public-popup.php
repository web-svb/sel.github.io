<?php

/**
 * The the pop-up window code.
 *
 * @since      1.0.0
 * @package    Show_External_Links
 * @subpackage Show_External_Links/public/partials
 */

$sel_skip_sites = is_multisite() ? get_site_option( 'sel_skip_sites' ) : get_option( 'sel_skip_sites' );
$note           = ( false === $sel_skip_sites || empty( $sel_skip_sites ) ) ? '' : '<br /><span class="sel-note">(' . __( 'except for excluded sites', 'show-external-links' ) . ')</span>';

$popup = '           
<input class="open-selinks" id="top-box-selinks" type="checkbox" hidden>
<label class="btn-selinks" for="top-box-selinks"></label>
<div class="top-panel-selinks"> 
   <div class="message-selinks">
       <h2>' . __( 'External links found!', 'show-external-links' ) . '</h2> 
       <div class="Table">
           <div class="row-collection">
               <div class="Table-row">
                   <div class="Table-row-item">
                       <p>
                       ' . sprintf( _n( 'On this page %s link', 'There are %s links on this page',
            $number_of_links, 'show-external-links' ), $number_of_links ) . ':' . $note . '
                       </p>
                   </div>
                   <div class="Table-row-item">
                       <p class="list-of-links">' . $list_of_links . '</p>
                   </div>
               </div>
          </div>
      </div>
      <p class="check-source">
      ' . __( 'If you do not see all the links on the page, check the source code.', 'show-external-links' ) . '
      </p>
  </div>
</div>';

