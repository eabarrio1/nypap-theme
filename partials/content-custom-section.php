<!-- main body -->
<?php if ($default > 0) {?>

		<div class="col span_1_of_6"><div class="section-tag"><?php echo($post->post_type == "oral-history" ? "Overview" : "Description"); ?></div></div>

		<div class="col span_5_of_6 section-content"><?php the_content();?></div>
<?php } else { ?>
<!-- custom field -->
		<div class="section section-tight group division soft-division" id="<?php echo $child_post->post_name;?>">
			<div class="col span_1_of_6"><div class="section-tag"><?php echo $child_post->fields['section-title'];?></div></div>
			<div class="col span_5_of_6 section-content">
<?php
				// main body
				if (strlen(trim($child_post->fields['section-body'])) >0 ) {
					echo $child_post->fields['section-body'];
				}

				// image
				if (strlen(trim($child_post->fields['custom-section-image']))>0) {
					// echo $child_post->fields['custom-section-image'];
					echo wpcf_fields_image_view(array('size' => 'soft-large', 'field_value' => $child_post->fields['custom-section-image']));
				}	

				// caption
				if (strlen(trim($child_post->fields['section-img-caption']))>0) {
					// if there's a caption, we need to close the span_5_of_6 column 
					echo '</div>';
					// and then start a new  column in last 2 rows
					// to do: this needs a bigger top margin
					echo '<div class="col span_2_of_6_offset_4 section-margin-top">';
						echo '<div class="caption">'.$child_post->fields['section-img-caption'].'</div>';
					
					
				}							
?>				

			</div>
		</div>
<?php } ?>		