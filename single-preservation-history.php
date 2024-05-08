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

<div id="main-content" class="main-content container preservation-history-single">

	<div id="content" class="site-content" role="main">
		<!-- page title on mobile only -->
		<div class="section group mobile-only"><div class="col span_6_of_6"><h1>Our Collections</h1></div></div>				

<?php
		// set indicators and call partial to render post type labels
		$indicators = array(
			array("current"=>1,"slug"=>"/preservation-history","display"=>"Preservation History Database"),
			array("current"=>0,"slug"=>"/oral-history","display"=>"Oral Histories")
		);
		include(locate_template('partials/content-post-type-indicator.php'));			
?>	
			<div class="entry-content">
				<!-- image -->
				<div class="section group">

					<div class="col span_5_of_6_offset_1">
<?php 							
					if (has_post_thumbnail(get_the_ID())) {
						echo get_the_post_thumbnail(get_the_ID(),'soft-large', array('alt' => get_the_title()) ); 
					} 
?>					
					</div>
				</div>	
				<!-- tag, title -->
				<div class="section section-tight group">
					<div class="col span_1_of_6"><?php the_terms( get_the_ID(),'phd-category','<div class="tags">', '/', '</div>' );?></div>
					<div class="col span_4_of_6"><h2><?php the_title();?></h2></div>
				</div>

				

				
				<div class="section section-tight group">

					<!-- excerpt, subtitle, location, tags, all fit in this column -->
					<div class="col span_4_of_6 offset_1">						
<?php
						// <!-- subtitle -->
						if (types_render_field('subtitle',array("output"=>"raw"))) {
							echo '<p>'.types_render_field('subtitle',array("output"=>"raw")).'</p>';
						}
?>
						<!-- excerpt -->
						<div class="intro"><?php the_excerpt();?></div>						
<?php
						// <!-- location/neihborhood block -->
						$location = types_render_field('location',array("output"=>"raw"));
						$neighborhood = types_render_field('neighborhood',array("output"=>"raw"));
						$maplink = types_render_field('google-map-link',array("output"=>"raw"));
						if (strlen(trim($location)) > 0 || strlen(trim($neighborhood)) >0) {
							echo '<div class="location-block grouped-meta">';
								echo (strlen(trim($location)) > 0 ? '<div class="loc-text">Location: '.$location.(strlen(trim($maplink))> 0 ? '&nbsp;&nbsp;|&nbsp;&nbsp;<a href="'.$maplink.'" target="_blank">Google Maps</a>' : '').'</div>' : '');	
								echo (strlen(trim($neighborhood))>0 ? '<div class="neighborhood-text">Neighborhood: '.$neighborhood.'</div>': '');
							echo '</div>';					
						}
?>

						<!-- people, places, orgs, public policy -->
						<div class="free-form-meta-tags">
<?php							
							$people = types_render_field('people',array("output"=>"html"));
							$places = types_render_field('places',array("output"=>"html"));
							$orgs = types_render_field('organizations',array("output"=>"html"));
							$policy = types_render_field('public-policy',array("output"=>"html"));

							echo (strlen(trim($people))>0 ? '<div class="people">People: '.strip_paragraphs($people).'</div>' : '');
							echo (strlen(trim($orgs))>0 ? '<div class="orgs">Organizations: '.strip_paragraphs($orgs).'</div>' : '');
							echo (strlen(trim($places))>0 ? '<div class="places">Places: '.strip_paragraphs($places).'</div>' : '');
							echo (strlen(trim($policy))>0 ? '<div class="policy">Public Policy: '.strip_paragraphs($policy).'</div>' : '');			
?>
						</div>
					</div>
				</div>
				<!-- end excerpt and meta -->
				<!-- add thumbnail caption -->
				<div class="section section-tight group division soft-division">
					<div class="col span_2_of_6_offset_4">
						<?php echo the_thumbnail_caption($pageID); ?>
					</div>					
				</div>

				<!-- table of contents -->
				<div class="section section-tight group division soft-division table-of-contents">
					<div class="col span_1_of_6"><div class="section-tag">Table of Contents</div></div>
<?php
					$child_posts = types_child_posts('custom-section');
					$child_half_count = floor(count($child_posts)/2);
					$index = 0;
					echo '<div class="col span_2_of_6">';
						// add description:
						echo '<h3><a href="#description">Description</a></h3>';
					foreach ($child_posts as $child_post) {

					  	if ($index == $child_half_count)
					  		echo '</div><div class="col span_2_of_6">';
					  	echo '<h3><a href="#'.$child_post->post_name.'">'.$child_post->fields['section-title'].'</a></h3>';
						$index++;	
					}
					echo '</div>';					
?>
				</div>

				<!-- body, 'description' before custom sections-->
				<div class="section section-tight group division soft-division" id="description">
					<?php $default = 1;?>
					<?php include(locate_template('partials/content-custom-section.php'));?>
				</div>

				<!-- loop through custom sections (no soft-division class on last section ) -->
<?php
				foreach ($child_posts as $child_post) {
					$default = 0;					
					include(locate_template('partials/content-custom-section.php'));
					
				}
?>				
				<!-- footnotes -->
<?php
				if (types_render_field('footnotes',array("output"=>"raw"))) {				
?>					
				<div class="section group division footnotes">
					<div class="col span_1_of_6"><div class="section-tag">Footnotes</div></div>
					<div class="col span_5_of_6"><?php echo types_render_field('footnotes',array("output"=>"html"));?></div>
				</div>				
<?php
				}				
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

	
