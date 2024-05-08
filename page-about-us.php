<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage NYPAP
 */

get_header(); 

	$indicators = array();
	// Start the Loop.
	while ( have_posts() ) : the_post();
		$page_id = get_the_ID();		
		$is_top_parent=1;
		$parent_id = $page_id;
		$parent_title = get_the_title();
		// is this page a parent?
		if( $post->post_parent ) { 
			$is_top_parent=0;
			$parent_id=wp_get_post_parent_id( $page_id );
			$parent_title = get_the_title($parent_id);
		}		

		$menu_args = array(
			'parent' => $parent_id,'post_type' => 'page', 'sort_column' => 'menu_order','sort_order' => 'ASC','hierarchical' => 0
		); 	
		$page_args = array(
			'parent' => $page_id,'post_type' => 'page', 'sort_column' => 'menu_order','sort_order' => 'ASC','hierarchical' => 0
		); 			
		$menuitems = get_pages($menu_args);		
		$childpages = get_pages($page_args);		
?>

<div id="main-content" class="main-content container page page-<?php echo str_replace(' ','-',strtolower(get_the_title()));?>">

	<div id="content" class="site-content" role="main">
		<div class="section group "><div class="col span_6_of_6"><h1><?php echo $parent_title;?></h1></div></div>

<?php
		// set indicators and call partial to render post type labels
		if ( $menuitems ) {
			foreach ( $menuitems as $child ) {	
				$current = 0;
				if ($page_id==$child->ID)
					$current = 1;			
				array_push($indicators,array("current"=>$current,"slug"=>get_permalink($child->ID),"display"=> $child->post_title));
			}
			$items_are_children = 1;	
			include(locate_template('partials/content-post-type-indicator.php'));						
		}
?>


<?php		
		$thePage = $post; 
		$captionAlign = "left";
		include(locate_template('partials/content-embed-page-basic.php'));	

		// WHY
		$thePage = get_page_by_title( 'About Us: Why' );
		$thePageLabel = "Why?";
		include(locate_template('partials/content-page-section.php'));	

		// HOW
		$thePage = get_page_by_title( 'About Us: How' );
		$thePageLabel = "How?";
		include(locate_template('partials/content-page-section.php'));	

		// HELP
		$thePage = get_page_by_title( 'About Us: Help' );
		$thePageLabel = "How You can Help";
		include(locate_template('partials/content-page-section.php'));	

	endwhile;	
?>



	</div><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>
