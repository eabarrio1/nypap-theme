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

		$single_phd_id = get_the_ID();
?>					

<div id="main-content" class="main-content container oral-history-single">

	<div id="content" class="site-content" role="main">
		<!-- page title on mobile only -->
		<div class="section group mobile-only"><div class="col span_6_of_6"><h1>Our Collections</h1></div></div>				
<?php
		// set indicators and call partial to render post type labels
		$indicators = array(
			array("current"=>0,"slug"=>"/preservation-history","display"=>"Preservation History Database"),
			array("current"=>1,"slug"=>"/oral-history","display"=>"Oral Histories")
		);
		include(locate_template('partials/content-post-type-indicator.php'));			
?>	

			<div class="entry-content">
				<!-- image -->
				<div class="section group">

					<div class="col span_5_of_6_offset_1">
<?php 							
					if (has_post_thumbnail(get_the_ID())) {
						echo get_the_post_thumbnail(get_the_ID(), array('alt' => get_the_title()) ); 
					} 
?>					
					</div>
				</div>	
				<!-- tag, title -->
				<div class="section group">
<?php
					$terms = get_the_terms( get_the_ID(),'oral-history-categor');
					if ( $terms && ! is_wp_error( $terms ) ) {
						foreach ($terms as $term) {
							echo '<div class="col span_1_of_6"><div class="tags">'.$term->name.'</div></div><div class="col span_5_of_6">';						
						}
						
					} else {
						echo '<div class="col span_5_of_6_offset_1">';
					}					
?>					
					<!-- <div class="col span_1_of_6"><?php the_terms( get_the_ID(),'oral-history-categor','<div class="tags">', '/', '</div>' );?></div> -->
				<!-- </div> -->
					<!-- <div class="col span_5_of_6"> -->
						<h2><?php the_title();?></h2></div>
				</div>

				

				<div class="division soft-division">
					<div class="section section-tight group">
						<!-- excerpt, subtitle, location, tags, all fit in this column -->
						<div class="col span_5_of_6 offset_1">						
<?php
							// <!-- subtitle /excerpt-->
							if (types_render_field('oral-hist-subtitle',array("output"=>"raw"))) {
								echo '<div class="intro"><p>'.types_render_field('oral-hist-subtitle',array("output"=>"raw")).'</p></div>';
							}

							// <!-- participants -->
							$participants = nl2br(types_render_field('participants',array("output"=>"raw")));
							if (strlen(trim($participants)) > 0) {
								echo '<div class="participants-block grouped-meta">';
									echo '<div class="participants-text">'.$participants.'</div>';	
								echo '</div>';					
							}
							// date
							$oh_date = types_render_field('oral-history-date',array('output' => 'raw'));															
							if (strlen(trim($oh_date)) > 0) {
								echo '<div class="oh_date grouped-meta">';
									echo '<div class="participants-text">'.$oh_date.'</div>';	
								echo '</div>';					
							}						
?>

							<!-- people, places, orgs, public policy -->
							<div class="free-form-meta-tags grouped-meta">
<?php							
								$people = types_render_field('oh-people',array("output"=>"html"));
								$places = types_render_field('oh-places',array("output"=>"html"));
								$orgs = types_render_field('oh-organizations',array("output"=>"html"));
								$policy = types_render_field('oh-public-policy',array("output"=>"html"));

								echo (strlen(trim($people))>0 ? '<div class="people">People: '.strip_paragraphs($people).'</div>' : '');
								echo (strlen(trim($orgs))>0 ? '<div class="orgs">Organizations: '.strip_paragraphs($orgs).'</div>' : '');
								echo (strlen(trim($places))>0 ? '<div class="places">Places: '.strip_paragraphs($places).'</div>' : '');
								echo (strlen(trim($policy))>0 ? '<div class="policy">Policy: '.strip_paragraphs($policy).'</div>' : '');			
?>
							</div>
							<!-- downloadable transcript button -->
<?php
							$download_transcript = types_render_field('download-transcript',array('output' => 'raw'));															
							if (strlen(trim($download_transcript)) > 0) {
								echo '<div class="oh_download-transcript">';
									echo '<a class="button red-button" href="'.$download_transcript.'" target="_blank">Download PDF of Transcript</a>';	
								echo '</div>';					
							}
?>						
						</div>
					</div>
					<!-- end excerpt and meta -->
					<!-- add thumbnail caption -->
<?php
					if (strlen(trim(the_thumbnail_caption(get_the_ID())))>0) {
?>				
						<div class="section group">
							<div class="col span_2_of_6_offset_4">
								<?php echo the_thumbnail_caption(get_the_ID()); ?>
							</div>					
						</div>
<?php
					}
?>
				</div><!--end division-->

				<!-- body, 'overview'-->
				<div class="section section-tight group division soft-division" id="description">
					<?php $default = 1;?>
					<?php include(locate_template('partials/content-custom-section.php'));?>
				</div>

				<!-- multimedia -->
<?php
				$audio_embed = types_render_field('oral-history-audio',array("output"=>"raw"));
				$video_embed = types_render_field('oral-history-video',array("output"=>"raw"));
				$media_blob = types_render_field('media-blob',array("output"=>"raw"));
				if (strlen(trim($audio_embed)) >0 || strlen(trim($video_embed))>0 || strlen(trim($media_blob))>0) {
?>										
					<div class="section section-tight group division soft-division" id="multimedia">
						<!-- something is present. show multimedia tag -->
						<div class="col span_1_of_6"><div class="section-tag">Multimedia</div></div>

						<div class="col span_5_of_6 section-content">
<?php
							// video? render and close section
							if (strlen(trim($video_embed)) >0 ) {
								echo types_render_field('oral-history-video',array("output"=>"html", "width"=>"100%"));
							}							
							// audio
							if (strlen(trim($audio_embed)) >0 ) {								
								echo '<div class="audio-embeds">';	
								echo types_render_field('oral-history-audio',array("output"=>"html", 'separator'=>'</div><div class="audio-embeds">'));						
								echo '</div>';
							}

							// testing new media blob
							
							if (strlen(trim($media_blob)) >0 ) {
								echo types_render_field('media-blob',array("output"=>"html"));
							}																					
?>				
						</div>					
					</div>
<?php
				}
?>				

				<!-- transcript -->
				<div class="section group division soft-division" id="transcript">
					<div class="col span_1_of_6"><div class="section-tag">Transcript</div></div>
					<div class="col span_5_of_6 section-content">
<?php
						if (strlen(trim(types_render_field('transcript',array("output"=>"raw")))) >0 ) {
							echo types_render_field('transcript',array("output"=>"html"));
						}							
?>				
					</div>
				</div>				



			</div>
		</div>
	</div><!--end main-content-->

<?php
	endwhile;
?>


<?php
	get_footer();
?>	

	
