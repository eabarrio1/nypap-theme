
			<div class="<?php echo $class_view;?>" id="phd-grid">
<?php
				$count = 0;
				$section_is_open = 0;

				// Start the Loop.
				query_posts($query_string . '&meta_key=wpcf-sort-by&orderby=meta_value&order=ASC');
				while ( have_posts() ) : the_post();

					$count++;

					// start row
					if ($count % 2 == 1) {
						echo '<div class="row-wrapper"><div class="section section-tight group">';
						$section_is_open = 1;
					}
?>
					 <!-- start  cell -->
					<div class="col span_3_of_6 single-entry">
						<!-- image -->
						<div class="section group thumb_container">  													
							<!-- show custom thumb if there is one. else featured thumb -->
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
						<!-- terms, title, excerpt, read more -->
						<div class="section group">  											
							<div class="span_1_of_3 col">
<?php 
								$terms = get_the_terms( get_the_ID(), 'phd-category');
								foreach ($terms as $term) {
									echo '<div class="tags"><a href="'.get_term_link( $term ).'?view='.$view_as.'#collection-listing">'.$term->name.'</div>';
								}
?>
							</div>
							<div class="span_2_of_3 col">
							
								<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
								<p><strong><i><?php echo types_render_field('subtitle',array('output' => 'raw') );?></i></strong></p>
								<div class="excerpt"><?php the_excerpt();?></div><a href="<?php the_permalink() ?>" class="block-link">Read More ></a>
							</div>
						</div>
					</div><!--end block-->
<?php						
					// end row
					if ($count % 2 == 0) {
						echo '</div></div>';
						$section_is_open = 0;
					}

				endwhile;

				if ($section_is_open)
					echo '</div>';
?>	

		</div><!--two-by-two-grid-->

		<div class="section group"><div class="col span_6_of_6" id="button-container" data-button-label="View More Database Entries"><?php load_more_button();?></div></div>
