<?php
		// $indicators = array(
		// 	$current = array("current"=>"","slug"=>"/preservation-history","display"=>"Preservation History Database"),
		// 	$adjacent = array("slug"=>"/oral-history","display"=>"Oral Histories")
		// );
?>
<div class="section group page-category">
	<?php $index = 0;?>
	<?php foreach ($indicators as $indicator) {?>
		<div class="col span_1_of_6 <?php echo ($index == 0 ? 'offset_1' : '');?>">
			<<?php echo ($indicator['current'] > 0 ? "h1" : "div");?> class="post-type-tab"><a href="<?php echo $indicator['slug'];?>"><?php echo $indicator['display'];?></a></<?php echo ($indicator['current'] > 0 ? "h1" : "div");?>>
		</div>
		<?php $index++; ?>
	<?php } ?>
<!-- 	<div class="col span_1_of_6">
		<div class="post-type-tab"><a href="/oral-history">Oral Histories</a></div>
	</div> -->			
</div>