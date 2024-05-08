			<!-- heading -->
			<div class="section group" id="collection-listing">
				<div class="col span_3_of_6"><h2>The Oral History Collection</h2></div>
				<div class="col span_3_of_6">
					<!-- <a href="#" class="support-header-link">View As List ></a> -->
					<?php echo ($class_view == "list-view") ? '<a href="?grid#collection-listing" class="support-header-link">View As Grid ></a>' :  '<a href="?view=list#collection-listing" class="support-header-link">View As List ></a>';?>
				</div>
			</div>


			<div class="<?php echo $class_view;?>" id="phd-grid">
<?php
				$count = 0;
				$section_is_open = 0;

				// change the oderby and Start the Loop.
				query_posts($query_string . '&meta_key=wpcf-oh-sort-by&orderby=meta_value&order=ASC');
				while ( have_posts() ) : the_post();

					$count++;
					if ($count % 2 == 1) {
						echo '<div class="row-wrapper"><div class="section section-tight group">';
						$section_is_open = 1;
					}
?>
					<div class="col span_3_of_6 single-entry">
						<div class="section group thumb_container">  													
							<div class="span_2_of_3_offset_1 col">
								<a href="<?php the_permalink() ?>" rel="bookmark">
<?php
								if ( types_render_field('custom-thumbnail', array('size' => 'thumb')) ) { 
?>								
							    	<?php echo types_render_field('custom-thumbnail', array('size' => 'list-thumb') );?>
						    
<?php 							} else  if (has_post_thumbnail(get_the_ID())) {?>

						    		<?php  echo get_the_post_thumbnail(get_the_ID(),'list-thumb', array('alt' => get_the_title()) ); ?>
<?php 							} 
?>
								</a>
							</div>	
						</div>	
						<div class="section group">  			
<?php
							// $oral_hist_terms = get_the_term_list( get_the_ID(), 'oral-history-categor', '<div class="tags">', '/', '</div>' );

							$terms = get_the_terms( get_the_ID(), 'oral-history-categor');
							if ($terms && count($terms) > 0) {
								echo '<div class="span_1_of_3 col">';
								foreach ($terms as $term) {
									echo '<div class="tags"><a href="'.get_term_link( $term ).'?view='.$view_as.'#collection-listing">'.$term->name.'</div>';
								}
								echo '</div>';

							// if (strlen(trim($oral_hist_terms))> 0) {
								// echo '<div class="span_1_of_3 col">'.$oral_hist_terms.'</div>';
								echo '<div class="span_2_of_3 col">';
							} else {
								echo '<div class="span_2_of_3_offset_1 col">';
							}
?>															
								<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
								<p><strong><i><?php echo types_render_field('oral-hist-subtitle',array('output' => 'raw') );?></i></strong></p>
								<div class="excerpt">
									<?php echo types_render_field('participants',array('output' => 'raw') );?><br/>
									<?php echo types_render_field('oral-history-date',array('output' => 'raw') );?>
								</div>
								<a href="<?php the_permalink() ?>" class="block-link">Read More ></a>
							</div>
						</div>
					</div>
<?php						
					if ($count % 2 == 0) {
						echo '</div></div>';
						$section_is_open = 0;
					}

				endwhile;

				if ($section_is_open)
					echo '</div>';
?>	
		</div>
		<div class="section group"><div class="col span_6_of_6" id="button-container" data-button-label="View More Oral Histories"><?php load_more_button();?></div></div>