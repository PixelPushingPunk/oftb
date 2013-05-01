<?php
/**
Plugin Name: oik-nivo-slider
Depends: oik base plugin
Plugin URI: http://www.oik-plugins.com/oik-plugins/oik-nivo-slider/
Description: [nivo] shortcode for the Nivo slider using oik
Version: 1.8
Author: bobbingwide
Author URI: http://www.bobbingwide.com
License: GPL2

    Copyright 2012, 2013 Bobbing Wide (email : herb@bobbingwide.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/
add_action( "oik_loaded", "bw_nivo_init" );

/**
 * Implement "oik_loaded" action for the oik-nivo-slider 
 */
function bw_nivo_init() {
  bw_add_shortcode( "nivo", "bw_nivo_slider", oik_path( "nivo.inc", "oik-nivo-slider" ), false ); 
  add_action( "admin_menu", "oik_nivo_admin_menu" );
}

/**
 * Implement "admin_menu" action for the oik-nivo-slider 
 */
function oik_nivo_admin_menu() {
  require_once( "admin/oik-nivo-slider.php" );
  oik_nivo_lazy_admin_menu();
}

/* This code will produce a message when oik-nivo-slider is activated but oik isn't */
add_action( "admin_notices", "oik_nivo_activation" );
/**
 * Implement "admin_notice" action for oik-nivo-slider 
*/ 
function oik_nivo_activation() {
  static $plugin_basename = null;
  if ( !$plugin_basename ) {
    $plugin_basename = plugin_basename(__FILE__);
    add_action( "after_plugin_row_" . $plugin_basename, __FUNCTION__ );   
    require_once( "admin/oik-activation.php" );
  }  
  $depends = "oik:1.17";
  oik_plugin_lazy_activation( __FILE__, $depends, "oik_plugin_plugin_inactive" );
}



