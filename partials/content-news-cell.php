 <!-- start  cell -->
<div class="col span_3_of_6">
	<!-- image -->
	<div class="section group">  													
		<!-- show custom thumb if there is one. else featured thumb -->
		<div class="span_2_of_3_offset_1 col thumb_holder">
			<a href="<?php the_permalink() ?>" rel="bookmark">
<?php
			if ( types_render_field('custom-post-thumb', array('size' => 'thumb')) ) { 
?>								
		    	<?php echo types_render_field('custom-post-thumb', array('size' => 'list-thumb') );?>
	    
<?php 							
			} else  if (has_post_thumbnail(get_the_ID())) {?>

	    		<?php  echo get_the_post_thumbnail(get_the_ID(),'list-thumb', array('alt' => get_the_title()) ); ?>
<?php 		
			} else { ?>
			
				<?php  
					
					echo '<img src="' .get_template_directory_uri(). '/images/news-default1.png" class="no-image">'; 
1
				// 	$items = [1,2,3];
				// echo '<img src="' .get_template_directory_uri(). '/images/news-default' . $items[array_rand($items)] .'.jpg">'; 
					
/*
					echo '<img src="'.get_template_directory_uri(). '/images/news-default';
					
					for ($i = 0; $i < 3; $i++) {
					  echo $i;
					}
					
					echo '.jpg">'; 
*/
					
					?>

<?php 		}?>

			</a>
		</div>	
	</div>	
	<!-- terms, title, excerpt, read more -->
	<div class="section group">  											
		<div class="span_1_of_3 col"><?php the_terms( get_the_ID(), 'category', '<div class="tags">', '/', '</div>' );?></div>
		<div class="span_2_of_3 col">
		
			<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<p><strong><i>
<?php 
				// elena update 08.17.2020
				// echo types_render_field('news-event-date',array('output'=>'raw'));
				
				echo get_the_date('F j, Y');
				echo '<br/>';
				echo types_render_field('news-author',array('output'=>'raw')). '<br/>' .types_render_field('news-source-subtitle',array('output'=>'raw')); 
?>	
			</i></strong></p>
			<div class="excerpt">
				<div class="excerpt"><?php the_excerpt();?></div><a href="<?php the_permalink() ?>" class="block-link">Read More ></a>
			</div>
		</div>
	</div>
</div><!--end block-->