<?php 
if ( defined( 'OIK_TABLE_SHORTCODES_INCLUDED' ) ) return;
define( 'OIK_TABLE_SHORTCODES_INCLUDED', true );
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
oik_require( "includes/bw_images.inc" );
oik_require( "bobbforms.inc" );

/**
 * 
 */
function bw_table_header( $title_arr ) {

  stag( "table", "bw_table" );
  stag( "thead" );
  bw_tablerow( $title_arr );
  etag( "thead" );
  
  stag( "tbody" );
  
}

/**
 * Convert a field name to a title
 *
 * @param string $name - field name e.g. _cc_custom_category
 * @return string $title - title returned
 * 
 * Converts underscores to blanks, trims and uppercases first letter of each word
 * DOES NOT remove a prefix that may match the post_type's slug 
 * So the field title may be quite long. 
 */
function bw_titleify( $name ) {
  $title = str_replace( "_", " ", $name );
  $title = trim( $title ); 
  $title = ucwords( $title );  
  return( $title ); 
} 


/**
 * Build a default title_arr from the field_arr
 */ 
function bw_default_title_arr( $field_arr ) {
  if ( count( $field_arr) ) {
    foreach ( $field_arr as $key => $name ) {
      $title_arr[$name] = bw_titleify( $name );
    }
  }
  return( $title_arr ); 
} 

/**
 * Determine the columns for the table
 *
 * Default are title and description (excerpt) 
 *
 */
function bw_query_table_columns( $atts=null, $post_type ) {
  global $field_arr, $title_arr;
  $field_arr = array();
  $title_arr = array();


  $fields = bw_array_get( $atts, "fields", "title,excerpt" );
  if ( $fields ) { 
    $field_arr = explode( ",", $fields ); 
    $field_arr = bw_assoc( $field_arr );
    bw_trace2( $field_arr, "field_arr", false );
  }
  
  $field_arr = apply_filters( "oik_table_fields_${post_type}", $field_arr, $post_type );
  $title_arr = bw_default_title_arr( $field_arr ); 
  
  $title_arr = apply_filters( "oik_table_titles_${post_type}", $title_arr, $post_type, $field_arr );
 
  bw_table_header( $title_arr );  
  $excerpts = in_array( "excerpt", $field_arr);
  return( $excerpts );
    
}

/* bw_custom_column( $column, $post_id )
(
    [0] => title
    [1] => excerpt
    [_cookie_category] => _cookie_category
    [_cookie_category_sess] => _cookie_category_sess
    [_cookie_category_duration] => _cookie_category_duration
)
*/

function bw_format_table_row( $post, $atts ) {
  global $field_arr; 
  $atts['post'] = $post;
  bw_trace2( $field_arr, "field_arr", false );
  stag( "tr" );
  foreach ( $field_arr as $key => $value ) {
    bw_trace2( $key, "key", false );
    bw_trace2( $value, "value", false );
    stag( "td", $value, $key );
    
    if ( property_exists( $post, $value ) ) {
      $field_value = $post->$value ;
      bw_theme_field( $value, $field_value, $atts ); 
      
    } elseif ( property_exists( $post, "post_$value" ) ) {       
      $field_name = "post_" . $value;  
      $field_value = $post->$field_name;
      bw_theme_field( $field_name, $field_value, $atts );
      
       // e( $post->$field );
    } else {
       // e( "key==value" . $key . $value . $key==$value );
       bw_custom_column( $value, $post->ID );   
       //bw_flush();
    }   
    etag( "td" );
  }  
  // bw_tablerow( $field_arr );
  etag( "tr");

}

/**
 * Format the data in a table 
 * The titles are returned by the post type... what if it's not a custom post type
 * The fields are returned by the post type... ditto
 *
 */
function bw_format_table( $posts, $atts ) {
  $atts['post_type'] = $posts[0]->post_type;
  $post_type = $posts[0]->post_type; 
  
  $excerpts = bw_query_table_columns( $atts, $post_type );
  
  foreach ( $posts as $post ) {
    if ( $excerpts )
      $post->excerpt = bw_excerpt( $post );    
    bw_format_table_row( $post, $atts );
  }
  etag( "tbody" );
  etag( "table" );
}

/** 
 * Display a table of information showing custom data and other content  
 * 
 * @param mixed $atts - parameters to the shortcode 
 * @return string the "raw" content - that could be put through WP-syntax
 */
function bw_table( $atts=null ) {
  $posts = bw_get_posts( $atts );
  if ( $posts ) { 
    bw_format_table( $posts, $atts );   
  }
  bw_clear_processed_posts();
  return( bw_ret() );
}

function bw_table__syntax( $shortcode="bw_table" ) {
  $syntax = _sc_posts(); 
  $syntax = array_merge( $syntax, _sc_classes() );
  return( $syntax );   
}

function bw_table__help( $shortcode="bw_table" ) {
  return( "Display custom post data in a tabular form" );
}

function bw_table__example( $shortcode="bw_table" ) {
 $text = "To display a table of the 4 most recent posts" ;
 $example = 'post_type="post" orderby="post_date" order=DESC numberposts=4';
 // oops it went into a loop! 
 //bw_invoke_shortcode( $shortcode, $example, $text );
} 

