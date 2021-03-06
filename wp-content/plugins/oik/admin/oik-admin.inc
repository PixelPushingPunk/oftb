<?php // (C) Copyright Bobbing Wide 2011,2012 
if ( defined( 'OIK_ADMIN_ADMIN_INCLUDED' ) ) return;
define( 'OIK_ADMIN_ADMIN_INCLUDED', true );


/**
 * Load 'plugin' file if the options checkbox is set on
 *
 * The file extension of the plugin is ".php"
 */
function bw_load_plugin( $set="bw_buttons", $option="oik-button-shortcodes", $plugin=NULL ) {
  $checkbox = bw_get_option( $option, $set );
  bw_trace2( $checkbox, "checkbox" );
  if ( $checkbox == "on"  ) {
    if ( $plugin == NULL ) {
      $plugin = $option.".php" ;
    }  
    bw_trace2( $plugin, "plugin" );
    oik_require( $plugin );
  }
}    

// Init plugin options 
function oik_options_init() {
  register_setting( 'oik_options_options', 'bw_options', 'oik_options_validate' );
  register_setting( 'oik_options_options1', 'bw_options1', 'oik_options_validate' );
  register_setting( 'oik_plugins_options', 'bw_plugins', 'oik_plugins_validate' ); // No validation yet
  register_setting( 'oik_buttons_options', 'bw_buttons', 'oik_buttons_validate' );
  
  bw_load_plugin( "bw_buttons", "oik-paypal-shortcodes" );
  bw_load_plugin( "bw_buttons", "oik-button-shortcodes" );
  bw_load_plugin( "bw_buttons", "oik-shortc-shortcodes" );
  bw_load_plugin( "bw_buttons", "oik-quicktags" );
  
  // For WordPress 3.5 these filters are added in oik.php
  //add_filter( "attachment_fields_to_edit", "oik_attachment_fields_to_edit", null, 2 ); 
  //add_filter( "attachment_fields_to_save", "oik_attachment_fields_to_save", null, 2 );
  
  // Add support for plugin relocation during "pre_current_active_plugins" 
  add_action( "pre_current_active_plugins", "bw_relocate_pre_current_active_plugins", 10, 1 );
  
}


/**
 * Load the oik-quicktags jQuery/JavaScript for when TinyMCE or the advanced HTML editor is being used
 * Question: Does this work in full screen?

*/
function bw_load_admin_scripts() {
  wp_register_script( "oik-quicktags", plugin_dir_url( __FILE__). "bw_shortcodes.js", array('quicktags') );  
  wp_enqueue_script( "oik-quicktags" );
}

/**
 * Add the options page
 * Note: To avoid getting the Effort menu duplicated the name of the first submenu item needs to be the same
 * as the main menu item. see http://geekpreneur.blogspot.com/2009/07/getting-unwanted-sub-menu-item-in.html
 * In most "normal" WP menus the main menu gives you the full list
 * Notes: we need to enqueue the oik stylesheets for the oik options page
 */
function oik_options_add_page() {
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position ); 
 
  // We don't specify the icon here since WordPress doesn't cater for it nicely.
  // It's better as a background image which can be hovered, in focus etc
  // plugins_url( "images/oik-icon.png", __FILE__ ) 

  add_menu_page('[oik] Options', 'oik options', 'manage_options', 'oik_menu', 'oik_menu' );
  
  // add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function ); 
  
  add_submenu_page( 'oik_menu', 'oik overview', 'Overview', 'manage_options', 'oik_menu', 'oik_menu');
  add_submenu_page( 'oik_menu', 'oik options', 'Options', 'manage_options', 'oik_options', 'oik_options_do_page');
  add_submenu_page( 'oik_menu', 'oik options-1', 'More Options', 'manage_options', 'oik_options-1', 'oik_options_do_page_1');
  add_submenu_page( 'oik_menu', 'oik plugins', 'Plugins', 'manage_options', 'oik_plugins', 'oik_plugins_do_page' );
  add_submenu_page( 'oik_menu', 'oik buttons', 'Buttons', 'manage_options', 'oik_buttons', 'oik_buttons_do_page' );
  add_submenu_page( 'oik_menu', 'oik shortcode help', "Shortcode help", 'manage_options', 'oik_sc_help', "oik_help_do_page" );
  //add_submenu_page( 'oik_menu', 'Trace options', 
}

function oik_callback() {
 p( "This box intentionally left blank" );
 
}

/**
 * Create a postbox widget on the admin pages 
 * Notes: Similar to Yoast's potbox (sic)
 *
 */
function oik_box( $class=NULL, $id=NULL, $title=NULL, $callback='oik_callback' ) {
  if ( $id == NULL ) {
    $id = $callback;
  }  
  sdiv( "postbox $class", $id );
  sdiv( "handlediv", NULL, 'title="Click to toggle"' );
  br();
  ediv();
  h3( $title, "hndle" );
  sdiv( "inside" );
  $callback();
  ediv( "inside" );
  ediv( "postbox" );
}

function scolumn( $class=NULL, $id=null ) {
  sdiv( "metabox-holder" );
  sdiv( "postbox-container $class", $id  );
  sdiv( "meta-box-sortables ui-sortable" );
}
  
function ecolumn( ) {
  c( "start ecolumn" );
  ediv( "meta-box-sortables" );
  ediv( "postbox-container" );
  ediv( "metabox-holder" );
  c( "end ecolumn" );
} 

function oik_menu_header( $title="Overview", $class="w70pc" ) {
  oik_require( "bobbforms.inc" );
  oik_require( "shortcodes/oik-bob-bing-wide.php" );
  oik_enqueue_stylesheets();
  oik_enqueue_scripts();
  sdiv( "wrap" ); 
  $loik = bw_loik();
  h2( "$loik $title" ); 
  scolumn( $class );
}
  
function oik_menu_footer() {
  ecolumn();
  sediv( "clear" );
  ediv( "wrap");
} 

function oik_shortcode_options( ) {
  p( "oik provides sets of lazy smart shortcodes that you can use just about anywhere in your WordPress site." );
 
  p( "You enter your common information, such as contact details, slogans, location information, PayPal payment information and your social networking and bookmarking information using oik Options" );
  p( "If required, you enter alternative information using More options" );
  
  alink( "button-primary", admin_url("admin.php?page=oik_options"), "Options", "Enter your common information" );
  e( "&nbsp;" );
  alink( "button-secondary", admin_url("admin.php?page=oik_options-1"), "More options", "Enter additional information" );
  
  p( "Discover the shortcodes that you can use in your content and widgets using Shortcode help" );
  
  alink( "button-secondary", admin_url( "admin.php?page=oik_sc_help"), "Shortcode help", "Discover shortcodes you can use" );
  
  p( "Choose the helper buttons that help you to insert shortcodes when editing your content" );
  alink( "button-secondary", admin_url( "admin.php?page=oik_buttons"), "Buttons", "Select TinyMCE and HTML edit helper buttons" );
  
}

function oik_custom_css_box() {
  $theme = bw_get_theme();
  p( "To style the output from shortcodes you can create and edit a custom CSS file for your theme ($theme)." );
  p( "Use the [bw_editcss] shortcode to create the <b>edit CSS</b> link anywhere on your website." ); 
  p( "Note: If you change themes then you will start with a new custom CSS file." );
  p( "You should save your custom CSS file before updating theme $theme." );
  $options = get_option('bw_options');     
  $customCSS = bw_array_get( $options, 'customCSS', NULL );
  if ( $customCSS ) {
    p( "Click on this button to edit your custom CSS file.");
    oik_custom_css( $theme );
  } else {
    p( "You have not defined a custom CSS file." );
    alink( "button-secondary", admin_url("admin.php?page=oik_options"), "Name your custom CSS file", "Enter the name of your custom CSS file on the Options page" );
  }
}

function oik_custom_css( $theme=null ) {
  $options = get_option('bw_options');     
  $customCSS = bw_array_get( $options, 'customCSS', NULL );
  if ( $customCSS ) {
    $sanfile = sanitize_file_name( $customCSS );
    // Should we check the sanitized file name with the original ?
    bw_create_file( get_stylesheet_directory(), $sanfile, plugin_dir_path( __FILE__ ) . 'custom.css' );  
    bw_edit_custom_css_link( $sanfile, $theme );
  }    
} 

function oik_plugins_servers() {
  $options = get_option( 'bw_plugins' );
  p( "Some oik plugins are supported from servers other than WordPress.org" );
  p( "Premium plugin versions require API keys." );
  p( "Use the Plugins page to manage oik plugins servers and API keys" );
  alink( "button-primary", admin_url("admin.php?page=oik_plugins"), "Plugins", "Manage plugin servers and API keys" );
}


function oik_default_tinymce_buttons() {
  $defaults = array();
  $defaults['oik-button-shortcodes'] = "on";
  $defaults['oik-paypal-shortcodes'] = "on";
  $defaults['oik-shortc-shortcodes'] = "on";
  $defaults['oik-quicktags'] = "on";
  return( $defaults );
}  


/**
 * Allow selection of the TinyMCE buttons 
 * 
 * We call bw_recreate_options() to change the "bw_buttons" so that they are not autoloaded
 * Note: The buttons aren't actually set until the user visits this page AND selects "Save changes".
 */

function oik_tinymce_buttons() {
  $option = 'bw_buttons'; 
  $options = bw_form_start( $option, 'oik_buttons_options' );
  $options = bw_reset_options( $option, $options, "oik_default_tinymce_buttons", "_oik_reset_buttons" );
  $options = bw_recreate_options( 'bw_buttons' );
  
  $imagefile_bw = retimage( NULL, plugin_dir_url(__FILE__ ).'bw-bn-icon.gif', "Button shortcodes" );
  $imagefile_pp = retimage( NULL, plugin_dir_url( __FILE__ ).'bw-pp-icon.gif', "PayPal shortcodes" );
  $imagefile_sc = retimage( NULL, plugin_dir_url( __FILE__ ).'bw-sc-icon.gif', "ALL shortcodes" );
  bw_checkbox_arr( "bw_buttons", $imagefile_bw . " Button shortcodes", $options, 'oik-button-shortcodes' ); 
  bw_checkbox_arr( "bw_buttons", $imagefile_pp . " PayPal shortcodes", $options, 'oik-paypal-shortcodes' ); 
  bw_checkbox_arr( "bw_buttons", $imagefile_sc . " ALL shortcodes", $options, 'oik-shortc-shortcodes' ); 
  bw_checkbox_arr( "bw_buttons", "[] quicktag for HTML editor", $options, "oik-quicktags" );
  bw_tablerow( array( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" class=\"button-primary\"/>") ); 
  etag( "table" ); 			
  etag( "form" );
  bw_flush();
}

function oik_documentation() {
  p("For more information:" );
  sul();
  stag( "li" );
  alink( null, "http://www.oik-plugins.com/tutorial/getting-started-with-oik-plugins/", "Getting started" );
  stag( "li" );
  alink( NULL,  "http://www.oik-plugins.com/oik/oik-faq", "Frequently Asked Questions" );
  etag( "li" );
  stag( "li" );
  alink( NULL, "http://wordpress.org/tags/oik?forum_id=10", "Forum" );
  etag( "li" );
  eul();
  sp();
  art_button( "http://www.oik-plugins.com", "oik documentation", "Read the documentation for the oik plugin" );
  ep();
} 

function oik_support() {
  oik_require( "shortcodes/oik-paypal.php" );
  p( "Support the development of ". bw_oik(). " by making a donation to ". bw_lbw() );
  e ( bw_pp_shortcodes( array( "type" => "donate", "email" => "herb@bobbingwide.com" )) );
}

/**
 * What jQuery scripts do we need to make the page work as if they were dashboard widgets?
 * Where do we find out what all the others do?
 * Each of the default scripts that we enqueue gets added to the list of scripts loaded by wp-admin/load-scripts.php
 * Except when 'SCRIPT_DEBUG' is true; then each script is loaded separately
  
 * dashboard enables postbox toggling
 * It's not necessary to add most of these as they are pre-requisites 
 * e.g. dashboard is dependent upon jquery, admin-comments and postbox
 *
 * @see wp-includes/script-loader.php
 */
function oik_enqueue_scripts() {

  //wp_enqueue_style( 'wp-pointer' ); 
  //wp_enqueue_script( 'jquery-ui' ); 
  //wp_enqueue_script( 'jquery-ui-core' ); 
  //wp_enqueue_script( 'jquery-ui-widget' ); 
  //wp_enqueue_script( 'jquery-ui-mouse' ); 
  //wp_enqueue_script( 'jquery-ui-sortable' );
  //wp_enqueue_script( 'postbox' );
  //wp_enqueue_script( 'wp-ajax-response' );
  //wp_enqueue_script( 'wp-lists' );
  //wp_enqueue_script( 'jquery-query' );
  wp_enqueue_script( 'dashboard' );
  
  //wp_enqueue_script( 'jquery-ui-draggable' );
  //wp_enqueue_script( 'jquery-ui-droppable' );
  //wp_enqueue_script( 'jquery-ui-tabs' );
  //wp_enqueue_script( 'jquery-ui-selectable' );
  //wp_enqueue_script( 'wp-pointer' ); 
  //wp_enqueue_script( 'utils' );
}  


function oik_menu() {
  oik_menu_header( "overview", "w70pc" );
  oik_box( NULL, NULL, "Shortcode options", "oik_shortcode_options" );
  oik_box( NULL, NULL, "Custom CSS", "oik_custom_css_box" );
  oik_box( NULL, NULL, "Servers and keys", "oik_plugins_servers" );
  ecolumn();
  scolumn( "w30pc" );
  oik_box( NULL, NULL, "oik documentation", "oik_documentation" );
  oik_box( NULL, NULL, "support oik", "oik_support" );
  oik_menu_footer();
  bw_flush();
}

/** 
  * Draw the oik buttons page
  *
  */
function oik_buttons_do_page() {
  oik_menu_header( "button selection" );
  oik_box( NULL, NULL, "TinyMCE buttons", "oik_tinymce_buttons" );
  oik_menu_footer();
  bw_flush();
}  

/** 
 * Draw the oik plugins page
 *
*/ 
function oik_plugins_do_page() {
  oik_plugins_server_settings();
  bw_flush();
}

/**
 * Process the oik plugins server settings page
 */
function oik_plugins_server_settings() { 
  oik_require( "admin/oik-plugins.inc" ); 
  oik_lazy_plugins_server_settings();
}  

/** 
 * Draw the oik options page 
*/
function oik_options_do_page() {
  oik_menu_header( "shortcode options", "w60pc" );
  oik_box( null, null, "Often included key information", "oik_main_shortcode_options" );
  ecolumn();
  scolumn( "w40pc" );
  oik_box( null, null, "Usage notes", "oik_usage_notes" );
  oik_menu_footer();
  bw_flush();
} 

function oik_contact_numbers( $option, $options ) {
  bw_textfield_arr( $option, "Telephone [bw_telephone] / [bw_tel]", $options, 'telephone', 50 );
  bw_textfield_arr( $option, "Mobile [bw_mobile] / [bw_mob]", $options, 'mobile', 50 );
  bw_textfield_arr( $option, "Fax [bw_fax]", $options, 'fax', 50 );
  bw_textfield_arr( $option, "Emergency [bw_emergency]", $options, 'emergency', 50 );    
} 

function oik_company_info( $option, $options ) {  
  bw_textfield_arr( $option, "Company [bw_company]", $options, 'company', 50 );    
  bw_textfield_arr( $option, "Business [bw_business]", $options, 'business', 50 );    
  bw_textfield_arr( $option, "Formal [bw_formal]", $options, 'formal', 50 );    
  bw_textfield_arr( $option, "Abbreviation [bw_abbr]", $options, 'abbr', 50 );    
  bw_textfield_arr( $option, "Main slogan [bw_slogan]", $options, 'main-slogan', 50 );    
  bw_textfield_arr( $option, "Alt. slogan [bw_alt_slogan]", $options, 'alt-slogan', 50 );    
}

function oik_contact_info( $option, $options ) {  
  bw_textfield_arr( $option, "Contact [bw_contact]", $options, 'contact', 50 );    
  bw_textfield_arr( $option, "Email [bw_mailto]/[bw_email]", $options, 'email', 50 );    
  bw_textfield_arr( $option, "Admin [bw_admin]", $options, 'admin', 50 );    
  bw_textfield_arr( $option, "Contact button page permalink [bw_contact_button]", $options, 'contact-link', 50 );    
  bw_textfield_arr( $option, "Contact button text", $options, 'contact-text', 50 );    
  bw_textfield_arr( $option, "Contact button tooltip", $options, 'contact-title', 50 );    
}  
  
/**
 * Address and geo fields
 *  
 *  extended-address e.g.  Bobbing Wide
 *  street-address   e.g.  41 Redhill Road
 *  locality         e.g   Rowlands Castle
 *  region           e.g.  HANTS
 *  postal-code      e.g.  PO9 6DE                        
 *  country-name     e.g.  UK 
 */
function oik_address_info( $option, $options ) {    
  bw_textfield_arr( $option, "Extended-address [bw_address]", $options, 'extended-address', 50 );
  bw_textfield_arr( $option, "Street-address", $options, 'street-address', 50 );
  bw_textfield_arr( $option, "Locality", $options, 'locality', 50 );
  bw_textfield_arr( $option, "Region", $options, 'region', 50 );
  bw_textfield_arr( $option, "Post Code", $options, 'postal-code', 50 );
  bw_textfield_arr( $option, "Country name", $options, 'country-name', 50 );
  
  bw_textarea_arr( $option, "Google Maps introductory text for [bw_show_googlemap]", $options, 'gmap_intro', 50 );
  bw_textfield_arr( $option, "Latitude [bw_geo] [bw_directions]", $options, 'lat', 50 );
  bw_textfield_arr( $option, "Longitude [bw_show_googlemap]", $options, 'long', 50 );
}

function oik_follow_me( $option, $options ) {
  bw_textfield_arr( $option, "Twitter URL [bw_twitter]", $options, 'twitter', 50 );
  bw_textfield_arr( $option, "Facebook URL [bw_facebook]", $options, 'facebook', 50 );
  bw_textfield_arr( $option, "LinkedIn URL [bw_linkedin]", $options, 'linkedin', 50 );
  bw_textfield_arr( $option, "Google Plus URL [bw_googleplus]", $options, 'googleplus', 50 );
  bw_textfield_arr( $option, "YouTube URL [bw_youtube]", $options, 'youtube', 50 );
  bw_textfield_arr( $option, "Flickr URL [bw_flickr]", $options, 'flickr', 50 );
  bw_textfield_arr( $option, "Picasa URL [bw_picasa]", $options, 'picasa', 50 );
  bw_textfield_arr( $option, "Skype Name [bw_skype]", $options, 'skype', 50 );
} 

function oik_main_shortcode_options() {
  $option = 'bw_options'; 
  $options = bw_form_start( $option, 'oik_options_options' );
  oik_contact_numbers( $option, $options );
  oik_company_info( $option, $options );
  oik_contact_info( $option, $options );
  oik_address_info( $option, $options );

  bw_textfield_arr( $option, "Google Map width", $options, 'width', 10 );
  bw_textfield_arr( $option, "Google Map height", $options, 'height', 10 );
  
  bw_textfield_arr( $option, "Domain [bw_domain] [bw_wpadmin]", $options, 'domain', 50 );
  
  bw_checkbox_arr( $option, "Do NOT use the oik.css styling. <br />Check this is you don't want to use the oik provide CSS styling", $options, "oikCSS" ); 
  bw_textfield_arr( $option, "Custom CSS in theme directory:<br />" . get_stylesheet_directory_uri(), $options, 'customCSS', 50 );
  
  oik_follow_me( $option, $options );
  
  bw_textfield_arr( $option, "PayPal email [bw_paypal]", $options, 'paypal-email', 50 );
  bw_textfield_arr( $option, "PayPal country", $options, 'paypal-country', 50 );
  
  /** Extracted from 
      @link https://www.paypalobjects.com/WEBSCR-640-20120609-1/en_US/GB/pdf/PP_OrderManagement_IntegrationGuide.pdf
      
   * AUD Australian Dollar 12,500 AUD
   * CAD Canadian Dollar 12,500 CAD
   * EUR Euro 8,000 EUR
   * GBP Pound Sterling 5,500 GBP
   * JPY Japanese Yen 1,000,000 JPY
   * USD U.S. Dollar 10,000 USD
   * whereas the list below was extracted from a WordPress plugin [bw_plug name="
   
  
  */
  $paypal_currency_list = array("GBP", "USD", "EUR", "AUD", "BRL", "CAD", "CHF", "CZK", "DKK", "HKD", "HUF", "ILS", "JPY", "MXN", "MYR", "NOK", "NZD", "PHP", "PLN", "SEK", "SGD", "THB", "TRY", "TWD");
  
  $paypal_currency_assoc = bw_assoc( $paypal_currency_list );                
  bw_select_arr( $option, "PayPal currency", $options, 'paypal-currency',array( "#options" => $paypal_currency_assoc ) );
  

  $upload_dir = wp_upload_dir();
  $baseurl = $upload_dir['baseurl'];
    
  bw_textfield_arr( $option, "Logo image [bw_logo] in uploads:<br />" . $baseurl, $options, 'logo-image', 50 );
  bw_textfield_arr( $option, "QR code image [bw_qrcode] in uploads", $options, 'qrcode-image', 50 );
  
  $artisteer_versions = array( "na", "40", "31", "30" ,"25" );
  $artisteer_assoc = bw_assoc( $artisteer_versions );
  bw_select_arr( $option, "Artisteer version [bw_art_version]", $options, 'art-version', array( "#options" => $artisteer_assoc ) );

  $options['yearfrom'] = bw_array_get_dcb( $options, "yearfrom", NULL, "bw_get_yearfrom" );
  bw_textfield_arr( $option, "Copyright from year (used in [bw_copyright])", $options, 'yearfrom', 4 );

  //tablerow( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" />" ); 
  
  bw_tablerow( array( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" class=\"button-primary\"/>") ); 

  etag( "table" ); 			
  etag( "form" );
  bw_flush();
}

function oik_usage_notes() {
  oik_require( "includes/oik-sc-help.inc" );
  p( "Use the shortcodes in your pages, widgets and titles. e.g." );
  bw_invoke_shortcode( "bw_contact", null, "Display your contact name" );
  bw_invoke_shortcode( "bw_telephone", null, "Display your telephone number." );     
  bw_invoke_shortcode( "bw_address", null, "Display your address." );
  bw_invoke_shortcode( "bw_email", null, "Display your email address." );

  bw_invoke_shortcode( "bw_show_googlemap", null, "Display a Googlemap for your primary address." );
  bw_invoke_shortcode( "bw_directions", null, "Display a button for obtaining directions to your address." );
  bw_invoke_shortcode( "bw_follow_me", null, "Show all your <b>Follow me</b> buttons" );
  
  p( "For more information about the shortcodes you can use select <b>Shortcode help</b>" );
  
  alink( "button-secondary", admin_url( "admin.php?page=oik_sc_help"), "Shortcode help", "Discover shortcodes you can use" );
  

  bw_flush();
}

/** 
 * Draw the oik options-1 page
 *
 * This page is for additional fields to enable multiple sets of bw_options, with $alt = 1;
*/
function oik_options_do_page_1() {
  oik_menu_header( "extra shortcode options", "w60pc" );
  oik_box( null, null, "alternative values using alt=1", "oik_extra_shortcode_options" );
  ecolumn();
  scolumn( "w40pc" );
  oik_box( null, null, "usage notes", "oik_extra_usage_notes" );
  oik_menu_footer();
  bw_flush();
}
  
function oik_extra_shortcode_options() {    
  $alt = "1";
  $option = "bw_options$alt";
  $options = bw_form_start( $option, "oik_options_options$alt" );
  
  /* We can't use the function blocks until they support the shortcode parameter suffix " alt=1" */ 

  bw_textfield_arr( $option, "Contact [bw_contact alt=1]", $options, 'contact', 50 );
  bw_textfield_arr( $option, "Email [bw_email alt=1]", $options, 'email', 50 );
  bw_textfield_arr( $option, "Telephone [bw_telephone alt=1]", $options, 'telephone', 50 );
  bw_textfield_arr( $option, "Mobile [bw_mobile alt=1]", $options, 'mobile', 50 );
  
  bw_textfield_arr( $option, "Extended-address [bw_address alt=1]", $options, 'extended-address', 50 );
  bw_textfield_arr( $option, "Street-address", $options, 'street-address', 50 );
  bw_textfield_arr( $option, "Locality", $options, 'locality', 50 );
  bw_textfield_arr( $option, "Region", $options, 'region', 50 );
  bw_textfield_arr( $option, "Post Code", $options, 'postal-code', 50 );
  bw_textfield_arr( $option, "Country name", $options, 'country-name', 50 );
  
  bw_textarea_arr( $option, "Google Maps introductory text for [bw_show_googlemap alt=1]", $options, 'gmap_intro', 50 );
  bw_textfield_arr( $option, "Latitude [bw_geo alt=1] [bw_directions alt=1]", $options, 'lat', 50 );
  bw_textfield_arr( $option, "Longitude [bw_show_googlemap alt=1]", $options, 'long', 50 );
 
  bw_tablerow( array( "", "<input type=\"submit\" name=\"ok\" value=\"Save changes\" class=\"button-primary\"/>") ); 
  etag( "table" ); 			
  etag( "form" );
  bw_flush();
}  
  
function oik_extra_usage_notes() {
  oik_require( "includes/oik-sc-help.inc" );
  p( "Use the shortcodes in your pages, widgets and titles. e.g." );
  bw_invoke_shortcode( "bw_contact", "alt=1", "Display your alternative contact name." );
  bw_invoke_shortcode( "bw_email", "alt=1 prefix=e-mail", "Display your alternative email address, with a prefix of 'e-mail'." );
  bw_invoke_shortcode( "bw_telephone", "alt=1", "Display your alternative telephone number." );
  bw_invoke_shortcode( "bw_address", "alt=1", "Display your alternative address." );
  bw_invoke_shortcode( "bw_show_googlemap", "alt=1", "Display a Googlemap for your alternative address." );
  bw_invoke_shortcode( "bw_directions", "alt=1", "Display directions to the alternative address." );
  bw_flush();
}

function oik_plugins_validate( $input ) {
  return $input;
}  


// Sanitize and validate input. Accepts an array, return a sanitized array.


function oik_options_validate( $input ) {
  $customCSS = bw_array_get( $input, 'customCSS', NULL );
  if ( $customCSS ) {
    $sanfile = sanitize_file_name( $customCSS );
    // Should we check the sanitized file name with the original ?
    bw_create_file( get_stylesheet_directory(), $sanfile, plugin_dir_path( __FILE__ ) . 'custom.css' );  
  }
  
  $input = oik_set_latlng( $input ); 
  
  return $input;
}

/**
 * Set the lat and lng fields for the given address
 * if the address is set but either the lat/lng is not.
 *
 */
function oik_set_latlng( $input ) {
  $long = false;
  bw_trace2( $long, "long", false);
  
  $lat = bw_array_get( $input, "lat", false );
  $long = bw_array_get( $input, "long", $long );
  
  bw_trace2( $lat, "lat" );
  if ( $lat ) {
    $latlng = explode( ",",  $lat );
    bw_trace2( $latlng, "latlng" );
    $lat = bw_array_get( $latlng, 0, $lat );
    
    $long2 = bw_array_get( $latlng, 1, false );
    $long = bw_pick_one( $long, $long2 ); 
    
    
  }
  
  $input['lat'] = $lat;
  $input['long'] = $long;
  bw_trace2( $lat, "lat" );
  bw_trace2( $long, "long",  false );
  if ( $lat && $long ) {
    /* We seem to be sorted  but they could be wrong? Let's trust the user to know what they meant. It could just be 0,0! */
  } else {
    oik_require( "shortcodes/oik-googlemap.php" );
    $input = bw_geocode_googlemap( $input );
  }
  return( $input );
}

/**
 */
function oik_buttons_validate( $input ) {
  return( $input );
}  

/**
 * Create a file with the specified name in the specified directory 
 * @param string base - the base path for the file name - may be absolute
 * @param string path - the rest of the file name - as specified by the user
 * @param string default - the fully qualified filename of the base source file to copy
 */
function bw_create_file( $base, $path, $default ) {
  $target = path_join( $base, $path );
  
  if ( !file_exists( $target ) ) {
     // create an empty file - or copy the original  
     // $info = pathinfo( $target );
     // $name = basename( $target );
     if ( $default ) {
        $success = copy( $default, $target );
     } else {
       // write an empty file
       $resource = fopen( $target, 'xb' );
       fclose( $resource );
     }
  }
}


/** 
 * Link to allow the custom CSS file to be edited 
 * @param string $customCSS Name of the custom.css file. Probably 'custom.css' 
 *
 * Note: you can't specify a relative path to this file. If you do you may see this message
 *
 *   Sorry, can't edit files with ".." in the name. 
 *   If you are trying to edit a file in your WordPress home directory, you can just type the name of the file in.
 *
 * With WPMS, the link takes you to style.css rather than custom.css. Don't know why! 
 * Actually, it's a bit more complex... the theme may be shared by multiple sites
 * so we need to further qualify the custom.css file
 * As a workaround just give it a different name than custom.css and hope for the best
 * it should really include the site ID or something
 * Note: note sure what authority is needed to view/edit the theme files.
 * 
 * For MultiSite the admin_url() is wrong - but we can use network_admin_url() for both
 * 
 * http://rowlandscastlewebdesign.com/wp-admin/network/theme-editor.php?
 * file=/home/rcwdcom/public_html/wp-content/themes/wpg0216/custom.css&theme=wpg0216&a=te&scrollto=0
 */ 
function bw_edit_custom_css_link( $customCSS, $theme ) {
  
  if ( $customCSS != NULL ) {
    global $wp_version; 
    $link = network_admin_url( "theme-editor.php" );
    $link .= '?file=';
    //$link .= 'oik/custom.css';
    if ( version_compare( $wp_version, '3.4', "ge" ) ) {
      $link .= $customCSS;
    } else {  
      $link .= path_join( get_stylesheet_directory(), $customCSS );
    }  
    $link .= "&theme=$theme";
    $img = retimage( null, oik_url( 'images/editcss_48.png') , "Edit custom CSS" );
    alink( null, $link, $img, "Edit custom CSS" ); 
  }
}  


function oik_load_plugins() {
  oik_require( "admin/oik-depends.inc" );
}  


/**
 * Display help information for all the active shortcodes
 *
 * When a shortcode is selected for further display then we invoke the __example and __snippet routine
 * **?** For some reason, when the shortcode is 'nivo' the columns get wide than normal. Don't yet know why Herb 2012/04/26
*/ 
function oik_help_do_page() {
  oik_menu_header( "shortcode help", "w95pc" );
  oik_box( null, null, "About shortcodes", "oik_code_about" );
  
  $shortcode = bw_array_get( $_REQUEST, "code", null );
  if ( $shortcode ) {
    oik_box( null, NULL, "$shortcode - more information", "oik_code_example" );
    oik_box( null, null, "$shortcode - snippet", "oik_code_snippet" ); 
  }
  oik_require( "shortcodes/oik-codes.php" );
  oik_box( null, null, "Shortcode summary", "oik_code_table" );
  oik_menu_footer();
  bw_flush();
}  

function oik_code_about() {

  p( "This page lists all the currently active shortcodes. To find out more information about a shortcode click on the shortcode name." );
  p( "Depending on how the shortcode is implemented you will either be shown some more information with one or more examples, or an 'oik generated example.' "); 
  p( "You will also be shown the HTML snippet for the example. There should be no need to do anything with this output." );
  
  p( "For further information click on the links in the <b>more oik help</b> column" );
  
}
/** 
 * Display an example of the shortcode, which may be oik generated
 */
function oik_code_example() {
  $shortcode = bw_array_get( $_REQUEST, "code", null );
  do_action( "bw_sc_example", $shortcode );
}

  
/** 
 * Display the snippet the shortcode, which may be oik generated
 */
function oik_code_snippet() {
  $shortcode = bw_array_get( $_REQUEST, "code", null );
  do_action( "bw_sc_snippet", $shortcode );
}  
  
  
function oik_code_table() {

  $shortcodes = bw_list_shortcodes( array( "ordered" => "y") );
} 

/**
 * Constants for the oik-plugins servers
 * oik-plugins.co.uk is the test site so we don't break oik-plugins.com
 * as we test oik v1.17 and the transition to oik v2.0
 */
define( 'OIK_PLUGINS_COM', "http://www.oik-plugins.com" );
define( 'OIK_PLUGINS_COUK', "http://www.oik-plugins.co.uk" );
/** 
 * Return the URL for the Premium (Pro) or Freemium version
 * 
 * THIS could also append the other parameters such as the key value pairs for registration codes
 * We're trying to find the value for 
 * 
 * $transient->response[$plugin_slug]->url
 

  // define( 'BW_OIK_PLUGINS_SERVER', "http://qw/wpit" );     
  // $url = "http://api.wordpress.org/plugins/info/1.0/";
  // $url = "http://qw/wpit/plugins/update-check/1.0/";
  // $url = "http://qw/wpit/plugins/update-check/";

 * 
 */
function oik_get_plugins_server() {
  if ( defined( 'BW_OIK_PLUGINS_SERVER' )) {
    $url = BW_OIK_PLUGINS_SERVER;
  } else {
    $url = OIK_PLUGINS_COM;
  }
  return( $url );
}

/**
 * Register this plugin as one that is served from a different server to WordPress.org
 *
 * @param string $file - fully qualified plugin file name
 * @param string $server - server name initial value - only set when the server value in the options is blank 
 * @param string $apikey - hard coded apikey initial value
 *
 * 
 * Notes: Plugins registered using the API set the default value for the server ... which may be null
 * i.e. they set the intention to be served from somewhere other than WordPress.org
 * When required we determine the actual server location AND other fields as needed during oik_query_plugins_server() 
 *
 * At least ONE plugin needs to call this API for the oik plugin server logic to be activated 
 */
function oik_register_plugin_server( $file, $server=null, $apikey=null ) {
  global $bw_registered_plugins;
  if ( !isset( $bw_registered_plugins ) ) {
    oik_lazy_altapi_init();
  }
  $bw_registered_plugins[] = array( "file" => $file, "server" => $server, "apikey" => $apikey );
  bw_trace2( $bw_registered_plugins );
}

/**
 * Return the slug part of a plugin name
 *
 * This function should only be called when we know it's a plugin name with a directory 
 *
 * Sample results
 * "slug" for "slug/plugin_name.php" - when called for "update-check"
 * "slugonly" for "slugonly" - when called for "plugin_information"
 * "hello" for "hello.php" - does this ever happen?
*/
function bw_get_slug( $plugin ) {
  $pathinfo = pathinfo( $plugin );
  $slug = $pathinfo['dirname'] ;
  if ( $slug == '.' ) 
    $slug = $pathinfo['filename'];
  return( $slug );    
}

/**
 * Return the plugins server if the requested plugin is one of ours
 * Note: $bw_registered_plugins is an array of filenames
 * we create $bw_slugs as an array of "slug" => array( 'basename' => "slug/plugin_name.php", 'file'=> 'server'=>, 'apikey'=> )
 * $bw_plugins (stored in WordPress options) also contains 'server' and 'apikey'
 * 
 */
function oik_query_plugins_server( $slug ) {
  global $bw_registered_plugins, $bw_slugs;
  if ( !isset( $bw_slugs ) ) {
    foreach ( $bw_registered_plugins as $key => $value ) {
      $file = bw_array_get( $value, "file", null );
      $plugin_basename = plugin_basename( $file );
      $bw_slug = pathinfo( $plugin_basename, PATHINFO_DIRNAME );
      $value['basename'] = $plugin_basename;
      $bw_slugs[ $bw_slug ] = $value;
    }
    bw_trace2( $bw_slugs );
  }
  $plugin_settings = bw_get_option( $slug, "bw_plugins" ); 
  bw_trace2( $plugin_settings );
  /* return the saved settings, with any registered defaults, otherwise just get the registered settings */
  if ( $plugin_settings ) {
    $server = bw_array_get( $plugin_settings, "server", null );
    $apikey = bw_array_get( $plugin_settings, "apikey", null ); 
    if ( !$server || !$apikey ) { 
       $value = bw_array_get( $bw_slugs, $slug, null );
    }   
    if ( !$server ) {   
      $server = bw_array_get_dcb( $value, "server", null, "oik_get_plugins_server" );
    }
    if ( !$apikey ) {
      $plugin_settings['apikey'] = bw_array_get( $value, "apikey", null );
    } 
  } else {
    $plugin_settings = bw_array_get( $bw_slugs, $slug, null );
    if ( $plugin_settings ) {
        $server = bw_array_get_dcb( $plugin_settings, "server", null, "oik_get_plugins_server" );
    }
    // apikey doesn't default here 
  }  

  if ( $plugin_settings ) {
    $plugin_settings['server'] = $server;
    bw_trace2( $server, "server" );  
  }
  
  return( $plugin_settings ); 
}


/** 
 * Only register our plugin server when needed
 */
function oik_lazy_altapi_init() {
  add_action( "pre_set_site_transient_update_plugins", "oik_altapi_check" );
  add_action( "site_transient_update_plugins", "oik_site_transient_update_plugins", 10, 1 );
  add_action( "plugins_api", "oik_pluginsapi", 10, 3 );
}

/**
 * If required, unset last_checked to force another "check for updates"
 * 
 * Note: Only use this when testing the oik plugin update logic
 */
function oik_site_transient_update_plugins( $transient ) {
  if ( defined( "OIK_FORCE_CHECK" ) && OIK_FORCE_CHECK ) {
    static $last_checked = null; 
    if ( !$last_checked ) {
      $last_checked = $transient->last_checked;
      unset( $transient->last_checked ); 
      bw_trace2( $last_checked, "transient" );
    }  
  }     
  bw_backtrace();
  return( $transient );
}  

function oik_altapi_check( $transient ) {
  bw_backtrace();
  oik_require( "includes/oik-remote.inc" );
  return( oik_lazy_altapi_check( $transient ) );
}

function oik_pluginsapi( $false, $action, $args ) {
  oik_require( "includes/oik-remote.inc" );
  return( oik_lazy_pluginsapi( $false, $action, $args ) );
}

/**
 * Perform plugin relocation just before the plugins are listed on the admin page
 * for action: pre_current_active_plugins
 */
function bw_relocate_pre_current_active_plugins( $plugins ) {
  oik_require( "admin/oik-relocate.inc" );
  bw_lazy_relocate_pre_current_active_plugins( $plugins );
}

/** 
 * Add a plugin relocation to the $bw_relocations list
 * @param string $from - from plugin basename
 * @param string $to - to plugin basename
 */
function bw_add_relocation( $from, $to ) {
  global $bw_relocations;
  if ( !isset( $bw_relocations ) ) {
    $bw_relocations = array();
  }
  $bw_relocations[ $from ] = $to;
  bw_trace2( $bw_relocations );
}

