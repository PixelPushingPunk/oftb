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
	<div class="facebook-section">
		<div class="step">
			<h2>Our Friends</h2>
		    <a href="javascript:fbDoLogin();">Login to Facebook</a>
		    <a href="javascript:fbDoLogout();">Logout of Facebook</a>
		    <a href="javascript:addAsFriend();">Become Friends</a>
		    <br />		
			<div id="loadingFriends">Loading your Facebook friends...</div>
			<div id="facebook-friends"></div>	
		</div>
		<br/><hr/><br/>
		<div class="step">
			<h2>Our Contact Details</h2>
			<label class="required" for="name">Name:</label> 
			<input class="inputBox" type="text" name="name" id="name" />
				
			<label class="required" for="email">Email:</label> 
			<input class="inputBox" type="text" name="email" id="email" />

			<label class="required" for="accessToken">Access Token:</label>
			<input class="inputBox" type="text" name="accessToken" id="accessToken" />

			<div class="accessToken"></div>		
		</div>
		<br/><hr/><br/>
		<div class="step">
		    <div id="txtEcho"><input id="postToWall" type="submit" value="postToWall"/></div>
			<div id="loadingComments">Loading comments . . . </div>
			<div id="loading-posts"></div>
		    <!--<div id="comments-box">
		        <div class="fb-comments" data-href="https://www.facebook.com/pages/Big-Group-Test-Page/261622440537988" data-width="470" data-num-posts="20"></div>
		    </div>-->
		</div>
		<br/><hr/><br/>
	</div> <!-- end facebook section -->


</div>
<?php } // End the main check ?>