<?php
			$pageID = $thePage->ID;					
			$content = $thePage->post_content;
			$title = $thePage->post_title;			
			$content = apply_filters('the_content', $content);
?>

			<div class="<?php echo $thePage->post_name;?>-page-excerpt division">
<?php
				if (has_post_thumbnail($pageID)) {
?>					
					<div class="section group page-summary">					
						<div class="col span_5_of_6_offset_1">						
							<?php echo get_the_post_thumbnail(); ?>	
						</div>
					</div>
<?php
				}
?>									
				<div class="section group page-summary">
<?php 
					if ($include_tag) {
?>						
						<div class="col span_1_of_6">
							<div class="section-tag">
								<?php if ($pageID == 5366) { 
									
									// Remove HOME from title
									$title_home = str_replace('Home', '', $title);
									
									echo $title_home;
									
								 } else 
									echo $title
								 ?>	

							</div>
						</div>
						<div class="col span_5_of_6">
<?php
					} else {
?>
						<div class="col span_5_of_6_offset_1">
<?php
					}
?>

					<!-- <div class="col span_5_of_6_offset_1"> -->
<?php 
						if ((int)$show_excerpt > 0) {
							echo '<p>'.$thePage->post_excerpt.'</p>';
							$readmoretext = get_post_meta($pageID, 'wpcf-read-more-text', true);
							if (strlen(trim($readmoretext))>0) {
								echo '<a href="'.get_permalink($pageID).'" class="block-link">'.$readmoretext.' ></a>';
							}
						} else {
							echo $content;
						}
						
						// Add Socials to About Us embed 
						
						if (is_page('About Us')){ 
							echo do_shortcode('[section_with_content content_1="featured_thumbnail_caption" content_2="social_buttons"]');
						}
					
						?> 
					</div>
				</div>
			
			</div>