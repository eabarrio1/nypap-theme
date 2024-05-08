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
 * Template Name: Preservation History Listing
 *
 */

get_header(); ?>

<div id="main-content" class="main-content container preservation-history-db-listing">

	<div id="content" class="site-content division" role="main">

<?php
		// set indicators and call partial to render post type labels
		$indicators = array(
			array("current"=>1,"slug"=>"/preservation-history","display"=>"Preservation History Database"),
			array("current"=>0,"slug"=>"/oral-history","display"=>"Oral Histories")
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

			// pres history database content
			$thePage = get_page_by_title( 'Preservation History Database' );
			$captionAlign="right";
			include(locate_template('partials/content-embed-page-shortform.php'));			

			// filter menu
			include(locate_template('partials/content-phd-filter.php'));			
?>
			<!-- render results -->
			<?php include (locate_template('partials/content-pres-hist-db-entries.php'));?>

	</div><!--content-->


</div><!-- #main-content -->

<?php
get_footer();
?>