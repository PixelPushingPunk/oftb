<?php
error_reporting(0);
@ini_set('display_errors', 1);
if (!defined('DS')) { 
	define('DS', '/'); 
}
/*$Gallery = new SatelliteGallery();*/
$root = __FILE__;
for ($i = 0; $i < 6; $i++) $root = dirname($root);
	if (!defined('DS')) { define('DS', '/'); }require_once($root . DS . 'wp-config.php');require_once(ABSPATH . 'wp-admin' . DS . 'admin-functions.php');if(!current_user_can('edit_posts')) die;do_action('admin_init');
  error_log("running the tinyMCE for Satellite Slideshow");
  require_once(WP_PLUGIN_DIR . '/slideshow-satellite/models/gallery.php');
  $Gallery = new SatelliteGallery();
  $galleries = $Gallery->getGalleries();

  ?>
	
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head>	
	
	<title><?php _e('Insert a slideshow', SATL_PLUGIN_NAME); ?></title>	
	<script language="javascript" type="text/javascript" src="<?php bloginfo('wpurl'); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>	
	<script language="javascript" type="text/javascript" src="<?php bloginfo('wpurl'); ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>	
	<script language="javascript" type="text/javascript" src="<?php bloginfo('wpurl'); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>	
	<script language="javascript" type="text/javascript" src="<?php bloginfo('wpurl'); ?>/wp-includes/js/jquery/jquery.js"></script>	
	<script language="javascript" type="text/javascript">
var _self = tinyMCEPopup;
function insertTag() {
    var satellite_type = jQuery('input[name="satellite_type"]:checked').val();
    var auto = jQuery('input[name="auto"]:checked').val();
    var thumbs = jQuery('input[name="thumbs"]:checked').val();
    var caption = jQuery('input[name="caption"]:checked').val();
    if (satellite_type == "post") {
        var post_id = jQuery('#post_id').val();
        var exclude = jQuery('#exclude').val();
        if (post_id == "th") {
            var tag = '[satellite';
        } else {
            var tag = '[satellite post_id=' + post_id + '';
        }
        if (exclude != "") {
            tag += ' exclude="' + exclude + ' "';
        }
        if (auto == undefined) { tag += '';} else { tag += ' auto=' + auto+'';}	
        if (caption == undefined) { tag += '';} else { tag += ' caption=' + caption;}		
        if (thumbs == undefined) { tag += ']';} else { tag += ' thumbs=' + thumbs + ']';}		
    } else if (satellite_type == "custom") {
        var gal_id = jQuery('#gal_id').val();

        var tag = '[satellite gallery='+ gal_id +'';
        if (auto == undefined) { tag += '';} else { tag += ' auto=' + auto;}		
        if (caption == undefined) { tag += '';} else { tag += ' caption=' + caption;}	
        if (thumbs == undefined) { tag += ']';} else { tag += ' thumbs=' + thumbs + ']';}		
		
    }
    if (window.tinyMCE) {
        window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tag);
        tinyMCEPopup.editor.execCommand('mceRepaint');
        tinyMCEPopup.close();
    }
}
function closePopup() {
    tinyMCEPopup.close();
}
	</script>		
	<style type="text/css">		table th { vertical-align: top; }		.panel_wrapper { border-top: 1px solid #909B9C; }		.panel_wrapper div.current { height:auto !important; }		#product-menu { width: 180px; }	</style>	
	</head>
	<body>
	<div id="wpwrap"><form onsubmit="insertTag(); return false;" action="#">	
		<div class="panel_wrapper">
		<label style="font-weight:bold; cursor:pointer;"><input onclick="jQuery('#post_div').show();" type="radio" name="satellite_type" value="post" id="type_post" /> <?php _e('Images From a Post', SATL_PLUGIN_NAME); ?></label><br/>
		<label style="font-weight:bold; cursor:pointer;"><input onclick="jQuery('#post_div').hide();jQuery('#custom_div').show();" type="radio" name="satellite_type" value="custom" id="type_custom" /> <?php _e('Images From a Custom Gallery', SATL_PLUGIN_NAME); ?></label>
		<div id="custom_div" style="display:none">
      <p>
        <label for="post_id" style="font-weight:bold;"><?php _e('Gallery', SATL_PLUGIN_NAME); ?>:</label><br/>
		<?php if (!empty($galleries)) : ?>
			<select name="gal_id" id="gal_id">
				<option value="">- <?php _e('Select a Gallery', SATL_PLUGIN_NAME); ?></option>
				<?php foreach ($galleries as $gallery) : ?>
				<option value="<?php echo $gallery['id']; ?>"><?php echo $gallery['title']; ?></option>	
				<?php endforeach; ?>
			</select>
		<?php endif;?>
		</p>

			<?php echo showInBoth(); ?>
		</div>
		<div id="post_div" style="display:none;">
		<p>
		<label for="post_id" style="font-weight:bold;"><?php _e('Post', SATL_PLUGIN_NAME); ?>:</label><br/>
		<?php if ($posts = get_posts(array('orderby' => "post_title", 'order' => "ASC", 'post_type' => "post", 'post_status' => ""))) : ?>
			<select name="post_id" id="post_id">
				<option value="">- <?php _e('Select a Post', SATL_PLUGIN_NAME); ?></option>
				<option value="th"><?php _e('THIS POST', SATL_PLUGIN_NAME); ?></option>
				<?php foreach ($posts as $post) : ?>
				<option value="<?php echo $post -> ID; ?>"><?php echo $post -> post_title; ?></option>	
				<?php endforeach; ?>
			</select>
		<?php endif; ?>
		</p>
		<p>
			<label style="font-weight:bold;"><?php _e('Exclude', SATL_PLUGIN_NAME); ?>:</label><br/>
			<input type="text" name="exclude" value="" id="exclude" /><br/>
			<small><?php _e('comma separated IDs of attachments to exclude', SATL_PLUGIN_NAME); ?></small>
		</p>
		<?php echo showInBoth(); ?>
	</div>
	<?php /*		<table border="0" cellpadding="4" cellspacing="0">			<tbody>				<tr>				<th nowrap="nowrap"><label for="category-menu"><?php _e("Category", 'wp-checkout'); ?></label></th>				<td>					<select id="category-menu" name="category" onchange="changeCategory();">						<option value="">- <?php _e('Select Category', 'wp-checkout'); ?></option>						<?php if ($categories = $Category -> select()) : ?>							<?php foreach ($categories as $cat_id => $cat_title) : ?>								<option value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>							<?php endforeach; ?>						<?php endif; ?>					</select>				</td>				</tr>				<tr id="product-selector">				<th nowrap="nowrap"><label for="product-menu"><?php _e("Product", 'wp-checkout'); ?></label></th>				<td><select id="product-menu" name="product" size="7"></select></td>				</tr>			</tbody>		</table>		*/ ?>	</div>		<div class="mceActionPanel">		<div style="float: left">			<input type="button" id="cancel" name="cancel" value="{#cancel}" onclick="closePopup()"/>		</div>		
	<div style="float: right">
	<input type="button" id="insert" name="insert" value="{#insert}" onclick="insertTag()" />
	</div>	</div></form></div><script type="text/javascript"></script></body></html>
	
	<?php
	function showInBoth() {
            ob_start();
            ?>
		<p>
			<label style="font-weight:bold; cursor:pointer;"><input type="radio" name="auto" value="on" id="sgauto_on" /> 
				<?php _e('Auto Play On', SATL_PLUGIN_NAME); ?>
			</label>
			<label style="font-weight:bold; cursor:pointer;"><input type="radio" name="auto" value="off" id="sgauto_off" /> 
				<?php _e('Auto Play Off', SATL_PLUGIN_NAME); ?>
			</label>	
		</p>
		<p>
			<label style="font-weight:bold; cursor:pointer;"><input type="radio" name="thumbs" value="on" id="sgthumbs_on" /> 
				<?php _e('Thumbnails On', SATL_PLUGIN_NAME); ?>
			</label>
			<label style="font-weight:bold; cursor:pointer;"><input type="radio" name="thumbs" value="off" id="sgthumbs_off" /> 
				<?php _e('Thumbnails Off', SATL_PLUGIN_NAME); ?>
			</label>		
		</p>
		<p>
			<label style="font-weight:bold; cursor:pointer;"><input type="radio" name="caption" value="on" id="sgcaption_on" /> 
				<?php _e('Caption On', SATL_PLUGIN_NAME); ?>
			</label>
			<label style="font-weight:bold; cursor:pointer;"><input type="radio" name="caption" value="off" id="sgcaption_off" /> 
				<?php _e('Caption Off', SATL_PLUGIN_NAME); ?>
			</label>		
		</p>
        <?php
	$text = ob_get_clean();
        return $text;
        
        } ?>