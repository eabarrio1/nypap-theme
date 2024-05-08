
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
 * Template Name: Oral History Category Listing
 *
 */

get_header(); ?>

<div id="main-content" class="main-content container preservation-history-db-listing">

	<div id="content" class="site-content division" role="main">

<?php
		// set indicators and call partial to render post type labels
		$indicators = array(
			array("current"=>0,"slug"=>"/preservation-history","display"=>"Preservation History Database"),
			array("current"=>1,"slug"=>"/oral-history","display"=>"Oral Histories")
		);
		include(locate_template('partials/content-post-type-indicator.php'));			
?>		

<?php			
			$class_view = "two-by-two-grid";
			$view_as = "grid";
			if (!empty($_GET) && !empty($_GET['view']) && $_GET['view']=="list"){
				$class_view = "list-view";
				$view_as = "list";
			}

			// oral history content
			$thePage = get_page_by_title( 'Oral Histories' );
			$captionAlign="right";
			$div_override = "section";
			include(locate_template('partials/content-embed-page-shortform.php'));			
?>
			<!-- featured videos per oral history category-->
			<div class="section section-tight group division">
				<div class="section group featured-section">
					<div class="tags col span_5_of_6">Featured Projects</div>
<?php
				$terms = get_terms( 'oral-history-categor', 'hide_empty=0' );
				if ($terms) {
					foreach ($terms as $term) {
						echo '<div class="col span_2_of_6">';
						$featured_thumb = types_render_termmeta("oh-cat-thumb", array( "term_id" => $term->term_id, "width" => "600", "height" => "474" ) );
							// image						
							echo '<div class="img-container">';
							if (strtolower($term->slug) == "diversity-the-outer-boroughs") { 
								echo '<a class="wp-colorbox-youtube cboxElement" href="http://www.youtube.com/embed/uZrXlLhtBaQ"></a>';
							} 				
							else if (strtolower($term->slug) == "through-the-legal-lens") {
								echo '<a class="wp-colorbox-youtube cboxElement" href="https://www.youtube.com/embed/fSNGL_mvSRo?rel=0"></a>';
							}										
							echo types_render_termmeta("oh-cat-thumb", array( "term_id" => $term->term_id, "width" => "600", "height" => "474" ) );
							echo '</div>';
						// echo (strtolower($term->slug) == "diversity-the-outer-boroughs" ? '</a>' : '');
						echo '<div class="tags"><span class="subtags"><a href="'.get_term_link($term).'#collection-listing">'.$term->name.'</a></span></div>';
						echo '<p>'.$term->description.'</p>';
						echo '</div>';
					}
				}
?>	
			</div>
		</div>

		<!-- render results -->
		<?php include (locate_template('partials/content-oral-hist-entries.php'));?>
	</div><!--content-->

</div><!-- #main-content -->

<?php
get_footer();
?>