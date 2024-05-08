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
 */

get_header(); ?>

<div id="main-content" class="main-content container">

<?php
	// if ( is_front_page() && tedcity_has_featured_posts() ) {
		// Include the featured content template.
		// get_template_part( 'featured-content' );
	// }
?>


		<div id="content" class="site-content" role="main">



			<div class="section group">



			</div>


			<div class="section group ">




					


			</div>




		</div><!-- #content -->



</div><!-- #main-content -->

<?php
get_footer();
?>