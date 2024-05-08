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
 * Template Name: Resource Library
 *
 */

get_header(); ?>

<div id="main-content" class="main-content container resources-listing">

	<div id="content" class="site-content division" role="main">	
		<!-- page title on mobile only -->
		<div class="section group mobile-only"><div class="col span_6_of_6"><h1>Resource Library</h1></div></div>				

<?php					
		// resource library PAGE content
		$thePage = get_page_by_title( 'Resource Library' );
		$captionAlign="right";
		include(locate_template('partials/content-embed-page-shortform.php'));			
?>
			

<?php
		// first get top level categories
		$top_categories = get_categories( array(
		    'taxonomy' => 'resource-categories',
		    'parent' => 0,
		    'orderby' =>'term_id',
		    'order'=>'asc'
		) );
?>


<div id="library-grid">

<?php
// start category loop		
foreach( $top_categories as $category ) {

        echo '<div class="parent-category-group division" id="'.$category->slug.'">';
        echo '<h2>'.$category->name.'</h2>';

        // does this category have children??
		$child_categories = get_categories( array(
		    'taxonomy' => 'resource-categories',
		    'parent' => $category->term_id,
		    'orderby' =>'term_id',
		    'order'=>'asc'
		) );        
		if (!empty($child_categories) && count($child_categories)){
			foreach ($child_categories as $child) {
	
		        echo '<div class="child-category-group">';
		        echo '<h3 class="section-tag">'.$child->name.'</h2>';	
		        echo '<div class="section group">';
		        $resource_posts = get_posts_for_category( 'library', 'resource-categories',  $child->term_id);	
		        include(locate_template('partials/content-resources.php'));							
				echo '</div></div>';	
			}
		} else {
			echo '<div class="category-content-group section group">';
				$resource_posts = get_posts_for_category( 'library', 'resource-categories',  $category->term_id);
				include(locate_template('partials/content-resources.php'));			
			echo '</div>';
		}

        echo '</div>';
}       
?>        

</div><!--end library grid-->



	</div><!--content-->


</div><!-- #main-content -->

<?php
get_footer();
?>