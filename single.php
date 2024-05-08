<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage nypap
 * 
 */

get_header(); ?>

<?php
	// Start the Loop.
	while ( have_posts() ) : the_post();

		$single_id = get_the_ID();
		$category = get_the_category();	
		$cat_slug = $category[0]->slug;
		$cat_name = $category[0]->name;
		if (strtolower($cat_name) == "events")
			$cat_name = "Event";
?>					

<div id="main-content" class="main-content container post-single">

	<div id="content" class="site-content" role="main">

		<!-- page title on mobile only -->
		<div class="section group mobile-only"><div class="col span_6_of_6"><h1>Events &amp; News</h1></div></div>						
<?php
		// set indicators and call partial to render post type labels

		$indicators = array(
			array("current"=>($cat_slug == "events" ? 1 : 0),"slug"=>"/events-news/events","display"=>"Events"),
			array("current"=>($cat_slug == "news" ? 1 : 0),"slug"=>"/events-news/news","display"=>"News")
		);
		include(locate_template('partials/content-post-type-indicator.php'));			
?>	

			<div class="entry-content division soft-division">
				<!-- image -->					
<?php 							
					if (has_post_thumbnail(get_the_ID())) {
						echo '<div class="section group">';
						echo '<div class="col span_5_of_6_offset_1">';
						echo get_the_post_thumbnail(get_the_ID(), array('alt' => get_the_title()) ); 
						echo '</div></div>';
					} 
?>					
				<!-- </div> -->
				<!-- tag, title -->
				<div class="section group">
					<div class="col span_1_of_6">					
<?php 				
						// category label
						echo ($cat_slug == "events" ? 
							events_term(get_the_ID(), (int)types_render_field('news-event-date',array('output' => 'raw'))) : the_terms( get_the_ID(),'category','<div class="tags">', '/', '</div>' ));
?>
					</div>
					<div class="col span_5_of_6"><h2><?php the_title();?></h2></div>
				</div>
				
				<div class="section section-tight group">

					<!-- excerpt, subtitle, location, tags, all fit in this column -->
					<div class="col span_5_of_6 offset_1">						
<?php
						// <!-- news subtitle /excerpt-->
						if ($cat_slug == "news") { 
?>							

<?php 
							if( $post->post_excerpt ) { ?>
								<div class="intro"><?php the_excerpt();?></div>						
<?php 						} ?>

							<!-- <div class="intro"><?php the_excerpt();?></div>						 -->
<?php						
							$raw_date = types_render_field('news-event-date',array('output'=>'raw'));
							$news_author = 	types_render_field('news-author',array('output'=>'raw'));
							// echo ( (strlen(trim($raw_date))>0 && strlen(trim($news_author))>0) ? '<p>' : '');
							echo '<p>';
							echo (strlen(trim($raw_date))>0 ? date('F j, Y',$raw_date) : '');
							// echo '<p>'.date('F j, Y',types_render_field('news-event-date',array('output'=>'raw')));
							echo ( (strlen(trim($raw_date))>0 && strlen(trim($news_author))>0) ? ' | ' : '');
							// echo ' | '.types_render_field('news-author',array('output'=>'raw'));
							echo $news_author;
							echo '<br/>'.types_render_field('news-source-subtitle',array('output'=>'raw'));
							echo '</p>';
							the_content();
						} 
						// events
						else {
							echo '<div class="intro"><p>';
							echo date('F j, Y',types_render_field('news-event-date',array('output'=>'raw')));
							echo '<br/>'.types_render_field('event-time',array('output'=>'raw'));
							echo '<br/>'.types_render_field('event-location',array('output'=>'raw')); 					
							echo '</p></div>';
							the_content();
							echo '<p><b>Location:</b><br/>'.types_render_field('event-location',array('output'=>'raw'));
							echo '<br/>'.types_render_field('location-address',array('output'=>'raw'));
							echo '<br/>'.types_render_field('loc-city-state-zip',array('output'=>'raw'));

							$maplink = types_render_field('event-google-map',array("output"=>"raw"));					
							echo (strlen(trim($maplink))> 0 ? '<br/><a href="'.$maplink.'" target="_blank">Google Maps</a>' : '');
							echo '</p>';

							if ((int)types_render_field('include-rsvp-button',array('output' => 'raw' )) == 1) {
								echo '<a href="'.types_render_field('rsvp-button-link',array('output'=>'raw')).'" target="_blank" class="button red-button">Attend Event</a>';
							}
						}

						
					
?>

					</div>
				</div>
				<!-- end excerpt and meta -->
				<!-- add thumbnail caption -->
<?php
				if (has_post_thumbnail(get_the_ID())) {
?>								
					<div class="section group division soft-division">
						<div class="col span_2_of_6_offset_4">
							<?php echo the_thumbnail_caption(get_the_ID()); ?>
						</div>					
					</div>
<?php
				}
?>
				</div>

				<!-- multimedia -->
<?php
				$audio_embed = types_render_field('news-events-audio',array("output"=>"raw"));
				$video_embed = types_render_field('news-events-video',array("output"=>"raw"));
				if (strlen(trim($audio_embed)) >0 || strlen(trim($video_embed))>0) {
?>										
					<div class="section section-tight group division soft-division" id="multimedia">
						<!-- something is present. show multimedia tag -->
						<div class="col span_1_of_6"><div class="section-tag">Multimedia</div></div>

						<div class="col span_5_of_6 section-content">
<?php
							// video? render and close section
							
							if (strlen(trim($video_embed)) >0 ) {
								echo '<div class="video-embeds">';
								global $wp_embed;
								echo $wp_embed->run_shortcode('[embed width="825"]'.$video_embed.'[/embed]');
								echo '</div>';
							}							
							// audio
							if (strlen(trim($audio_embed)) >0 ) {								
								$thefields = get_post_meta($post->ID, 'wpcf-news-events-audio', false);
								echo '<div class="audio-embeds">';								
								foreach ($thefields as $field) { 
									
									echo do_shortcode('[soundcloud width="47.5%" params="show_artwork=false"]'.$field.'[/soundcloud]');									
								}						
								echo '</div>';		
							}							
?>				
						</div>					
					</div>
<?php
				}
?>				
				<!-- slideshow -->
<?php				
				$thefields = get_post_meta($post->ID, 'wpcf-slideshow-image', false);
				$slideshow_count = count($thefields);
				$hasSlides = count($thefields) > 0;
				$validArray = strlen(trim($thefields[0])) > 0;
		
// 				if (count($slideshow_count) > 0 && strlen(trim($thefields[0]))>0) {
				if ($hasSlides && $validArray) {
					$firstthumb = $thefields[0];
					$img_id = get_attachment_id_from_src($firstthumb); 
					$img_info =  wp_get_attachment( $img_id );
					$caption = $img_info['caption'];														
?>				
					<div class="section group" id="slideshow-thumbs-labels">
						<div class="col span_3_of_6"><div class="section-tag">Additional Photos (<?php echo $slideshow_count;?>)</div></div>
						<div class="col span_3_of_6"><div class="section-tag t-right">
							<a href="<?php echo $firstthumb;?>" rel="lightbox[slideshow]" title="<?php echo $caption;?>">View All As Slideshow ></a></div></div>
					</div>

<?php
					// check if there are any partner logos below. if there AREN'T, hide the border on this section:
					$extraclass='';
					if (strlen(trim(types_render_field('event-partner-logo',array("size"=>"slide-thumb")))) == 0 ) {
						$extraclass = "hide-border";
					}
?>


					<div class="section group division soft-division <?php echo $extraclass;?>" id="slideshow-thumbs">					
<?php							
						$count = 0;
						foreach ($thefields as $field) { 
							$img_id = get_attachment_id_from_src($field); 
							$img_info =  wp_get_attachment( $img_id );
							$caption = $img_info['caption'];									
							if ($count < 3) {
								echo '<div class="col span_2_of_6">';
 								// $thumb = str_replace('.jpg', '-600x430.jpg' , $field); 								
								echo '<a href="'.$field.'" rel="lightbox[slideshow]" title="'.$caption.'"><img src="'.$field.'"/></a>';										
								echo '</div>';
							} else {
								echo '<div><a href="'.$field.'" rel="lightbox[slideshow]" title="'.$caption.'" class="hidden_slideshow_thumb">image_'.$count.'</a></div>';										
							}
							$count++;
						}								
?>				
					</div>
<?php 
				}	
				//partner logos -->
				if (strlen(trim(types_render_field('event-partner-logo',array("size"=>"slide-thumb")))) >0 ) {
?>				
					<div class="section group" id="partner-labels">
						<div class="col span_3_of_6"><div class="section-tag">Event Partners</div></div>
					</div>
					<div class="section group division soft-division" id="partner-thumbs">					
<?php	
							echo '<div class="col span_2_of_6">';								
							echo(types_render_field( 'event-partner-logo', array( "size"=>"partner-thumb" , "separator" => '</div><div class="col span_2_of_6">') )); 
							echo '</div>';
?>				
					</div>
<?php 
				}	
?>			

				<div class="group section single-pagination">
<?php					
				// Previous/next post navigation.
				previous_post_link_plus( array(
                    'order_by' => 'custom',
                    'meta_key' => 'wpcf-news-event-date',
                    'post_type' => '',
                    'format' => '%link',
                    'link' => '< Previous '.$cat_name,
                    'tooltip' => false,
                    'in_same_cat' => true,
                    'before' => '<div class="col span_3_of_6 prev_col">',
                    'after' => '</div>'

                    ) ); 
				// &meta_key=wpcf-news-event-date&orderby=meta_value&order=DESC
				next_post_link_plus( array(
                    'order_by' => 'custom',
                    'meta_key' => 'wpcf-news-event-date',
                    'post_type' => '',
                    'format' => '%link',
                    'link' => 'Next '.$cat_name.' >',
                    'tooltip' => false,
                    'in_same_cat' => true,
                    'before' => '<div class="col span_3_of_6 next_col">',
                    'after' => '</div>'

                    ) ); 
?>

				</div>							

		</div>
	</div><!--end main-content-->

<?php
	endwhile;
?>


<?php
	get_footer();
?>	

	
