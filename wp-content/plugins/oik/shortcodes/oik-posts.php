<?php // (C) Copyright Bobbing Wide 2012
if ( defined( 'OIK_POSTS_SHORTCODES_INCLUDED' ) ) return;
define( 'OIK_POSTS_SHORTCODES_INCLUDED', true );
/*

    Copyright 2012 Bobbing Wide (email : herb@bobbingwide.com )

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

oik_require( "includes/bw_posts.inc" );
oik_require( "shortcodes/oik-list.php" );


/**
 * Create a simple list of posts, defaulting to recent posts if no parms specified
 * 
 * Examples:
 * [bw_posts] 
 *
 * [bw_posts post_type='post' category_name='news' orderby='post_date' order='DESC' numberposts=8]
 */
function bw_posts( $atts = NULL ) {    
  $atts['post_type'] = bw_array_get( $atts, "post_type", "post" );
  $atts['orderby'] = bw_array_get($atts, "orderby", "post_date" );
  $atts['order'] = bw_array_get( $atts, "order", "DESC" );
  $atts['numberposts'] = bw_array_get( $atts, "numberposts", 10 );
  switch ( $atts[ 'orderby'] ) {
    case "post_date":
      $default_parent = 0;
      break;
    default:
      $default_parent = bw_global_post_id();
      break; 
  }  
  $atts['post_parent'] = bw_array_get( $atts, "post_parent", $default_parent );
        
  return( bw_list( $atts )) ;
}

function bw_posts__syntax( $shortcode="bw_posts" ) {
  $syntax = _sc_posts(); 
  $syntax = array_merge( $syntax, _sc_classes() );
  $syntax['numberposts'] = bw_skv( 10, "numeric", "number to return" );
  return( $syntax );   
}
