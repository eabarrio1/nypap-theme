<?php
	$tax = $wp_query->get_queried_object();
	$current_tax_id =  $tax->term_id;
?>
<div class="section group" id="collection-listing">
	<div class="col span_4_of_6" id="filter-container">
		<select name="phd-filters" id="phd-filters">
			<option value="/preservation-history">All Topics</option>
<?php
			$terms = get_terms( 'phd-category', 'hide_empty=0' );
			if ($terms) {
				foreach ($terms as $term) {
					echo '<option value="'.get_term_link( $term ).'?view='.$view_as.'#collection-listing" '.($current_tax_id == $term->term_id ? " selected='selected'" : "").'>'.$term->name.'</option>';
				}
			}
?>						
		  
		</select>
	</div>
	<div class="col span_2_of_6">
		<?php echo ($class_view == "list-view") ? '<a href="?view=grid#collection-listing" class="support-header-link">View As Grid ></a>' :  '<a href="?view=list#collection-listing" class="support-header-link">View As List ></a>';?>
	</div>





</div>