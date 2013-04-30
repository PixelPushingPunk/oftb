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
				'homepage_campaign_id' => '',
				'thumb_single' => 'false',
				'single_w' => 200,
				'single_h' => 200,
				'thumb_single_align' => 'alignleft',
				'homepage_campaign_posts_heading' => '',
				'homepage_posts_layout' => 'layout-full'
				);

$settings = woo_get_dynamic_values( $settings );

if ( 0 < intval( $settings['homepage_campaign_id'] ) ) {
$query = new WP_Query( array( 'page_id' => $settings['homepage_campaign_id'] ) );
?>

<div id="campaigns" class="widget_woo_component">
	<div class="col-full <?php echo esc_attr( $settings['homepage_posts_layout'] ); ?>">
		<span class="heading"><?php echo $settings['homepage_campaign_posts_heading']; ?><!--Campaigns--></span>
		<div id="main" class="col-left">

			<div class="pagepost">	
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
			</div><!--/.pagepost -->

		</div><!--/#main .col-left-->


		<?php
			if ( $settings['homepage_posts_layout'] != 'layout-full' )  {
				get_sidebar();
			}
		?>
	</div>

	<!-- facebook section -->
	<div class="facebook-section col-full layout-full">
		<div id="friends" class="step">
			<h2>Our Friends</h2>
		    <a class="fbLogin" href="#">Login to Facebook</a>
		    <a class="fbLogout" href="#">Logout of Facebook</a>
		    <a class="fbBecomeFriend" href="#">Become Friends</a>
		    <br />		
			<div id="loadingFriends">Loading your Facebook friends...</div>
			<div id="facebook-friends">
				<div id="facebook-friend-temp">
					
					<div class="friendBlockWrap64">
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
	
					<!--<div class="friendBlockWrap144">
						<div class="friendWrap"><a class="friend" href="https://www.facebook.com/jimcammy" id="272901017" style=""><img src="https://graph.facebook.com/272901017/picture?width=64&amp;height=64" alt="Jimmy Cam" title="Jimmy Cam"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Jimmy Cam</a></div></div>
						<div class="friendWrap"><a class="friend" href="https://www.facebook.com/louise.mckain" id="501638561" style=""><img src="https://graph.facebook.com/501638561/picture?width=64&amp;height=64" alt="Louise Elizabeth McKain" title="Louise Elizabeth McKain"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Louise Elizabeth McKain</a></div></div>
						<div class="friendWrap"><a class="friend" href="https://www.facebook.com/Sara.Brennan87" id="502168397" style=""><img src="https://graph.facebook.com/502168397/picture?width=64&amp;height=64" alt="Sara Brennan" title="Sara Brennan"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Sara Brennan</a></div></div>
						<div class="friendWrap"><a class="friend" href="https://www.facebook.com/kofi.ofei" id="502493066" style=""><img src="https://graph.facebook.com/502493066/picture?width=64&amp;height=64" alt="Kofi Afriye Ofei" title="Kofi Afriye Ofei"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Kofi Afriye Ofei</a></div></div>
					</div>-->

					<div class="friendWrap"><a class="friend" href="https://www.facebook.com/lohita" id="503261665" style=""><img src="https://graph.facebook.com/503261665/picture?width=64&amp;height=64" alt="Lohita Goonatilleke" title="Lohita Goonatilleke"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Lohita Goonatilleke</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/pep.suwanchwee" id="506300397" style=""><img src="https://graph.facebook.com/506300397/picture?width=64&amp;height=64" alt="Pep Suwanchwee" title="Pep Suwanchwee"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Pep Suwanchwee</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/enid.laura" id="507076197" style=""><img src="https://graph.facebook.com/507076197/picture?width=64&amp;height=64" alt="Briony Laura Enid" title="Briony Laura Enid"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Briony Laura Enid</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/daniel.smith.775" id="508680679" style=""><img src="https://graph.facebook.com/508680679/picture?width=64&amp;height=64" alt="Daniel Smith" title="Daniel Smith"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Daniel Smith</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/Jexray" id="511418284" style=""><img src="https://graph.facebook.com/511418284/picture?width=64&amp;height=64" alt="Jex-Ray Say-yes" title="Jex-Ray Say-yes"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Jex-Ray Say-yes</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/angela.roots" id="512153792" style=""><img src="https://graph.facebook.com/512153792/picture?width=64&amp;height=64" alt="Angela Roots" title="Angela Roots"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Angela Roots</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/awaismuzaffar.profile" id="556135293" style=""><img src="https://graph.facebook.com/556135293/picture?width=64&amp;height=64" alt="Awais Muzaffar" title="Awais Muzaffar"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Awais Muzaffar</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/jonesy1727" id="597845031" style=""><img src="https://graph.facebook.com/597845031/picture?width=64&amp;height=64" alt="Simon Jones" title="Simon Jones"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Simon Jones</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/justin.ayles.14" id="632936886" style=""><img src="https://graph.facebook.com/632936886/picture?width=64&amp;height=64" alt="Justin Ayles" title="Justin Ayles"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Justin Ayles</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/profile.php?id=634172185" id="634172185" style=""><img src="https://graph.facebook.com/634172185/picture?width=64&amp;height=64" alt="Usman Butt" title="Usman Butt"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Usman Butt</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/jessie.tung.75" id="636904596" style=""><img src="https://graph.facebook.com/636904596/picture?width=64&amp;height=64" alt="Jessie Tung" title="Jessie Tung"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Jessie Tung</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/cyril.tovena" id="667287367" style=""><img src="https://graph.facebook.com/667287367/picture?width=64&amp;height=64" alt="Cyril Tovena" title="Cyril Tovena"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Cyril Tovena</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/desmetalex" id="680135909" style=""><img src="https://graph.facebook.com/680135909/picture?width=64&amp;height=64" alt="Alex De Smet" title="Alex De Smet"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Alex De Smet</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/nathan.root2" id="697230121" style=""><img src="https://graph.facebook.com/697230121/picture?width=64&amp;height=64" alt="Nathan Root" title="Nathan Root"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Nathan Root</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/parashar.mehta" id="708001383" style=""><img src="https://graph.facebook.com/708001383/picture?width=64&amp;height=64" alt="Parashar Mehta" title="Parashar Mehta"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Parashar Mehta</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/kulvir.sroy" id="795405553" style=""><img src="https://graph.facebook.com/795405553/picture?width=64&amp;height=64" alt="Kulvir Sroy" title="Kulvir Sroy"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Kulvir Sroy</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/harold.deroxas.9" id="1095229220" style=""><img src="https://graph.facebook.com/1095229220/picture?width=64&amp;height=64" alt="Harold de Roxas" title="Harold de Roxas"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Harold de Roxas</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/mayroseRN" id="1260609775" style=""><img src="https://graph.facebook.com/1260609775/picture?width=64&amp;height=64" alt="Mary Rose Dano" title="Mary Rose Dano"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Mary Rose Dano</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/ivan.roldanfernandez" id="1458854461" style=""><img src="https://graph.facebook.com/1458854461/picture?width=64&amp;height=64" alt="Ivan Roldan Fernandez" title="Ivan Roldan Fernandez"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Ivan Roldan Fernandez</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/alicia.martinez.56481" id="1660801467" style=""><img src="https://graph.facebook.com/1660801467/picture?width=64&amp;height=64" alt="Alicia Martinez" title="Alicia Martinez"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Alicia Martinez</a></div></div><div class="friendWrap"><a class="friend" href="https://www.facebook.com/billy.dean.1293575" id="100005811042107" style=""><img src="https://graph.facebook.com/100005811042107/picture?width=64&amp;height=64" alt="Billy Dean" title="Billy Dean"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Billy Dean</a></div></div>
				</div>

				<div id="facebook-friends-perm" style="display:none;">
					<div class="friendBlockWrap64 one"></div>
					<div class="friendWrapCeleb"><a class="friendCeleb" href="https://www.facebook.com/djai86" id="268101068" style=""><img src="http://www.autumn-rolls.com/oftb/wp-content/themes/theonepager/images/andy.jpg" alt="Danny Szeto" title="Danny Szeto"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Danny Szeto</a></div></div>
					<div class="firnedBlockWrap64 two"></div>
					<div class="friendWrapCeleb"><a class="friendCeleb" href="https://www.facebook.com/djai86" id="268101068" style=""><img src="http://www.autumn-rolls.com/oftb/wp-content/themes/theonepager/images/matt.jpg" alt="Danny Szeto" title="Danny Szeto"></a><div class="friend-detail-wrap" style="display: none;"><a href="#" class="friend-detail">Danny Szeto</a></div></div>
					<div class="firnedBlockWrap64 three"></div>
				</div>
			</div>	
		</div>

		<div id="posts" class="step">
		    <!--<div id="txtEcho"><input id="postToWall" type="submit" value="postToWall"/></div>-->		
			<h2>Posts</h2>
			<div id="loadingComments">Loading comments . . . </div>
			<div id="loading-posts">	
				<form id="postForm"><textarea class='textareaFB'></textarea><br><input class='postToWall' type='submit' value='comment' name='comment'/></form>
			</div>
		    <!--<div id="comments-box">
		        <div class="fb-comments" data-href="https://www.facebook.com/pages/Big-Group-Test-Page/261622440537988" data-width="470" data-num-posts="20"></div>
		    </div>-->
		</div>

	</div> <!-- end facebook section -->


</div>
<?php } // End the main check ?>