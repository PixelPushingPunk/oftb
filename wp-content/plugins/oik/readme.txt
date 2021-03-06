=== oik ===
Contributors: bobbingwide
Donate link: http://www.oik-plugins.com/oik/oik-donate/
Tags: shortcodes, PayPal, buttons, Artisteer, widget, key information, trace, blocks, buddypress, pages, bookmarks, images, attachments, smart, lazy
Requires at least: 3.0.4
Tested up to: 3.4.2
Stable tag: 1.17
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Lazy smart shortcodes for displaying often included key-information and other WordPress content. Over 70 shortcodes to use anywhere on your website.
== Description ==
The *oik base* plugin provides a series of advanced WordPress shortcodes that help you display dynamic content from your website's pages, posts, attachments, links and custom post types.
There are 70 shortcodes including:

* [bw_pages], [bw_posts], [bw_thumbs], [bw_attachments], [bw_images], [bw_pdf] shortcodes to list subpages, posts, attachments or custom post types 
* [bw_list], [bw_tree] to display lists of links to pages, posts, attachments or custom post types 
* [bw_table] to tabulate pages, posts or custom post types
* [bw_bookmarks] to list links
* [paypal] shortcodes for PayPal buttons: Pay Now, Buy Now, Donate, Add to Cart, View Cart/Checkout
* [bw_block] & [bw_eblock], [div] & [ediv], [clear] - to create block structures within your pages, posts and even widgets
* [bw_button], [bw_contact_button] - to provide call-to-action button style links for Artisteer themes
* helper shortcodes for web designers and developers: [bw_editcss], [bwtrace], [bw_page], [bw_post], [bw_wpadmin], [bw_wtf], [stag] & [etag]

oik helps you to display information about you, your company, your social networking ids and your website using standard formats that search engines such as Google recognise.

* You enter your information once, then use oik shortcodes to display it wherever you want; in titles, post and page content, header, sidebar and footer widgets.
* Whenever you need to change a value you only need to update it in one place; and your website is updated instantly.
* Shortcodes to display often included key information include: [bw_contact], [bw_telephone], [bw_mobile], [bw_mailto], [bw_company], [bw_address], [bw_show_googlemap], [bw_directions], [bw_logo], [bw_qrcode], [bw_copyright]
* For your social networking "follow me" sites use the [bw_follow_me] shortcode to display your links to Twitter, Facebook, LinkedIn, Google+, etcetera

Features: 

* oik provides buttons to help you write the shortcodes, showing you the parameters you can choose and default values 
* oik provides a shortcode discovery page where you can find out about every shortcode which is active in your site
* lazy programming means that code is only loaded when it's actually needed
* smart means that the shortcodes can recognise the content in which they're used and adjust their behaviour accordingly
* oik is extendable - plugin developers can build on the oik base functionality 
* using the oik API: help, syntax information, examples AND HTML snippets can be produced for any plugin or theme that provides shortcodes
* oik is theme independent; meaning that you can change your theme without having to worry about whether or not the shortcodes will still work.
* oik uses microformats so that Google and other search engines can understand your content.

== Installation ==
1. Upload the contents of the oik plugin to the `/wp-content/plugins/oik' directory
1. Activate the oik base plugin through the 'Plugins' menu in WordPress
1. Go to **oik options** > **options** to fill in your **o**ften **i**ncluded **k**ey information
1. Use the shortcodes when writing your content
1. Activate other oik plugins when you need them


== Frequently Asked Questions ==
= Where is the FAQ? =
[oik FAQ](http://www.oik-plugins.com/oik/oik-faq)

= Is there a support forum? =
Yes - please use the [oik plugin forum](http://wordpress.org/support/plugin/oik)

= Can I get support? = 
Yes - see above 

= Where are the shortcodes documented? =

[oik shortcodes](http://www.oik-plugins.com/shortcodes)

The shortcode reference also includes the standard WordPress shortcodes and help for other shortcodes provided WordPress and other selected plugins (e.g. Easy-Digital-Downloads)

= Where are the APIs documented? =
[oik APIs](http://www.oik-plugins.com/apis) 

The Application Programming Interface (API) reference is constantly being updated

== Screenshots ==
1. oik overview - main settings page
1a. Custom CSS and the [bw_editcss] shortcode
1b. Often included key information settings
1c. Alternative values for oik settings, using the alt=1 shortcode parameter
1d. Button selection - choose the buttons to add to the TinyMCE and HTML editor toolbars
1e. Shortcode help page - Discover all the currently active shortcodes
1f. Shortcode example on the help page - showing [bw_show_googlemap] output
2. Demonstrating [bw_pages] and [bw_thumbs] (and [bw_wtf)
3. Shortcode help, syntax and examples - [bw_contact_button]
4. Shortcode snippets - [bw_address] 
5. email signature file generation using [bw_email_signature]
6. oik button dialog - to create the [bw_button] shortcode
7. oik PayPal dialog - create PayPal buttons: Pay Now, Buy Now, Donate, Add to Cart and View Cart/Checkout
7a. PayPal buttons using the [paypal] shortcode
8. oik shortcodes dialog - showing syntax for [bw_block]
9. oik header image plugin - custom header image for a page 

== Upgrade Notice ==
= 1.17 =
This new version includes support for FREE and Premium oik plugins which are hosted on www.oik-plugins.com (or www.oik-plugins.co.uk) rather than WordPress.org
Child plugins relocate themselves when activated. Child plugins have a version number of 1.18 
WordPress Multi Site users should read the guidance at [oik base plugin v1.17 and WordPress Multi Site](http://www.oik-plugins.com/2012/11/oik-base-plugin-v1-17-and-wordpress-multi-site/) 

= 1.16 = 
Contains a fix for Fatal error: Call to undefined function oik_require() in oik\admin\oik-header.inc on line 2

= 1.15 =
Contains a bug fix preventing oik-nivo-slider working on admin pages: oik options > nivo settings

= 1.14 =
oik version 1.14 contains a fix for oik-nivo-slider on sites where jquery.js is not automatically loaded by the theme or other plugins
It also includes changes for the cookie-cat plugin and website.

= 1.13 = 
oik version 1.13 is required for the new oik-privacy-policy plugin. 

= 1.12 =
Upgrade oik to version 1.12 before updating oik-nivo-slider to version 1.2. For more information see:
[oik-nivo-slider-v1.2 for oik v1.12](http://www.oik-plugins.com/2012/04/oik-nivo-slider-v1-2-for-oik-v1-12-now-in-alpha-test/)

= 1.11 =
There are many changes in version 1.11 to support lazy invocation of code.  
Some plugins have been created as separate plugins (e.g. uk-tides). Others have been changed so that you can activate them by changing oik settings, so are no longer activatable.
 

== Changelog ==
= 1.17 =
* Added: bw_wp_error() and includes\bw_error.inc - wrapper to WP_error
* Added: support for plugin relocation during "pre_current_active_plugins"
* Added: support for receiving updates and plugin information from diverse plugin repositories (e.g. www.oik-plugins.com or www.oik-plugins.co.uk )
* Added: oik_register_plugin_server() to allow a plugin to specify its source repository for updates 
* Added: BW_OIK_PLUGINS_SERVER constant defaults to http://www.oik-plugins.com, if not defined in wp-config.php
* Added: admin\oik-relocate.inc to perform plugin relocation
* Changed: bw_thumbnail() and bw_get_thumbnail_size() to improve support for thumbnail image size selection
* Changed: bw_get_post() - add $atts parameter, allow $post_id to be either the post ID or name
* Added: Added bw_remote_post() to includes\oik-remote.inc. Used by oik_lazy_altapi_check()
* Changed: bw_invoke_shortcode() - make $text parameter optional
* Fixed: Use bw_thumbnail_full() to find the file name for the full size image attachment. No longer relies on $post->guid
* Changed: Improved some phpdoc comments - part of API documentation
* Added: bw_emailfield(), iemail() and isubmit()
* Changed: bw_textfield() and bw_textfield_arr() to support for HTML 5 input field parameters and jQuery validation
* Added: "oik_admin_menu" action, to allow dependent routines to know when oik has responded to "admin_menu".
* Added: Support for select fields in admin page lists (oik-fields plugin)
* Added: apikey support for premium plugins
* Added: Plugins menu item to define plugin settings ( server and API key ) and perform a manual check for updates
* Changed: readme.txt
* Added: bw_load_noderef() now supports multiple post_types
* Added: noderef meta field supports #optional parameter
* Added: iradio() and bw_radio() APIs in order to support the jQuery star rating plugin
* Added: OIK_FORCE_CHECK constant for use during debugging only
* Changed: ihidden() always produces a hidden input field regardless of the value
* Added: bw_current_url() - return the current URL
* Changed: Improved support for multisite requests to an oik plugins server
* Changed: started decoupling action trace from basic trace functions (oik-bwtrace plugin)
* Changed: [bw_pages] now supports custom text for "read more" links extracted from the <!--more custom read more text -->
* Changed: bw_excerpt() restructured to support shortcode expansion using the "get_the_excerpt" filter
* Changed: Inclusion of oik.css is now optional.
* Changed: oik.css should better respect your theme's styling. e.g. Attachment links now have class bw_attachment
* Changed: Altered generated HTML for a number of shortcodes in line with oik.css changes 
* Changed: bwlink.css is now only enqueued by the oik-bob-bing-wide plugin. Note: A lot of oik.css was moved to bwlink.css
* Deleted: deprecated; bw_add_ajaxurl(), bw_preload_button_options(), oik_optional_plugins()
* Fixed: Corrected syntax help for the [div] shortcode
* Fixed: bw_format_attachment() no longer produces an empty link when no image is required
* Changed: bw_array_get_dcb() will accept null parameters e.g. [bw_email prefix='' suffix='']
* Added: Syntax help for quite a few shortcodes where the parameters were previously undocumented: bw_address, bw_email and variations, bw_tel and variations, bw_copyright, bw_qrcode, bw_attachments, bw_pdf, bw_portfolio, bw_codes, sdiv, stag, etag
* Added: bw_emailfield_arr()
* Changed: Improved support for shortcode help
* Changed: bw_validate_torf() now accepts "on" as true 
* Changed: [bw_plug] (activated by oik-bob-bing-wide plugin) supports oik-plugins servers
* Added: includes/oik-filters.inc providing new functions to replace and restore filters 
* Changed: Wrapped the separator string for bw_telephone in a span, enabling it to be styled using custom CSS.
* Changed: All child plugins now use version 1.18
* Fixed: Comments should no longer be assigned to the wrong post. Calls to setup_postdata() eliminated.
* Added: [bw_list] and [bw_post] now support the thumbnail parameter - default "none"
* Added: Support for nivo jQuery 3.1 - by allowing the addition of the data-thumb attribute to img tags
* Added: Support for themes built using Artisteer 4.0
* Changed: [bw_block] and [bw_eblock] are much simpler for Artisteer 4.0 themes
* Changed: Removed [wp-1], [wp-2] and [wp-3] shortcodes - they were only used to test ticket #17657 

= 1.16 =
* Fixed: Fatal error: Call to undefined function oik_require() in oik\admin\oik-header.inc on line 2
* Added: CSS to disable the background image for links to .pdf files ( selector: div.noicon a )

= 1.15 =
* Fixed: New solution for bw_jquery() API broke oik-nivo-slider on admin pages
* Added: Support for [bw_table] shortcode

= 1.14 =
* Added: oik-options - use Google geocoding to find latitude and longitude if not specified
* Added: oik-fields plugin supports display of custom columns in admin list; currency, numeric, date, select and noderef 
* Added: API - bw_get_active_plugins() - to list active plugins for WordPress OR WordPress Multisite
* Added: API - bw_get_post() - wrapper to get_posts to load the post identified by ID $post_id AND $post_type
* Added: API - bw_get_theme() - wrapper to WordPress functions to get the current theme.
* Added: API - bw_remote_get() - wrapper to wp_remote_get(). Used in geocoding
* Added: Add support for textarea metadata for custom post types
* Changed: oik-header now works for child themes of "Twenty Eleven"
* Changed: oik options - PayPal currencies offered in a select list
* Changed: oik options - Artisteer versions offered in a select list
* Changed: [bw_editcss] support for WP 3.4 and above. 
* Changed: API - bw_trace2() supports a 3rd parameter $show_args. Default=true. Slightly easier than using bw_trace()
* Changed: API - bw_jquery() for oik-nivo-slider when jquery.js is not already included before </head>
* Changed: API - bw_format_attachment() - default 'n' for block parameter
* Fixed: API - bw_load_noderef() requires includes/bw_posts.inc
* Fixed: Renamed quote() to bw_quote() due to function naming conflict
* Fixed: Fixed more "Notices" messages for the [sediv] shortcode

= 1.13 = 
* Added: Support for oik-privacy-plugin - new APIs below 
* Added: Support for custom links on images. This change enhances [bw_images] and [nivo] (see the oik-nivo-slider plugin)
* Added: API - bw_image_get_link() - get the custom link or permalink for an attachment
* Added: API - bw_textarea_cb_arr() - displays an textarea matched with a checkbox
* Added: API - bw_recreate_options() - alter the value of "autoload" for a WordPress option fieldd
* Added: API - bw_term_array() - build a simple ID, title array from an array of $term objects
* Added: API - bw_datepicker_enqueue_script() - enqueue the jQuery UI datepicker
* Added: API - includes/oik-menus.inc for nav menu functions
* Added: API - bw_form_start() - start a WordPress form for options fields
* Added: API - bw_reset_options() - reset or initialise an options field to "latest" defaults 
* Changed: bw_jquery() - added $windowload parameter for jQuery(window).load (when true) or jQuery(document).ready (when false = default)
* Changed: bw_tablerow() doesn't produce a row if the $td_array is empty
* Changed: TinyMCE buttons now default to "on" when first displayed on the oik options > Buttons page 
* Fixed: Dependency checking didn't work in WordPress MultiSite installations.
* Fixed: Eliminated "Notices" displayed when oik options is first displayed.

= 1.12 =
* Added: oik extra shortcode options for shortcodes with alternative values ( alt=1 keyword )
* Added: shortcode help page - listing all current shortcodes
* Added: new function to assist in earlier detection of action or filter processing (oik trace actions)
* Added: support for dependent plugins to indicate the minimum required plugin version
* Added: link to "Getting started with oik plugins"
* Added: New functions to set jQuery JSON parms from WordPress options
* Added: License: and License URI: 
* Changed: Improved styling of admin pages
* Changed: Improved logic for the shortcodes that support the alt=1 keyword ( [bw_mailto], [bw_contact], [bw_telephone], [bw_mobile], [bw_address], [bw_show_googlemap], [bw_geo], [bw_directions] )
* Changed: User configurable Google Maps intro text replaces hardcoded version
* Changed: Improved "usage notes"
* Changed: Improved display of oik action options page
* Changed: Improved display of oik trace options page
* Changed: bw_backtrace() is now a lazy API
* Changed: Improved logic for producing shortcode examples and snippets, adding support for "oik generated examples"
* Changed: More help, syntax and example logic for shortcodes including: [bw_bookmarks], [bwtrace]
* Changed: [paypal] shortcode now accepts the country (default "GB") and currency (default "GBP")
* Changed: [bw_contact] now uses the microformat for an hCard (span classes are vcard and fn (full name))
* Changed: API changes to support alt=1 parameter: bw_default_empty_att() 
* Changed: Copyright statement suffix text now overrideable e.g. [bw_copyright suffix="copyright suffix"] 
* Changed: API changes in bobbforms.inc: iarea() - added rows parameter, icheckbox() - returns a value when checkbox is not selected
* Changed: added more bd-nnn class names for { min-height: nnnpx; } for non Artisteer themes
* Changed: optional plugins link to their own page on oik-plugins.com
* Fixed: some of the shortcode help one-liners. Also set default to '?' for unknown/undocumented shortcodes
* Fixed: Individual "follow me" shortcodes don't display the link address
* Fixed: [lxx] shortcodes should not expand in titles (oik-bob-bing-wide plugin)

= 1.11 = 
* Added: "oik_loaded" actions for lazy initialisation of dependent plugins.
* Added: AJAX enabled dialog for listing shortcodes, showing syntax and providing further information online
* Added: CSS support for responsive images
* Added: Improved support for nested shortcodes being expanded in excerpts
* Added: [bw_code] shortcode to display help, syntax, example, live example and snippet for a shortcode
* Added: [bw_codes] table to summarise active shortcodes
* Added: [bw_power] shortcode for "Proudly powered by WordPress" link to WordPress.org
* Added: [bw_thumbs] shortcode - shows the thumbnail images as links
* Added: action and filter logging, an optional addition to tracing (for developers)
* Added: edit custom CSS button (for developers and designers) 
* Added: files for deprecated functions - but these are TOTALLY lazy
* Added: help and syntax information for (some) NextGEN and Portfolio slideshow shortcodes
* Added: help and syntax information for the NextGEN [nggallery] shortcode
* Added: shortcode quicktag (labelled [] ) with jQuery code shared with th existing TinyMCE buttons
* Added: shortcodes can now provide: help, syntax, examples, live examples and snippets
* Added: trace options, trace actions and trace reset buttons
* Changed: Improved API for form fields
* Changed: PayPal shortcodes support currency (e.g. 'GBP') and location (e.g. 'GB') parameters
* Changed: TinyMCE button selection is now part of the oik settings menu
* Changed: [bw_logo] now includes jQuery code to automatically resize the image when displayed in a text widget in an Artisteer header
* Changed: [bw_wtf] now prints the raw content of the post 
* Changed: added shortcodes folder where the lazy shortcode logic is implemented
* Changed: code only needed for admin pages has been made lazy
* Changed: oik options is now in its own submenu with a dashboard like overview page
* Changed: restructured to make shortcodes lazy
* Changed: trace functions are very lazy
* Fixed: CSS to fix a problem with GoogleMap's images on "responsive" sites
* Fixed: Changed CSS fix for Artisteer nested blocks; original solution broke hmenus
* Fixed: edit custom CSS links works on Multisite
* Fixed: elimination of as many "Notice" messages as possible 

= 1.10 =
* Added: [bw_attachments] for listing attachments 
* Added: [bw_pdf] for .pdf type attachments
* Added: [bw_tree] for producing a hierarchical tree of children of a 'page'
* Added: [bw_posts] for producing a simple list of posts
* Added: [bw_copyright] for use in footers
* Added: Introduced support for lazy shortcodes - where the shortcode function is not loaded until it's needed
* Added: [stag] and [etag] shortcodes to use when using the HTML doesn't seem to work
* Added: oik-boot.inc and changed oik_path to accept $file parameter
* Added: [bwtrace] button for easier access to trace reset
* Changed: better array/object detection in bw_array_get() 
* Changed: added bw_array_get_dcb() where dcb = deferred callback. It only calls the callback function for the default when needed.
* Changed: default function for bw_array_get_dcb is __() - to allow for i18n 
* Changed: Update Copyright years throughout
* Changed: alter custom header background image styling so that it does not repeat 
* Changed: oik.css - added some additional styling - early support for responsive blocks
* Fixed: Fixed problem where shortcode escaping did not work. [[oik]] will now become [oik] 
* Fixed: Added missing shortcode function for [bw_picasa]
* Fixed: Added missing bw_block_25.inc - even though it may not be correct for Artisteer 2.5 
= 1.9 =
* Added: oik-bbpress to cater for expanded shortcodes in titles used as text attributes
* Added: oik-header support for custom header background images with the Twenty Eleven theme
* Changed: [bw_wtf] now prints the post or page id (only works for the main post, not nested posts)
* Changed: wrote a brief comment about ticket #17567 and shortcodes with hyphens
= 1.8 = 
* Added: [bw_blockquote] and [bw_cite} shortcode - to overcome problems with wpautop()
* Added: cite() function for bw API
* Changed: Improved default processing for [bw_pages] and [bw_list] when used without parameters in a 'post' or a 'page' 
* Changed: stylesheets enqueued during the 'wp_enqueue_scripts' action hook (change for WP 3.3)
= 1.7 =
* Added: extra parameter to alink() to support additional fields in the anchor (<a>) tag
* Added: oik-bp-signup-email - to direct the verification email to the site admin rather than the registrant
* Added: oik-fields plugin - for [bw_field] (alias [bw_fields]) shortcode - display custom fields within the content
* Added: oik-header plugin - custom header images for pages or posts
* Added: oik_path() and oik_require() functions
* Changed: image/retimage API: title defaults to NULL - so can be omitted
* Fixed: [bw_pages] if the post_type is page, no longer set post_parent automatically 
= 1.6 =
* Added: [bw_bookmarks] shortcode - equivalent to the Links widget
* Added: [bw_list] shortcode - a simple list of links for any post type
* Added bw_trace2() function - improved (easier to code) wrapper to bw_trace()
* Changed: custom.css should be embedded after style.css (and other stylesheets. e.g. buddypress stylesheets)
* Changed add parameters ( me and url) to the "follow me" shortcodes - to set values for 'me' and the social media url
* Changed: oik-bwtrace. The notes suggest .loh for a the log file extension. 
* Changed: [bw_plug] tries to help with plugin names
* Fixed: bw_backtrace() first checks if trace is enabled.
* Fixed: ability to specify a custom image size for [bw_pages]  e.g. [bw_pages thumbnail=80] or [bw_pages thumbnail="120x80"]
* Fixed: more clearly shows where the customCSS file will reside... in the current theme directory
= 1.5 = 
* Changed: [clear] now expands to two classes: clear and cleared
* Fixed: reduced more warnings that were produced when WP_DEBUG is set
* Added: bw_wp_title() - use to return a nice SEO title when WordPress SEO may or may not be activated
* Added: options to tracing to include or exclude information that can help or hinder problem determination
* Changed: Default to not showing the address type as Work - hidden by CSS
* Added: Option to edit the custom CSS file using standard WordPress functions
* Changed: Custom CSS file now expected to be in the stylesheet directory.
* Added: Dummy custom CSS file created in stylesheet diretory, if defined but not already present
* Added: Initial support for selecting custom post types in [bw_pages] shortcode, restricting by category 
* Fixed: [bw_pages] shortcode excludes the current post. Needed to prevent recursion in strange scenarios
* Changed: update [bw_tides] to reflect changes to the XML in the RSS feed from http://www.tidetimes.org.uk
= 1.4 =
* Added: oik-pages plugin for [bw_pages] shortcode to list subpages, optionally within [bw_block]s
* Added: [bw_block]/[bw_eblock] now supports themes generated with Artisteer 3.1 beta versions ( v3.1.0.44079 and v3.1.0.42580 )
* Added: option to specify which version of Artisteer was used to generate your theme: 31, 30, 25, or na
* Added: Basic support for using [bw_block] when NOT using an Artisteer theme
* Changed: Documentation has been migrated to www.oik-plugins.com/oik
* Changed: some improvements to the bw API
* Fixed: reduced some warnings that were produced when WP_DEBUG is set
* Changed: oik-bwtrace changes to aid problem determination after a change has been made
* Changed: Added support for BuddyPress filter - bp_screens 
= 1.3.1 =
* Changed: Lost another fight with SVN :-( 
= 1.3 = 
* Changed: [bw_show_googlemap] now uses V3 of the GoogleMap API so a GoogleMap API key is no longer needed
* Added: Parameters to [bw_show_googlemap] allowing more than one GoogleMap. 
* Added: [div]/[sdiv], [ediv] and [sediv] shortcodes for &lt;div&gt; tags
* Added: support for Artisteer art-blockcontent and heading background images
* Added: [bw_emergency] for Emergency phone number
* Added: [bw_abbr] for company abbreviation e.g. bw = bobbing wide
* Fixed: [gpslides] - safer invocation of Slideshow Gallery Pro
* Fixed: bw_shortcode_event() will only call the shortcode expansion and post processing function if it exists
* Added: [art] and [lart] shortcodes for Artisteer
* Added: [bp] and [lbp] shortcodes for BuddyPress
* Fixed: includes the emergency fix applied to oik version 1.2
* Added: Styling for [wp], [bp], [drupal] and [art] shortcodes
= 1.2 =
* Added: oik-blocks - [bw_block] and [bw_eblock] shortcodes for creating Artisteer style blocks within your content
* Added: [bw_logo] and [bw_qrcode] shortcodes - to include your logo image and QR code images on your pages.
* Added: [lbw] shortcode - Links to various Bobbing Wide websites
* Added: [wp] [wpms] and [drupal] shortcodes - for WordPress, WordPress Multisite and Drupal 
* Added: [lwp] [lwpms] and [ldrupal] shortcodes - links to WordPress.org and Drupal.org
= 1.1 =
* Added: Safe shortcode expansion. Shortcode expansion is now sensitive to the current filter. 
* Added: Dummy handling of wp_footer when current_filter() does not return a filter name
* Added: cacheing of plugin information pulled from WordPress.org
* Added: [bw_plug] supports multiple plugin names to automatically create a table of different WordPress plugins
* Added: [bw_plug option='active_plugins'] to list active plugins
* Added: [OIK] expands to Often Included Key-information
* Fixed: Problem with missing bw_oik() function 
* Fixed: Renamed "oik-bwtrace" to "oik bwtrace" to allow "oik" to be the plugin that gets activated by default
= 1.0 =
* Fixed: Hopefully this contains what should have been in 0.9
= 0.9 =
* Added: oik-email-signature to help you generate an email signature file for your email client
* Added: [bw_follow_me] shortcode for easy to include Follow me links for Twitter, Facebook, LinkedIn, GooglePlus, YouTube, Flickr
* Added: bw_gallery() function for use in customised themes 
= 0.8 =
* Added: [bw_googleplus] shortcode - follow me on GooglePlus
* Added: [bw_contact_button] shortcode - for Contact me buttons
* Added: [gpslides] 
= 0.7 = 
* Added: [bw_skype] shortcode to display your skype name
* Added: [bw_tides] shortcode - tide times in the UK
* Added: [bw_directions] shortcode - get Google directions to your chosen location
* Added: [ngslideshow] shortcode for co-existence of NextGen gallery and Slideshow Gallery Pro
* Fixed: invalid XHTML generated for fob, bong hide shortcodes
* Added: Support for Drupal versions of Add post and Add page buttons
= 0.6 =
* Added: Ability to select [bw_tel] and [bw_mob] from the oik shortcode button in Tiny MCE
* Added: [bw_module] shortcode - similar to [bw_plugin] but for Drupal modules
* Fixed: Correct version numbers for the Drupal module version
= 0.5 =
* Added: [bw_tel] and [bw_mob] - inline versions of [bw_telephone] and [bw_mobile]
* Fixed: plugin versions should be correct
= 0.4 = 
* Added: [bw_post] and [bw_page] buttons for easy creation of New Posts and Pages
* Changed: icons for TinyMCE
* Added parameter to pass CSS id field to alink()
* Added [bw_plug name="plugin-name" link="URL" info="y/n"] shortcode for displaying information about WordPress plugins
= 0.3 =
* Added: Tiny MCE button for entry of the [bw_button] shortcode parameters
* Added: Tiny MCE button to select an oik shortcode 
* Note: optional parameters to the oik shortcode button are not yet effective
* Added: [bw_email] for inline mailto: link. Use [bw_mailto] for a link with a prefix
* Fixed: attempted to correct problems in this file - my misunderstanding of how to do links
* Fixed: Added code to expand [bw_picasa] shortcode
* Added: [loik] shortcode - a link to the oik plugin
* Change: Moved art_button() to bobbfunc.inc so that it could be used on the oik options page
= 0.2 =
* Added shortcodes for [bw_flickr], [bw_youtube], [bw_picasa]
* renamed bwtrace.php to oik-bwtrace.php 
= 0.1 =
* initial version 

== Further reading ==
If you want to read more about the oik plugins then please visit the
[oik plugin](http://www.oik-plugins.com/oik) 
**"the oik plugin - for often included key-information"**

Up to and including version 1.17 the oik plugin includes a number of optional modules which can be activated as and when you need them.

In oik version 1.17, any activated module will automatically relocate itself to become a separately maintainable plugin.
Each individual plugin will be supported from an oik-plugins server. 
In a future version of oik, the child plugins will be deprecated and/or removed from the oik base package.
The version number of child plugins delivered with oik v1.17 is v1.18.

Plugins that will relocate and be served from the oik-plugins servers are:

* [oik-bbpress](http://www.oik-plugins.com/oik-plugins/oik-bbpress-strip-tags-from-bbpress-forum-title-tooltips/) - to strip tags from bbPress forum title tooltips  
* [oik-bob-bing-wide](http://www.oik-plugins.com/oik-plugins/oik-bob-bing-wide-more-lazy-smart-shortcodes/) - to provide more lazy smart shortcodes: [bw_plug], bob/fob bing/bong wide/hide wow, oik and loik, wp, wpms, bp, artisteer, drupal
* [oik-bp-signup-email](http://www.oik-plugins.com/oik-plugins/oik-buddypress-signup-email/) - to intercept BuddyPress registration emails
* [oik-bwtrace](http://www.oik-plugins.com/oik-plugins/oik-bwtrace-debug-trace-for-wordpress/) - provides an advanced WordPress trace debug function, which logs trace information to a file, rather than including it within the web page output
* [oik-email-signature](http://www.oik-plugins.com/oik-plugins/oik-email-signature/) - to help generate an email signature file for all your email messages
* [oik-fields](http://www.oik-plugins.com/oik-plugins/oik-fields-custom-post-type-field-apis/) - custom post type field APIs 
* [oik-header](http://www.oik-plugins.com/oik-plugins/oik-header-custom-header-image/) - for custom page header image selection for pages, posts and custom post types
* [oik-sc-help](http://www.oik-plugins.com/oik-plugins/oik-sc-help-shortcode-help-shortcodes/) - shortcode help shortcodes: provides [bw_code] and [bw_codes] shortcodes
* [oik-sidebar](http://www.oik-plugins.com/oik-plugins/oik-sidebar-widget-wrangler-for-artisteer-themes/) - gives you the ability to use Widget Wrangler with Artisteer v3 themes

Other plugins which use the oik API are also available on WordPress.org: 

* [oik-nivo-slider](http://wordpress.org/extend/plugins/oik-nivo-slider/) - [nivo] shortcode for the jQuery "Nivo slider" for posts, pages, attachments and custom post types
* [oik-privacy-policy](http://www.wordpress.org/extend/plugins/oik-privacy-policy) - generate a privacy policy page, compliant with UK cookie law (EU cookie directive)
* [cookie-cat](http://www.wordpress.org/extend/plugins/cookie-cat) - [cookies] shortcode to list the cookies your website may use
* [uk-tides](http://wordpress.org/extend/plugins/uk-tides/) - [bw_tides] shortcode for tide times and heights in the UK  (replaces oik-tides)
* [bbboing](http://www.wordpress.org/extend/plugins/bbboing) - obfuscate text but leave it readable

More FREE and Premium plugins are available from [oik-plugins.com](http://www.oik-plugins.com)

oik plugins are suitable for:
* site owners
* site administrators
* WordPress designers
* web site developers 
* plugin developers

oik plugins are tested with: WordPress Multi Site, BuddyPress and bbPress.


ALL of the plugins are developed using a set of functions that can make PHP and HTML coding a bit easier. 
These are known as the OIK Application Programming Interface (OIK API).


If you're interested in a Drupal version then please visit the 
[oik module](http://www.bobbingwidewebdevelopment.com/content/often-included-key-information-oik-drupal-module)

