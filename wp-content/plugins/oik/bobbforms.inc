<?php // (C) Copyright Bobbing Wide 2009-2012

// Note: This file uses functions from bobbfunc.inc. You must ensure this is already loaded

function form( $action="", $method="post" ) {
  $form = "<form";
  $form .= kv( "method", $method );
  $form .= kv( "action", $action );
  $form .= ">";
  return( $form ); 
}

/**
 * Start a form
 * @param string $action - defaults to none - so this must be defined on the submit button
 * @param string $method - defaults to "post". other value is "get"
*/
function bw_form( $action="", $method="post" ) {
  e( form( $action, $method ) );
}  

function label( $name, $text ) {
   $lab = "<label for=\"";
   $lab.= $name;
   $lab.= "\">";
   $lab.= $text;
   $lab.= "</label>";
   return( $lab );
}

function ihidden( $name, $value ) {
  $it = "";
  //if ( $value != "" ) {
    $it = "<input type=\"hidden\" ";
    $it.= "name=\"";
    $it.= $name;
    $it.= "\" value=\"";
    $it.= $value;
    $it.= "\" />"; 
  //}  
  return $it;
}  

function itext( $name, $len, $value, $class=null, $extras=null ) {
  $width = ($len * 20) ;
  $it = "<input type=\"text\" size=\"";
  $it.= $len;
  $it.= "\" ";
  //$it.= "width=\"".$width;
  //$it.= "\" 
  $it.= "name=\"";
  $it.= $name;
  $it.= "\" id=\"";
  $it.= $name;
  $it.= "\" value=\"";
  $it.= $value;
  $it.= "\" class=\"";
  $it.= $class;
  $it.= "\"";
  $it.= $extras;
  $it.= " />"; 
  return $it;
}

function iarea( $name, $len, $value, $rows=10 ) {
  $it = "<textarea";
  $it .= kv( "rows", $rows);
  $it .= kv( "cols", $len );
  $it .= kv( "name", $name );
  $it .= ">";
  $it .= $value;
  $it .= "</textarea>";
  return( $it );
}

/**
 * Create an email field 
 * @link http://www.w3.org/TR/html-markup/input.email.html
 */
function iemail( $name, $len, $value, $class=null, $extras=null ) {
  $it = "<input";
  $it .= kv( "type", "email" );
  $it .= kv( "name", $name );
  $it .= kv( "value", $value );
  $it .= kv( "size", $len );
  $it .= kv( "class", $class );
  $it.= $extras;
  $it .= " />";
  return( $it );
}

/**
 * Create a submit button
 */
function isubmit( $name, $value, $id=null, $class=null,  $extras=null ) {
  $it = "<input";
  $it .= kv( "type", "submit" );
  $it .= kv( "name", $name );
  $it .= kv( "value", $value );
  $it .= kv( "id", $id );
  $it .= kv( "class", $class );
  $it .= $extras;
  $it .= " />";
  return( $it );
} 

/**
 * Create a radio button 
 */
function iradio( $name, $id, $value, $class, $extras ) {
  $it = "<input";
  $it .= kv( "type", "radio" );
  $it .= kv( "name", $name );
  $it .= kv( "id", $id );
  $it .= kv( "value", $value );
  $it .= kv( "class", $class );
  $it .= $extras;
  $it .= " />";
  return( $it );
}  
    
function tablerow( $td1, $td2 ) {  
   echo '<tr>';
   echo '<td>'.$td1.'</td>';
   echo '<td>'.$td2.'</td>';
   echo '</tr>';
   return 0;
}

function bw_td( $text=NULL, $class=NULL, $id=NULL ) {
  if ( $text ) {
    stag( "td", $class, $id );
    e( $text );
    etag( "td");
  }
}

function bw_tablerow( $td_array= array() ) {
  if ( count( $td_array ) ) {
    stag( "tr" );
    foreach ( $td_array as $td ) {
      bw_td( $td );
    }
    etag( "tr"); 
  }
}

function textfield($name, $len, $text, $value, $class=null ) {
  $lab = label( $name, $text );
  $itext = itext( $name, $len, $value, $class ); 
  tablerow( $lab, $itext );
  return;
}

function textarea( $name, $len, $text, $value, $rows=10 ) {
  $lab = label( $name, $text );
  $itext = iarea( $name, $len, $value, $rows ); 
  tablerow( $lab, $itext );
  return;
}
  
function bw_textfield( $name, $len, $text, $value, $class=null, $extras=null ) {
  $lab = label( $name, $text );
  $itext = itext( $name, $len, $value, $class, $extras ); 
  bw_tablerow( array( $lab, $itext ) );
  return;
}

function bw_emailfield( $name, $len, $text, $value, $class=null, $extras=null ) {
  $lab = label( $name, $text );
  $itext = iemail( $name, $len, $value, $class, $extras ); 
  bw_tablerow( array( $lab, $itext ) );
  return;
}

function bw_textarea( $name, $len, $text, $value, $rows=10 ) {
  $lab = label( $name, $text );
  $itext = iarea( $name, $len, $value, $rows ); 
  bw_tablerow( array( $lab, $itext) );
  return;
}

/**
 * Display a group of radio buttons
 * 
 * @param string $name - the name of the group
 * @param string $text - the title for the radio button group
 * @param array $values - array of $id => $value - one for each button in the group
 * @param array $labels - arraof of $id => $label - one for each button in the group
 * @param string $class - CSS class names e.g. "star"
 * @param array $extras - sparse array of $id -> $extra where $id matches the key of the $value array 
 * and $extra are any additional key=value parameters. This is where the "selected" radio button is defined
*/ 
function bw_radio( $name, $text, $values, $labels, $class=null, $extras=null ) {
  $iradios = null;
  foreach ( $values as $id => $value ) {
    $label = bw_array_get( $labels, $id, $value );
    $extra = bw_array_get( $extras, $id, null );
    $iradios .= label( $name, $label );
    $iradios .= iradio( $name, $id, $value, $class, $extra );
  }   
  $lab = label( $name, $text );
  bw_tablerow( array( $lab, $iradios ) );
}

function iselect( $name, $value, $args ) {
  $iselect = "<select name=\"$name\">" ;
  $options = $args['#options'];
  foreach ( $options as $option_key => $option_value ) {
    $selected = selected( $option_key, $value, false );
    $option = "<option value=\"$option_key\" $selected>$option_value</option>";
    $iselect .= $option; 
  }
  $iselect .= "</select>" ;
  return( $iselect );
} 

/** 
 * Create a select field for a form-table
 * @param string $name - field name
 * @param string $text - label for the field
 * @param int $value - the selected item
 * @param array $args - array of parameters where the options are keyed by #options
 */
function bw_select( $name, $text, $value, $args ) {
  $lab = label( $name, $text );
  $iselect = iselect( $name, $value, $args ); 
  bw_tablerow( array( $lab, $iselect ) );
  return;
}

/** 
 * Create a checkbox input field
 * @param string $name the name for the checkbox input field
 * @param string $value the value of the checkbox - default NOT checked
 * @param bool whether or not the checkbox should be disabled. default: false
 * When the value is set then the checkbox is checked
 
 * Note: In order to obtain a value when the checkbox is unticked
 * we add a hidden field with a vale of off
 * See http://iamcam.wordpress.com/2008/01/15/unchecked-checkbox-values/
 
 */
function icheckbox( $name, $value=NULL, $disabled=false ) {
  $it = ihidden( $name, "0" );
  $it .= "<input type=\"checkbox\" ";
  $it.= "name=\"";
  $it.= $name;
  $it.= "\" id=\"";
  $it.= $name;
  $it.= '"';
  if ( $value && $value != "0" ) {
    $it.= " checked=checked\"";
  } 
  if ( $disabled ) {
    $it .= kv( "disabled", "disabled" );
  }   
  $it.= "/>"; 
  return $it;
}

/**
 * Create a checkbox field given a field name and value
 */
function bw_checkbox( $name, $text, $value=1, $args=NULL ) {
  $lab = label( $name, $text );
  $icheckbox = icheckbox( $name, $value );
  bw_tablerow( array( $lab, $icheckbox ));
  return;
}

/**
 * Create a checkbox for an array options field 
 */
function bw_checkbox_arr( $name, $text, $array, $index ) {
  $name_index = $name.'['.$index.']';
  $value = bw_array_get( $array, $index, NULL );
  bw_checkbox( $name_index, $text, $value );
}  

/**
 * Create a textfield for an array options field 
 */
function bw_textfield_arr( $name, $text, $array, $index, $len, $class=null, $extras=null ) {
  $name_index = $name.'['.$index.']';
  $value = bw_array_get( $array, $index, NULL );
  bw_textfield( $name_index, $len, $text, $value, $class, $extras );
}

/**
 * Create an emailfield for an array options field 
 */
function bw_emailfield_arr( $name, $text, $array, $index, $len, $class=null, $extras=null ) {
  $name_index = $name.'['.$index.']';
  $value = bw_array_get( $array, $index, NULL );
  bw_emailfield( $name_index, $len, $text, $value, $class, $extras );
} 

/**
 * Create a textarea for an array options field 
 */
function bw_textarea_arr( $name, $text, $array, $index, $len, $rows=5 ) {
  $name_index = $name.'['.$index.']';
  $value = bw_array_get( $array, $index, NULL );
  bw_textarea( $name_index, $len, $text, $value, $rows );
}

/**
 * Create a select for an array options field
*/ 
function bw_select_arr( $name, $text, $array, $index, $args ) {
  $name_index = $name.'['.$index.']';
  $value = bw_array_get( $array, $index, NULL );
  bw_select( $name_index, $text, $value, $args );
}

/** 
 * Create an optional textarea  
 * 
 * If the _cb field is present we use this value. otherwise we default to "on"   
 *
 * Similar to this but the checkbox appears in the label for the textarea
 *   bw_checkbox_arr( $option, "Include?", $options, 'intro_cb' );
 *   bw_textarea_arr( $option, "Introduction", $text, 'intro', 60, 5 );
 *
 * TODO: In this version the checkbox appears next to the label. It might be nicer to have it next to the textarea. 
 * 
 */
function bw_textarea_cb_arr( $name, $text, $array, $index, $len, $rows=5 ) {
  $name_index = $name.'['.$index.'_cb]';
  $cb_value = bw_array_get( $array, $index.'_cb', "on" );
  $cb_text = $text; 
  $cb_text .= "&nbsp;";
  $cb_text .= icheckbox( $name_index, $cb_value );
  bw_textarea_arr( $name, $cb_text, $array, $index, $len, $rows );
}  

/**
 * Start of a WordPress form for options fields
 * @param string $option - name of the options field e.g. "bw_privacy_policy" ( 2nd parm to register_setting())
 * @param string $settings - name of the "settings" e.g. "oik_privacy_policy_options" (1st parm to register_setting())
 * @param string $action for the form - defaults to "options.php" 
 * @return array $options - the stored options settings 
 */
if ( !function_exists( "bw_form_start" ) ) { 
function bw_form_start( $option, $settings, $action="options.php" ) {
  bw_form( $action );
  $options = get_option( $option );   
  stag( 'table', "form-table" );
  bw_flush();
  settings_fields( $settings );
  return( $options );
}
}
  
/**
 * Reset the options to the default fields
 * @param string $option - option name
 * @param array $options - options 
 * @param string $default_cb - callback function to create the defaults
 * @param string $request_field - the field name that triggers the reset
 * 
 * Note: There really should be some security/nonce checking here **?** 
 */
function bw_reset_options( $option, $options, $default_cb, $request_field ) {     
  $reset = bw_array_get( $_REQUEST, $request_field, null );
  if ( $reset ) {
    delete_option( $option );
    $options = FALSE;
  }  
  if ( $options == FALSE ) {  
    $options = $default_cb();
  } else { 
    $options = array_merge( $default_cb(), $options );
  } 
  return( $options );
}
 
/**
 * Return the current URL - fully qualified so that it can be passed as a parameter to another site
 * Code copied from WordPress-SEO and @link http://webcheatsheet.com/PHP/get_current_page_url.php
 *
 */
function bw_current_url() {
  $pageURL = 'http';
  // Does it matter what it's set to? "on" or 1 **?**
  if ( isset( $_SERVER["HTTPS"] ) ) {  
    $pageURL .= "s";
  }
  $pageURL .= "://";
  $pageURL .= $_SERVER["SERVER_NAME"];
  // We know that SERVER_PORT is set by apache
  if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_PORT"];
  }
  $pageURL .= $_SERVER["REQUEST_URI"];
  bw_trace2( $pageURL, "pageURL", false );
  return( $pageURL );
}
