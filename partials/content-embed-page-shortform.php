<?php
			$pageID = $thePage->ID;					
			$content = $thePage->post_content;
			$title = $thePage->post_title;			
			$content = apply_filters('the_content', $content);
?>

			<div class="<?php echo $thePage->post_name;?>-page-excerpt <?php echo (isset($div_override) && strlen(trim($div_override))>0 ? $div_override : 'division');?>">
<?php
				if (has_post_thumbnail($pageID)) {
?>					
					<div class="section group page-summary">					
						<div class="col span_5_of_6_offset_1">						
							<?php echo get_the_post_thumbnail($pageID,'soft-large' ); ?>	
						</div>
					</div>
<?php
				}
?>									
				<div class="section group page-summary">
					<div class="col span_5_of_6_offset_1">
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
?> 
					</div>
				</div>


<?php
				if (has_post_thumbnail($pageID) && strlen(trim(the_thumbnail_caption($pageID)))>0) {
?>
				<div class="section group ">
<?php
					if ($captionAlign=="left") {
?>						
						<div class="col span_1_of_6">&nbsp;</div>
						<div class="col span_2_of_6">
							<?php echo the_thumbnail_caption($pageID); ?>
						</div>
<?php
					} else {
?>					
						<div class="col span_2_of_6_offset_4">
							<?php echo the_thumbnail_caption($pageID); ?>
						</div>
<?php 
					}
?>					
				</div>
<?php
				}
?>				
			</div>