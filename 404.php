<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); 

	$indicators = array();
	// Start the Loop.
	// while ( have_posts() ) : the_post();
		// $page_id = get_the_ID();		
		// $is_top_parent=1;
		// $parent_id = $page_id;
		// $parent_title = get_the_title();
		// // is this page a parent?
		// if( $post->post_parent ) { 
		// 	$is_top_parent=0;
		// 	$parent_id=wp_get_post_parent_id( $page_id );
		// 	$parent_title = get_the_title($parent_id);
		// }		

		// $menu_args = array(
		// 	'parent' => $parent_id,'post_type' => 'page', 'sort_column' => 'menu_order','sort_order' => 'ASC','hierarchical' => 0
		// ); 	
		// $menuitems = get_pages($menu_args);		
?>

<div id="main-content" class="main-content container page page-<?php echo str_replace(' ','-',strtolower(get_the_title()));?>">

	<div id="content" class="site-content" role="main">
		<div class="section group "><div class="col span_6_of_6">


			<p class="intro">Oops!<br/>The requested page cannot be found.</p>

		</div>
	</div>






	</div><!-- .site-content -->


</div><!-- .content-area -->

<?php get_footer(); ?>
