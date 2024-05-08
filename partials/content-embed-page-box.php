<?php
			$pageID = $thePage->ID;					
			$content = $thePage->post_content;
			$title = $thePage->post_title;			
			$content = apply_filters('the_content', $content);
?>
				
	<div class="col span_2_of_6">
		<div class="box-content">
			<h4><a href="<?php the_permalink() ?>">
				<?php if ($pageID == 34) { 
											
				// Remove History from Preservation History Database to shorten it
				$title_home = str_replace('History', '', $title);
				echo $title_home;

				} else 
					echo $title
				?>	
			</a></h4>
		
			<?php if (has_post_thumbnail($pageID)) { ?>	
				<a href="<?php the_permalink() ?>" class="home-box-link"><?php echo the_post_thumbnail('slide-thumb'); ?></a>
			<?php } elseif ($pageID == 5305) { ?>	
				<!-- backup thumbnail for zoom programming-->
				<a href="<?php the_permalink() ?>" class="home-box-link">
				<?php echo '<img src="' .get_template_directory_uri(). '/images/zoom-programming.jpg"></a>';?>
			<?php } ?>

			<?php 
				if ($thePage->post_excerpt) {
					echo '<p>'. wp_trim_words($thePage->post_excerpt, 30, '...' ) .'</p>';
					
					$readmoretext = get_post_meta($pageID, 'wpcf-read-more-text', true);
					
					if (strlen(trim($readmoretext))>0) {
						echo '<a href="'.get_permalink($pageID).'" class="block-link">'.$readmoretext.' ></a>';
					}
				} else {
					echo '<p>'. wp_trim_words($content, 30, '...' ) .'</p>';
				}
			?>

		</div>

		<div class="button-container">
			<a href="<?php the_permalink() ?>" class="button red-button">Visit
				<?php if ($pageID == 34) { 
											
				// Remove History from Preservation History Database to shorten it
				$title_home = str_replace('History', '', $title);
				echo $title_home;

				} else 
					echo $title
				?>	
			</a>

		</div>

	</div>
			

									
