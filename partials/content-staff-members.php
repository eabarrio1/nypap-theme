<?php

	$post_type = "staff";
	$sargs = array(
		'post_type' => $post_type,
		'numberposts' => -1,
		'meta_query'      => array(
			'relation'    => 'AND',
			'weighted_sort'   => array(
				'key'     => 'wpcf-secondary-sort-order',
				'compare' => 'EXISTS',
			),	
			'last_name' => array(
				'key'     => 'wpcf-last-name-sort',
				'compare' => 'EXISTS',
			),

		),
		'orderby' 		=> array(
			'weighted_sort' => 'ASC',
			'last_name'   => 'ASC',
		),			
		'order'=>'ASC'
	);	

	$sposts = get_posts($sargs);
	if ($sposts) {

		$staffcount = 0;
		$is_open = 0;
		
		echo ($post_type == "board-member" ? "<div class='section group'><h2>Board of Directors</h2></div>" : "");
		foreach ($sposts as $staff):

			// setup_postdata($staff); 
			$staffcount++;

			// start row / section
			if ($staffcount % 3 == 1) {
				echo '<div class="section group">';
				$is_open = 1;
			}				
?>
			<div class="col span_2_of_6">
				<!-- staff -->
				<?php if (has_post_thumbnail($staff->ID)) {?>
				    	<?php  echo get_the_post_thumbnail($staff->ID,'list-thumb', array('alt' => $staff->title) ); ?>
				<?php } ?>						
				<h3><?php echo $staff->title; ?></h3>

				<?php echo (strlen(trim(get_post_meta($staff->ID, 'wpcf-position', true)))>0 ? '<h4><em>'.get_post_meta($staff->ID, 'wpcf-position', true).'</em></h4>' : '');?>
				<?php echo $staff->post_content;?>

			</div>
<?php
			// end row
			if ($staffcount % 3 == 0) {
				echo '</div>';
				$is_open = 0;
			}
?>				
		<?php endforeach;
		// end row
		if ($is_open)
			echo '</div>';	

	}	
?>