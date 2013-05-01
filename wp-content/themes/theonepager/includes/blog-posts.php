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
						
					});

					/*function twitterStuff () {
						$('#twitter').append('<textarea id="twtPost"></textarea><br/>');
							var twtPost = document.getElementById('twtPost');
							var twtTitle;
							
							$('#twtPost').on('blur', function(){
								twtTitle  = $(this).val();
							});

							var twtUrl    = location.href;
							var maxLength = 140 - (twtUrl.length + 1);
							
							if (twtTitle.length > maxLength) {
								twtTitle = twtTitle.substr(0, (maxLength - 3))+'...';
							}
							
							var twtLink = 'http://twitter.com/home?status='+encodeURIComponent(twtTitle + ' ' + twtUrl);
							//document.write('<a href="'+twtLink+'" target="_blank"'+'><img src="tweetthis.gif"  border="0" alt="Tweet This!" /'+'><'+'/a>');
							var commentBoxTwt = '<a class="tweetthis" href="'+twtLink+'" target="_blank"'+'>Tweet<'+'/a>';					
							$('#twitter').append(commentBoxTwt);
					}*/
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
							<!--<div class="overview">-->
								<div id="twitter2" class="overview">
										<!--
										<h3>Magnis dis parturient montes</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vitae velit at velit pretium sodales. Maecenas egestas imperdiet mauris, vel elementum turpis iaculis eu. Duis egestas augue quis ante ornare eu tincidunt magna interdum. Vestibulum posuere risus non ipsum sollicitudin quis viverra ante feugiat. Pellentesque non faucibus lorem. Nunc tincidunt diam nec risus ornare quis porttitor enim pretium. Ut adipiscing tempor massa, a ullamcorper massa bibendum at. Suspendisse potenti. In vestibulum enim orci, nec consequat turpis. Suspendisse sit amet tellus a quam volutpat porta. Mauris ornare augue ut diam tincidunt elementum. Vivamus commodo dapibus est, a gravida lorem pharetra eu. Maecenas ultrices cursus tellus sed congue. Cras nec nulla erat.</p>
										
										<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque eget mauris libero. Nulla sit amet felis in sem posuere laoreet ut quis elit. Aenean mauris massa, pretium non bibendum eget, elementum sed nibh. Nulla ac felis et purus adipiscing rutrum. Pellentesque a bibendum sapien. Vivamus erat quam, gravida sed ultricies ac, scelerisque sed velit. Integer mollis urna sit amet ligula aliquam ac sodales arcu euismod. Fusce fermentum augue in nulla cursus non fermentum lorem semper. Quisque eu auctor lacus. Donec justo justo, mollis vel tempor vitae, consequat eget velit.</p>
										
										<p>Vivamus sed tellus quis orci dignissim scelerisque nec vitae est. Duis et elit ipsum. Aliquam pharetra auctor felis tempus tempor. Vivamus turpis dui, sollicitudin eget rhoncus in, luctus vel felis. Curabitur ultricies dictum justo at luctus. Nullam et quam et massa eleifend sollicitudin. Nulla mauris purus, sagittis id egestas eu, pellentesque et mi. Donec bibendum cursus nisi eget consequat. Nunc sit amet commodo metus. Integer consectetur lacus ac libero adipiscing ut tristique est viverra. Maecenas quam nibh, molestie nec pretium interdum, porta vitae magna. Maecenas at ligula eget neque imperdiet faucibus malesuada sed ipsum. Nulla auctor ligula sed nisl adipiscing vulputate. Curabitur ut ligula sed velit pharetra fringilla. Cras eu luctus est. Aliquam ac urna dui, eu rhoncus nibh. Nam id leo nisi, vel viverra nunc. Duis egestas pellentesque lectus, a placerat dolor egestas in. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec vitae ipsum non est iaculis suscipit.</p>
										
										<h3>Adipiscing risus </h3>
										<p>Quisque vel felis ligula. Cras viverra sapien auctor ante porta a tincidunt quam pulvinar. Nunc facilisis, enim id volutpat sodales, leo ipsum accumsan diam, eu adipiscing risus nisi eu quam. Ut in tortor vitae elit condimentum posuere vel et erat. Duis at fringilla dolor. Vivamus sem tellus, porttitor non imperdiet et, rutrum id nisl. Nunc semper facilisis porta. Curabitur ornare metus nec sapien molestie in mattis lorem ullamcorper. Ut congue, purus ac suscipit suscipit, magna diam sodales metus, tincidunt imperdiet diam odio non diam. Ut mollis lobortis vulputate. Nam tortor tortor, dictum sit amet porttitor sit amet, faucibus eu sem. Curabitur aliquam nisl sed est semper a fringilla velit porta. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum in sapien id nulla volutpat sodales ac bibendum magna. Cras sollicitudin, massa at sodales sodales, lacus tortor vestibulum massa, eu consequat dui nulla et ipsum.</p>
										
										<p>Aliquam accumsan aliquam urna, id vulputate ante posuere eu. Nullam pretium convallis tincidunt. Duis vitae odio arcu, ut fringilla enim. Nam ante eros, vestibulum sit amet rhoncus et, vehicula quis tellus. Curabitur sed iaculis odio. Praesent vitae ligula id tortor ornare luctus. Integer placerat urna non ligula sollicitudin vestibulum. Nunc vestibulum auctor massa, at varius nibh scelerisque eget. Aliquam convallis, nunc non laoreet mollis, neque est mattis nisl, nec accumsan velit nunc ut arcu. Donec quis est mauris, eu auctor nulla. Fusce leo diam, tempus a varius sit amet, auctor ac metus. Nam turpis nulla, fermentum in rhoncus et, auctor id sem. Aliquam id libero eu neque elementum lobortis nec et odio.</p>                   
										-->
								</div>
							<!--</div>-->
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php
			if ( $settings['homepage_posts_layout'] != 'layout-full' )  {
				get_sidebar();
			}
		?>
	</div>
</div>