
				<div class="col span_3_of_6">
<?php
				$count = 0;				
				$half_count = ceil(count($resource_posts)/2);
				foreach ( $resource_posts as $post) : setup_postdata( $post ); 
					// done with first column... start second
					if ($count == $half_count) {
						echo '</div><div class="col span_3_of_6">';
					}
?>					 					
					<div class="resource-entry clearfix">
						<!-- terms, title, excerpt, read more -->							
						<h3><?php the_title(); ?></h3>
						<p><i><?php echo types_render_field('resource-subtitle',array('output' => 'raw') );?></i></p>
						<div class="excerpt"><?php the_content();?></div>

<?php
						if (strlen(trim(types_render_field('resource-download',array('output' => 'raw') )))>0) {
?>						
							<a href="<?php echo types_render_field('resource-download',array('output' => 'raw') );?>" class="button" target="_blank">Download PDF</a>
<?php 
						}
						if (strlen(trim(types_render_field('external-link',array('output' => 'raw') )))>0) {
?>
							<a href="<?php echo types_render_field('external-link',array('output' => 'raw') );?>" class="block-link" target="_blank">External Link ></a>
<?php
						}	
?>																	
					</div>
					
<?php						
					$count++;
				endforeach;
?>	
				</div>
