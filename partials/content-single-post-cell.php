 <!-- start  cell -->
<div class="col span_3_of_6">

	<!-- terms, title, excerpt, read more -->
	<div class="section group">  											
		<div class="span_1_of_3 col">
			<div class="tags">
<?php				
				echo events_term(get_the_ID(), (int)types_render_field('news-event-date',array('output' => 'raw'))); 
				echo '<div class="subtags">';
				echo date('m.d.y',types_render_field('news-event-date',array('output'=>'raw')));
				echo '<br/>';
				echo types_render_field('event-time',array('output'=>'raw')); 			
				echo '</div>';
?>				
			</div>
		</div>
		<div class="span_2_of_3 col">
		
			<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>

			<div class="excerpt">
				<div class="excerpt"><?php the_excerpt();?></div><a href="<?php the_permalink() ?>" class="block-link">Learn More ></a>
			</div>


			
<?php
			// if ((int)types_render_field('include-rsvp-button',array('output' => 'raw' )) == 1) {
			// 	echo '<a href="'.types_render_field('rsvp-button-link',array('output'=>'raw')).'" target="_blank" class="button red-button">Attend Event</a>';
			// }

			// if the date is after NOW. 
			$timestamp = strtotime('+1 day', time());
			if ((int)types_render_field('news-event-date',array('output' => 'raw')) > time() && (int)types_render_field('include-rsvp-button',array('output' => 'raw' )) == 1) {
				echo '<a href="'.types_render_field('rsvp-button-link',array('output'=>'raw')).'" target="_blank" class="button red-button">Attend Event</a>';
			}   		 

?>

			
		</div>
	</div>
</div><!--end block-->