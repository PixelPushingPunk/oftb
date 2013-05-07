<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
	global $woo_options;

	$total = 4;
	if ( isset( $woo_options['woo_footer_sidebars'] ) && ( $woo_options['woo_footer_sidebars'] != '' ) ) {
		$total = $woo_options['woo_footer_sidebars'];
	}

	if ( ( woo_active_sidebar( 'footer-1' ) ||
		   woo_active_sidebar( 'footer-2' ) ||
		   woo_active_sidebar( 'footer-3' ) ||
		   woo_active_sidebar( 'footer-4' ) ) && $total > 0 ) {

?>
	
	<?php woo_footer_before(); ?>
		
	<section id="footer-widgets">
	
		<div class="col-full col-<?php echo $total; ?> fix">

			<?php $i = 0; while ( $i < $total ) { $i++; ?>
				<?php if ( woo_active_sidebar( 'footer-' . $i ) ) { ?>
			
			<div class="block footer-widget-<?php echo $i; ?>">
        		<?php woo_sidebar( 'footer-' . $i ); ?>
			</div>
			
	    	    <?php } ?>
			<?php } // End WHILE Loop ?>
		
		</div>

	</section><!-- /#footer-widgets  -->

	<?php } // End IF Statement ?>

	<footer id="footer">
	
		<div class="col-full">

			<ul id="foot-links" class="footer-section">
				<li><a href="#">Terms and Conditions</a></li>
				<li><a href="#">Privacy Policy</a></li>
			</ul>
			
			<div id="uac-logo" class="footer-section">
				<img src="<?php echo get_template_directory_uri(); ?>/images/uac.png" alt="United Against Cancer"/>
			</div>

			<div class="clear"></div>


			<div id="copyright" class="footer-section">
				<p>&copy;2013 One for the Boys</p>
				<p class="smlPrint">Registered charity in England and Wales (261017), Scotland (SC039907) and the Isle of Man (604). A company limited by guarantee, registered in England and Wales company number 2400969.Registered office: 89 Albert Embankment, London SE1 7UQ.</p>
			</div>
			
		</div><!-- /.col-full -->

	</footer><!-- /#footer  -->

</div><!-- /#wrapper -->
<?php wp_footer(); ?>
<?php woo_foot(); ?>
<!--js script-->
<script>
	(function($){
		// Responsive Nav 2

  	}(jQuery));
</script>
<script type="text/javascript" src="wp-content/themes/theonepager/js/default-me.js"></script>
</body>
</html>