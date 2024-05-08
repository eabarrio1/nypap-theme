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
			} 
?>
			</a>
		</div>	
	</div>	
	<!-- terms, title, excerpt, read more -->
	<div class="section group">  											
		<div class="span_1_of_3 col">
			<div class="tags">
			<?php echo events_term(get_the_ID(), (int)types_render_field('news-event-date',array('output' => 'raw'))); ?>
			</div>
		</div>
		<div class="span_2_of_3 col">
		
			<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<p><strong><i>
<?php 
				echo date('l, F j, Y',types_render_field('news-event-date',array('output'=>'raw')));
				echo '<br/>';
				echo types_render_field('event-time',array('output'=>'raw')). ' | ' .types_render_field('event-location',array('output'=>'raw')); 
?>										
			</i></strong></p>
			<div class="excerpt">
				<div class="excerpt"><?php the_excerpt();?></div><a href="<?php the_permalink() ?>" class="block-link">Read More ></a>
			</div>
<?php
			// if the date is after NOW. 
			$timestamp = strtotime('+1 day', time());
			if ((int)types_render_field('news-event-date',array('output' => 'raw')) > time() && (int)types_render_field('include-rsvp-button',array('output' => 'raw' )) == 1) {
				echo '<a href="'.types_render_field('rsvp-button-link',array('output'=>'raw')).'" target="_blank" class="button red-button">Attend Event</a>';
			}   		 

?>			
		</div>
	</div>
</div><!--end block-->