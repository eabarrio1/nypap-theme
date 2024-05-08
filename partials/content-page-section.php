<?php

	$pageID = $thePage->ID;					
	$content = $thePage->post_content;
	$content = apply_filters('the_content', $content);		
?>
	<div class="section section-tight group page-summary division soft-division">
		<div class="col span_1_of_6"><div class="tags"><?php echo $thePageLabel;?></div></div>
		<div class="col span_5_of_6"><?php echo $content;?></div>
	</div>