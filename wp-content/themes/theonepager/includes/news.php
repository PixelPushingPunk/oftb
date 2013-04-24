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
				'homepage_news_id' => '',
				'thumb_single' => 'false',
				'single_w' => 200,
				'single_h' => 200,
				'thumb_single_align' => 'alignleft',
				'homepage_news_posts_heading' => '',
				'homepage_posts_layout' => 'layout-full'
				);

$settings = woo_get_dynamic_values( $settings );

if ( 0 < intval( $settings['homepage_news_id'] ) ) {
$query = new WP_Query( array( 'page_id' => $settings['homepage_news_id'] ) );
?>

<div id="news" class="widget_woo_component">
	<div class="col-full <?php echo esc_attr( $settings['homepage_posts_layout'] ); ?>">
		<span class="heading"><?php echo $settings['homepage_news_posts_heading']; ?><!--Events--></span>
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

	<!-- Twitter Section -->
	<div class="twitter-section">
		<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/god" data-widget-id="327062304757792768">Tweets by @god</a>
		<br/>		
		<a class="twitter-timeline" href="https://twitter.com/search?q=%40god" data-widget-id="327055876647174145">Tweets about "@god"</a>
		
		<!-- twitter sdk js -->
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<!--
		<a class="twitter-timeline" href="https://twitter.com/search?q=%40god" data-widget-id="327055876647174145">Tweets about "@god"</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		-->
		<div id="data">

		</div>
	</div>
</div>
<?php } // End the main check ?>