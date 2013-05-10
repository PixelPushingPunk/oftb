<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Page Content Component
 *
 * Display content from a specified page.
 *
 * @author Matty
 * @since 1.0.0
 * @package WooFramework
 * @subpackage Component
 */
global $post;

$settings = array(
				'homepage_getInvolved_id' => '',
				'thumb_single' => 'false',
				'single_w' => 200,
				'single_h' => 200,
				'thumb_single_align' => 'alignleft',
				'homepage_getInvolved_posts_heading' => '',
				'homepage_posts_layout' => 'layout-full'
				);

$settings = woo_get_dynamic_values( $settings );

if ( 0 < intval( $settings['homepage_getInvolved_id'] ) ) {
$query = new WP_Query( array( 'page_id' => $settings['homepage_getInvolved_id'] ) );
?>

<div id="getInvolved" class="widget_woo_component">
	<div class="col-full <?php echo esc_attr( $settings['homepage_posts_layout'] ); ?>">
		<span class="heading"><?php echo $settings['homepage_getInvolved_posts_heading']; ?><!--Get involved--></span>
		<div id="main" class="col-left">
		<?php
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) { $query->the_post();
		?>

			<article <?php  if ( has_post_thumbnail() ) { echo 'class="has-featured-image"'; } ?>>

				<?php if ( has_post_thumbnail() ) { ?>
					<div class="featured-image">
						<?php woo_image( 'width=500&noheight=true' ); ?>
					</div>
				<?php } ?>

				<div class="article-content">

					<header>
						<h1><?php the_title(); ?></h1>
					</header>

					<section class="entry">
						<?php the_content( __( 'Continue Reading &rarr;', 'woothemes' ) ); ?>
					</section>

				</div>

			</article>

			<div class="fix"></div>

		<?php
				} // End WHILE Loop
				wp_reset_postdata();

			} else {
		?>
		    <article <?php post_class(); ?>>
		        <p><?php _e( 'Selected home page content not found.', 'woothemes' ); ?></p>
		    </article><!-- /.post -->
		<?php } ?>
		</div><!--/#main .col-left-->
		<?php
			if ( $settings['homepage_posts_layout'] != 'layout-full' )  {
				get_sidebar();
			}
		?>
	</div>

	<!-- facebook section -->
	<div class="facebook-section col-full layout-full">
		
		<div id="posts" class="step">
		    <!--<div id="txtEcho"><input id="postToWall" type="submit" value="postToWall"/></div>-->		
			<h2>Posts</h2>
			<div id="loadingComments"><img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif"/> Loading comments . . . </div>
			<form id="postForm">
				<button id="fbShare">Share</button><br/>
				<textarea class='textareaFB'></textarea><br/><input class='postToWall' type='submit' value='comment' name='comment'/>
			</form>

			<div id="loading-posts" class="rslides">	
			</div>
		    <!--<div id="comments-box">
		        <div class="fb-comments" data-href="https://www.facebook.com/pages/Big-Group-Test-Page/261622440537988" data-width="470" data-num-posts="20"></div>
		    </div>-->
		</div><!--/#posts-->

		<div id="friends" class="step">
			<h2>Our Friends</h2>
		    <a class="fbLogin" href="#">Login to Facebook</a>
		    <a class="fbLogout" href="#">Logout of Facebook</a>
		    <a class="fbBecomeFriend" href="#">Become Friends</a>
		    <br />		
			<div id="loadingFriends"><img src="<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif"/> Loading your Facebook friends...</div>
			<div id="facebook-friends">
				<div id="facebook-friend-temp" style="width:630px;">
					

					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/jimcammy" id="272901017" style=""><img src="https://graph.facebook.com/272901017/picture?width=64&amp;height=64" alt="Jimmy Cam" title="Jimmy Cam"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Jimmy Cam</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/louise.mckain" id="501638561" style=""><img src="https://graph.facebook.com/501638561/picture?width=64&amp;height=64" alt="Louise Elizabeth McKain" title="Louise Elizabeth McKain"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Louise Elizabeth McKain</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/Sara.Brennan87" id="502168397" style=""><img src="https://graph.facebook.com/502168397/picture?width=64&amp;height=64" alt="Sara Brennan" title="Sara Brennan"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Sara Brennan</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/kofi.ofei" id="502493066" style=""><img src="https://graph.facebook.com/502493066/picture?width=64&amp;height=64" alt="Kofi Afriye Ofei" title="Kofi Afriye Ofei"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Kofi Afriye Ofei</a></div></div>
					<div class="itemFriend friendWrapCeleb"><a class="friendCeleb" href="https://www.facebook.com/djai86" id="268101068" style=""><img src="http://www.autumn-rolls.com/oftb/wp-content/themes/theonepager/images/andy.jpg" alt="Danny Szeto" title="Danny Szeto"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Danny Szeto</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/louise.mckain" id="501638561" style=""><img src="https://graph.facebook.com/501638561/picture?width=64&amp;height=64" alt="Louise Elizabeth McKain" title="Louise Elizabeth McKain"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Louise Elizabeth McKain</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/Sara.Brennan87" id="502168397" style=""><img src="https://graph.facebook.com/502168397/picture?width=64&amp;height=64" alt="Sara Brennan" title="Sara Brennan"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Sara Brennan</a></div></div>
					<div class="itemFriend friendWrapCeleb"><a class="friendCeleb" href="https://www.facebook.com/djai86" id="268101068" style=""><img src="http://www.autumn-rolls.com/oftb/wp-content/themes/theonepager/images/andy.jpg" alt="Danny Szeto" title="Danny Szeto"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Danny Szeto</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/louise.mckain" id="501638561" style=""><img src="https://graph.facebook.com/501638561/picture?width=64&amp;height=64" alt="Louise Elizabeth McKain" title="Louise Elizabeth McKain"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Louise Elizabeth McKain</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/Sara.Brennan87" id="502168397" style=""><img src="https://graph.facebook.com/502168397/picture?width=64&amp;height=64" alt="Sara Brennan" title="Sara Brennan"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Sara Brennan</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/kofi.ofei" id="502493066" style=""><img src="https://graph.facebook.com/502493066/picture?width=64&amp;height=64" alt="Kofi Afriye Ofei" title="Kofi Afriye Ofei"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Kofi Afriye Ofei</a></div></div>

					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/jimcammy" id="272901017" style=""><img src="https://graph.facebook.com/272901017/picture?width=64&amp;height=64" alt="Jimmy Cam" title="Jimmy Cam"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Jimmy Cam</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/louise.mckain" id="501638561" style=""><img src="https://graph.facebook.com/501638561/picture?width=64&amp;height=64" alt="Louise Elizabeth McKain" title="Louise Elizabeth McKain"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Louise Elizabeth McKain</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/Sara.Brennan87" id="502168397" style=""><img src="https://graph.facebook.com/502168397/picture?width=64&amp;height=64" alt="Sara Brennan" title="Sara Brennan"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Sara Brennan</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/kofi.ofei" id="502493066" style=""><img src="https://graph.facebook.com/502493066/picture?width=64&amp;height=64" alt="Kofi Afriye Ofei" title="Kofi Afriye Ofei"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Kofi Afriye Ofei</a></div></div>
					<div class="itemFriend friendWrapCeleb"><a class="friendCeleb" href="https://www.facebook.com/djai86" id="268101068" style=""><img src="http://www.autumn-rolls.com/oftb/wp-content/themes/theonepager/images/andy.jpg" alt="Danny Szeto" title="Danny Szeto"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Danny Szeto</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/louise.mckain" id="501638561" style=""><img src="https://graph.facebook.com/501638561/picture?width=64&amp;height=64" alt="Louise Elizabeth McKain" title="Louise Elizabeth McKain"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Louise Elizabeth McKain</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/Sara.Brennan87" id="502168397" style=""><img src="https://graph.facebook.com/502168397/picture?width=64&amp;height=64" alt="Sara Brennan" title="Sara Brennan"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Sara Brennan</a></div></div>
					<div class="itemFriend friendWrapCeleb"><a class="friendCeleb" href="https://www.facebook.com/djai86" id="268101068" style=""><img src="http://www.autumn-rolls.com/oftb/wp-content/themes/theonepager/images/andy.jpg" alt="Danny Szeto" title="Danny Szeto"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Danny Szeto</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/louise.mckain" id="501638561" style=""><img src="https://graph.facebook.com/501638561/picture?width=64&amp;height=64" alt="Louise Elizabeth McKain" title="Louise Elizabeth McKain"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Louise Elizabeth McKain</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/Sara.Brennan87" id="502168397" style=""><img src="https://graph.facebook.com/502168397/picture?width=64&amp;height=64" alt="Sara Brennan" title="Sara Brennan"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Sara Brennan</a></div></div>
					<div class="itemFriend friendWrap"><a class="friend" href="https://www.facebook.com/kofi.ofei" id="502493066" style=""><img src="https://graph.facebook.com/502493066/picture?width=64&amp;height=64" alt="Kofi Afriye Ofei" title="Kofi Afriye Ofei"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Kofi Afriye Ofei</a></div></div>
					<!--<div class="friendBlockWrap64">
						<div class="friendWrap"><a class="friend" href="https://www.facebook.com/djai86" id="268101068" style=""><img src="https://graph.facebook.com/268101068/picture?width=64&amp;height=64" alt="Danny Szeto" title="Danny Szeto"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Danny Szeto</a></div></div>
						<div class="friendWrap"><a class="friend" href="https://www.facebook.com/arto.saari.9" id="272900681" style=""><img src="https://graph.facebook.com/272900681/picture?width=64&amp;height=64" alt="Arto Saari" title="Arto Saari"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Arto Saari</a></div></div>
					</div>
					
					<div class="friendWrapCeleb"><a class="friendCeleb" href="https://www.facebook.com/djai86" id="268101068" style=""><img src="http://www.autumn-rolls.com/oftb/wp-content/themes/theonepager/images/andy.jpg" alt="Danny Szeto" title="Danny Szeto"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Danny Szeto</a></div></div>
					
					<div class="friendBlockWrap64">
						<div class="friendWrap"><a class="friend" href="https://www.facebook.com/djai86" id="268101068" style=""><img src="https://graph.facebook.com/268101068/picture?width=64&amp;height=64" alt="Danny Szeto" title="Danny Szeto"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Danny Szeto</a></div></div>
						<div class="friendWrap"><a class="friend" href="https://www.facebook.com/arto.saari.9" id="272900681" style=""><img src="https://graph.facebook.com/272900681/picture?width=64&amp;height=64" alt="Arto Saari" title="Arto Saari"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Arto Saari</a></div></div>
					</div>

					<div class="friendWrapCeleb"><a class="friendCeleb" href="https://www.facebook.com/djai86" id="268101068" style=""><img src="http://www.autumn-rolls.com/oftb/wp-content/themes/theonepager/images/matt.jpg" alt="Danny Szeto" title="Danny Szeto"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Danny Szeto</a></div></div>

					<div class="friendWrap"><a class="friend" href="https://www.facebook.com/djai86" id="268101068" style=""><img src="https://graph.facebook.com/268101068/picture?width=64&amp;height=64" alt="Danny Szeto" title="Danny Szeto"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Danny Szeto</a></div></div>
					<div class="friendWrap"><a class="friend" href="https://www.facebook.com/djai86" id="268101068" style=""><img src="https://graph.facebook.com/268101068/picture?width=64&amp;height=64" alt="Danny Szeto" title="Danny Szeto"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Danny Szeto</a></div></div>
					-->

					<!--<div class="friendBlockWrap144">
						<div class="friendWrap"><a class="friend" href="https://www.facebook.com/jimcammy" id="272901017" style=""><img src="https://graph.facebook.com/272901017/picture?width=64&amp;height=64" alt="Jimmy Cam" title="Jimmy Cam"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Jimmy Cam</a></div></div>
						<div class="friendWrap"><a class="friend" href="https://www.facebook.com/louise.mckain" id="501638561" style=""><img src="https://graph.facebook.com/501638561/picture?width=64&amp;height=64" alt="Louise Elizabeth McKain" title="Louise Elizabeth McKain"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Louise Elizabeth McKain</a></div></div>
						<div class="friendWrap"><a class="friend" href="https://www.facebook.com/Sara.Brennan87" id="502168397" style=""><img src="https://graph.facebook.com/502168397/picture?width=64&amp;height=64" alt="Sara Brennan" title="Sara Brennan"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Sara Brennan</a></div></div>
						<div class="friendWrap"><a class="friend" href="https://www.facebook.com/kofi.ofei" id="502493066" style=""><img src="https://graph.facebook.com/502493066/picture?width=64&amp;height=64" alt="Kofi Afriye Ofei" title="Kofi Afriye Ofei"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Kofi Afriye Ofei</a></div></div>
					</div>-->

				</div>

			</div>	
		</div><!--/#friends-->

	</div> <!-- end facebook section -->
	
</div>
<?php } // End the main check ?>