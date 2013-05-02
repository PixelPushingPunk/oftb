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
		

		<!-- Twitter Section -->
		<div class="twitter-section">
			<!--
			<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/god" data-widget-id="327062304757792768">Tweets by @god</a>
			<br/>		
			<a class="twitter-timeline" href="https://twitter.com/search?q=%40god" data-widget-id="327055876647174145">Tweets about "@god"</a>
			-->
			<!-- twitter sdk js -->
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			
			<div id="data"></div>

			<script type="text/javascript">
				(function($){
					$(function(){
						//twitterStuff();
						$('#twitter-postbox').append('<textarea id="twtPost">@OneForTheBoys</textarea><br/>');
							var twtPost = document.getElementById('twtPost');
							var twtTitle = $('#twtPost').val();
							
							$('#twtPost').on('focus blur change', function(){
								twtTitle  = $(this).val();
							});

							var twtUrl    = location.href;
							var maxLength = 140 - (twtUrl.length + 1);
							
							if (twtTitle.length > maxLength) {
								twtTitle = twtTitle.substr(0, (maxLength - 3))+'...';
							}
							
							var twtLink = 'http://twitter.com/home?status='+encodeURIComponent(twtTitle + ' ' + twtUrl);
							//document.write('<a href="'+twtLink+'" target="_blank"'+'><img src="tweetthis.gif"  border="0" alt="Tweet This!" /'+'><'+'/a>');
							var commentBoxTwt = '<a class="tweetthis button" href="'+twtLink+'" target="_blank"'+'>Tweet<'+'/a>';					
							$('#twitter-postbox').append(commentBoxTwt);
					});

					$(window).load(function () {
						// Do stuff
					});
				}(jQuery));
			</script>

			<div id="twitter-api">
				<div class="twitter-padding">
					<h1>@onefortheboys</h1>
					<div id="twitter"></div>
					<div id="twitter-postbox"></div>
					<br/>
					<div id="scrollbar1">
						<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
						<div class="viewport">
								<div id="twitter2" class="overview"></div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.twitter-section -->


		<div id="main" class="col-left">
			<!--<div class="main-padding">-->
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
			<!--</div>--> <!-- /.main-padding -->
		</div><!--/#main .col-left-->
		
		<?php
			if ( $settings['homepage_posts_layout'] != 'layout-full' )  {
				get_sidebar();
			}
		?>
	</div>
</div>