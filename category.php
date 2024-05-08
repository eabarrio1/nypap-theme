<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage nypap
 *
 *
 */

get_header(); ?>

<?php
	$category_title = strtolower(single_cat_title('',false));
?>

<div id="main-content" class="main-content container archive <?php echo $category_title;?>-archive">

	<div id="content" class="site-content division" role="main">

		<!-- page title on mobile only -->
		<div class="section group mobile-only"><div class="col span_6_of_6"><h1>Events &amp; News</h1></div></div>				

<?php
		// set indicators and call partial to render post type labels
		$indicators = array(
			array("current"=>($category_title == "events" ? 1 : 0),"slug"=>"/events-news/events","display"=>"Events"),
			array("current"=>($category_title == "news" ? 1 : 0),"slug"=>"/events-news/news","display"=>"News")
		);
		include(locate_template('partials/content-post-type-indicator.php'));			
?>	
<?php					

			// what category am i? show appropriate page?
			$thePage = get_page_by_title( ucfirst(single_cat_title('', false)).' Page' );
			$captionAlign="right";
			include(locate_template('partials/content-embed-page-shortform.php'));			

			// change the oderby and Start the Loop.
			query_posts($query_string . '&meta_key=wpcf-news-event-date&orderby=meta_value&order=DESC');
			$category_heading = "NYPAP News";
			$upcoming_loop;
			if ($category_title=="events") {
				while ( have_posts() ) : the_post();
					// if the date is after NOW. 
					$timestamp = strtotime('+1 day', time());
					if ((int)types_render_field('news-event-date',array('output' => 'raw')) > time()) {
	  					$category_heading = "Upcoming Events";
	  					$upcoming_loop = 1;
	  				} else {
	  					$category_heading = "Past Events";
	  					$upcoming_loop = 0;
	  				}	  		 
					break;
				endwhile;
				rewind_posts();
			} 

?>

			<div class="section group">
				<div class="col span_6_of_6">
					<h2><?php echo $category_heading; ?></h2>
				</div>
			</div>

			<div class="two-by-two-grid section section-tight" id="phd-grid">
<?php
				$count = 0;
				$section_is_open = 0;

				// change the oderby and Start the Loop.
				
				// elena update 8.17.2020

				// query_posts($query_string . '&meta_key=wpcf-news-event-date&orderby=meta_value&order=DESC');
				
				if ($category_title=="events")
					query_posts($query_string . '&meta_key=wpcf-news-event-date&orderby=meta_value&order=DESC');
				else
					query_posts($query_string);
			
				// end elena update 
				
				while ( have_posts() ) : the_post();

					$count++;
					if ($category_title == "events") {
						// if we WERE in upcoming but now we're in past, close grid and change header.
						if ($upcoming_loop && (int)types_render_field('news-event-date',array('output' => 'raw')) < time()) {

							$upcoming_loop = 0;

							if ($section_is_open){
								echo '</div></div>';
								$section_is_open = 0;
							}
							// close two-by-two-grid
							echo '</div>';
							echo '<div class="section group"><div class="col span_6_of_6"><h2>Past Events</h2></div></div>';
							echo '<div class="two-by-two-grid" id="phd-grid">';
							$count = 1;
						}
					}
					
					// start row
					if ($count % 2 == 1) {
						echo '<div class="row-wrapper"><div class="section section-tight group">';
						$section_is_open = 1;
					}				
					if ($category_title=="events")
						include(locate_template('partials/content-events-cell.php'));			
					else
						include(locate_template('partials/content-news-cell.php'));			
?>

<?php
					// end row
					if ($count % 2 == 0) {
						echo '</div></div>';
						$section_is_open = 0;
					}										
				endwhile;
				if ($section_is_open)
					echo '</div></div>';				
?>	

		</div><!--two-by-two-grid-->
		<div class="section group">
			<!-- <div class="col span_6_of_6"> -->
				<?php if ($category_title=="events") {?>
					<div class="col span_6_of_6" id="button-container" data-button-label="View More Events"><?php load_more_button();?></div>
				<?php } else {?>
					<div class="col span_6_of_6" id="button-container" data-button-label="View More News"><?php load_more_button();?></div>
				<?php } ?>
			<!-- </div> -->
		</div>

	</div><!--content-->


</div><!-- #main-content -->

<?php
get_footer();
?>