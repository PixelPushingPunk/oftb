<?php
if ( defined( 'OIK_HEADER_INCLUDED' ) ) return;
define( 'OIK_HEADER_INCLUDED', true );

/*
Plugin Name: oik custom header image
Plugin URI: http://www.oik-plugins.com/oik-plugins/oik-header
Description: custom page header image selection for pages, posts and custom post types 
Version: 1.18
Author: bobbingwide
Author URI: http://www.bobbingwide.com
License: GPL2

    Copyright 2011, 2012 Bobbing Wide (email : herb@bobbingwide.com )

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

add_action( "oik_loaded", "oik_header_init" );

function oik_header_init() {
  //if ( is_admin() ) {
  //  require_once( 'admin/oik-header.inc' );
  //}
  add_action( 'wp_footer', 'bw_page_header_style' );
}


/** 
 * Dynamically add CSS for the header background image if the custom field is set
 *
 * For an artisteer theme you can change the header image by adding some extra CSS eg
 * body.page-id-11 div.art-header { background-image: url('images/logo7-business.jpg'); }     
 *
 * Note: The selector is currently coded for Artisteer themes
 * We also assume that the whole of the background image is to be changed.
 * So we turn off the display of the div.art-headerobject as well.
 * 
 * Also added support for pages with themes that use div id='header'
 */
function bw_page_header_style() {
  $post_id = get_the_id();
  $post_meta = get_post_meta( $post_id, '_bw_header_image', TRUE );
  bw_trace2( $post_meta );
  if ( $post_meta ) {
    bw_theme_page_header( $post_id, $post_meta );
  }  
}

/** 
 * Return a candidate function name from the given string
 * 
 * Converts spaces and hyphens to underscores 
 * and converts to lowercase - which is not actually necessary for PHP code but can help in legibility
 *
 */
if ( !function_exists( "bw_function_namify" ) ) {
function bw_function_namify( $name ) {
  $name = trim( $name );
  $name = str_replace( ' ', '_', $name );
  $name = str_replace( '-', '_', $name );
  $name = strtolower( $name );
  return( bw_trace2( $name ) ); 
}
}  

/** 
 * Return the function name to be used to 'theme' the output
 * 
 * We append to the function name prefix to find the most precise name present
 *
 * @param string $prefix - This routine assumes that the $prefix function exists
 * @param string $suffix - optional suffix for multiple theming functions 
 * @returns string $funcname - the name of the function to invoke
 * 
 */
function bw_theme_function( $prefix="_", $suffix = NULL ) {
  $funcname = $prefix;
  $current_theme = bw_get_theme();
  
  $testname = $funcname . bw_function_namify( $current_theme );
  if ( function_exists( $testname ) ) { 
    $funcname = $testname;
  } else {
    $child_theme = is_child_theme();
    bw_trace2( $child_theme, "child_theme?", false );
    if ( $child_theme ) {
       // get parent theme name 
       $template = get_template();
       $testname = $funcname . bw_function_namify( $template );
       bw_trace2( $testname, "testname", false );
       if ( function_exists( $testname ) ) { 
         $funcname = $testname;
       }  
    }
  }  
    
  $testname .= $suffix;
  
  if ( function_exists( $testname ))
    $funcname = $testname;
    
  return bw_trace2( $funcname );
}   

/**
 * Locate and call the function to "theme" the custom page header image
 * 
 * The called routine is expected to echo the output as inline CSS style information
 *
 * @param integer $post_id - the ID of the post/page/custom post type
 * @param string $header_image - the URL of the header image file
 */ 
function bw_theme_page_header( $post_id, $header_image ) {
  $funcname = bw_theme_function( "_bw_page_header_" );
  $funcname( $post_id, $header_image );
}

/** 
 *
*/

function _bw_page_header_( $post_id, $header_image ) {
  e('<style type="text/css">');
  e( "body.postid-$post_id div.art-header, body.page-id-$post_id div.art-header, body.page-id-$post_id div#header { background-image: url('$header_image'); background-repeat: no-repeat; } " );
  e( "div.art-headerobject { display: none; } ");
  e('</style>');
  echo( bw_ret());
}


function _bw_page_header_twentyeleven ( $post_id, $header_image ) {
  _bw_page_header_twenty_eleven( $post_id, $header_image );
}  

/**
 * Generate the CSS to display a custom page header for the twenty eleven theme
 * 
 * For the twenty eleven theme we have to hide the current image
 * and set a background image on the <header id="branding" tag
 * The background image needs to be positioned below the h1 and h2
 * in order to make it appear similarly to the original custom header image code
 * Note: There are some unsolved challenges when the browser is sized down
 *
 * @param integer $post_id - the unique id of the post/page/custom post being displayed
 * @param string $header_image the URL of the header image
 * 
 */
function _bw_page_header_twenty_eleven( $post_id, $header_image ) {
  // **?** - code to produce style tags different browsers
  // Note: the current solution seems OK for Chrome and Firefox
  //  -o-background-size: 100% 100%, auto;
  //  -moz-background-size: 100% 100%, auto;
  //  -webkit-background-size: 100% 100%, auto;
  //  background-size: 100% 100%, auto;

  e('<style type="text/css">');
  e( "body.postid-$post_id #branding, body.page-id-$post_id #branding  { background-image: url('$header_image' ); background-position: 0% 100% ; background-repeat: no-repeat; background-size: 100% 60%, auto;   } " ); 
  e( "body.postid-$post_id #branding a img, body.page-id-$post_id #branding a img{ display: none;  } " );
  e( "body.postid-$post_id #branding h2, body.page-id-$post_id #branding h2 { margin-bottom: 25%;} " );
  e('</style>');
  echo( bw_ret());
}  
  


/** 
 * get the image size given the URL
 *
 * @param string $image the URL of the image
 * @returns array $imagesize = consists of width, height, type and attr
 *
 * Note: We currently assume that the URL is the file name of the file in the uploads directory
 * We also assume that the URL is http:// not https://
 * 
 * Convert the $image URL name 
 * from         "http://qw/wordpress/wp-content/uploads/2011/12/Sebastian-150x150.jpg"
 * to    "C:\apache\htdocs\wordpress\wp-content\uploads\2011\12\Sebastian-150x150.jpg"
 * then use getimagesize();
 */
function bw_getimagesize( $image ) {

  $upload_dir = wp_upload_dir();
  $image_file = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $image );

  $imagesize = getimagesize( $image_file );

  return bw_trace2( $imagesize) ;
  
}

add_action( "oik_admin_menu", "oik_header_admin_menu" );

/**
 * Relocate the plugin to become its own plugin and set the plugin server
 * Note: We also need to relocate the admin file for the plugin
 */
function oik_header_admin_menu() {
  oik_register_plugin_server( __FILE__ );
  bw_add_relocation( 'oik/oik-header.php', 'oik-header/oik-header.php' );
  bw_add_relocation( 'oik/admin/oik-header.inc', 'oik-header/admin/oik-header.inc' );
  
  oik_require2( "admin/oik-header.inc", "oik-header" );
  
}




