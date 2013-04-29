<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Blog Posts Component
 *
 * Display X recent blog posts.
 *
 * @author Matty
 * @since 1.0.0
 * @package WooFramework
 * @subpackage Component
 */
$settings = array(
				'homepage_number_of_posts' => 5,
				'homepage_posts_category' => '',
				'thumb_w' => 100,
				'thumb_h' => 100,
				'thumb_align' => 'alignleft',
				'homepage_posts_heading' => '',
				'homepage_posts_layout' => 'layout-full'
				);

$settings = woo_get_dynamic_values( $settings );
?>

<div id="blog-posts" class="blog-posts widget_woo_component">

	<div class="col-full <?php echo esc_attr( $settings['homepage_posts_layout'] ); ?>">

		<span class="heading"><?php echo $settings['homepage_posts_heading']; ?></span>
		
		<div class="clear"></div>
		
		<div id="main" class="col-left">

			<?php woo_loop_before(); ?>

			<?php
				if ( have_posts() ) {
					$count = 0;
					while ( have_posts() ) { the_post(); $count++;

						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );

					} // End WHILE Loop

				} else {
			?>
			    <article <?php post_class(); ?>>
			        <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
			    </article><!-- /.post -->
			<?php } // End IF Statement ?>

			<?php woo_loop_after(); ?>

			<?php woo_pagenav(); ?>
			<?php wp_reset_query(); ?>

		</div><!--/#main .col-left-->
		
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
			<textarea id="twtPost"></textarea>
			<script type="text/javascript">
				var twtPost = document.getElementById('twtPost');
				var twtTitle  = twtPost.value;//document.title;
				var twtUrl    = location.href;
				var maxLength = 140 - (twtUrl.length + 1);
				if (twtTitle.length > maxLength) {
				twtTitle = twtTitle.substr(0, (maxLength - 3))+'...';
				}
				var twtLink = 'http://twitter.com/home?status='+encodeURIComponent(twtTitle + ' ' + twtUrl);
				document.write('<a href="'+twtLink+'" target="_blank"'+'><img src="tweetthis.gif"  border="0" alt="Tweet This!" /'+'><'+'/a>');
			</script>

			<div id="twitter-api">
				<h1>Posts from @God</h1>
				<div id="twitter"></div>
				<h1>People posting to @God
				<div id="twitter2"></div>
			</div>
		</div>
		
		<?php
			if ( $settings['homepage_posts_layout'] != 'layout-full' )  {
				get_sidebar();
			}
		?>
	</div>
</div>