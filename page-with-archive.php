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
 *
 * Template Name: Page with Archive Template
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
		<div class="section group "><div class="col span_6_of_6">
			<?php echo ($is_top_parent ? '' : '<a href="'.get_permalink($parent_id).'">');?>
			<h1><?php echo $parent_title;?></h1>
			<?php echo ($is_top_parent ? '' : '</a>');?>
			</div></div>

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
		include(locate_template('partials/content-embed-page-shortform.php'));	
?>

		<!-- now show archive -->
<?php
		$post_type = "newsletter";
		$args = array(
			'post_type' => $post_type,
			'numberposts' => -1,
			'meta_key'=>'wpcf-newsletter-date',
			'orderby'=>'meta_value',		
			'order'=>'DESC'
		);		
		if ($post->post_name!="newsletters") {
			$post_type = "board-member";
			$args = array(
				'post_type' => $post_type,
				'numberposts' => -1,
				'meta_query'      => array(
					'relation'    => 'AND',
					'weighted_sort'   => array(
						'key'     => 'wpcf-secondary-sort-order',
						'compare' => 'EXISTS',
					),	
					'last_name' => array(
						'key'     => 'wpcf-last-name-sort',
						'compare' => 'EXISTS',
					),
		
				),
				'orderby' 		=> array(
					'weighted_sort' => 'ASC',
					'last_name'   => 'ASC',
				),			
				'order'=>'ASC'
			);						
		} 

	endwhile;		
		
		$posts = get_posts($args);

		if ($posts) {

			$count = 0;
			$section_is_open = 0;

			echo '<div class="division simple-archive-section archive-'.$post_type.'">';
			
			echo ($post_type == "board-member" ? "<div class='section group'><h2>Board of Directors</h2></div>" : "");
			foreach ($posts as $post):

				setup_postdata($post); 
				$count++;

				// start row / section
				if ($count % 3 == 1) {
					echo '<div class="section group">';
					$section_is_open = 1;
				}				
?>
				<div class="col span_2_of_6">
<?php 
					if ($post_type == "newsletter") {
?>						
						<a href="<?php echo types_render_field('downloadable-newslet',array('output' => 'raw') );?>" class="block-link" target="_blank">
							<!-- <img src=" " class="<?php echo $post_type;?>-img"/>-->
							<?php echo types_render_field('newsletter-thumbnail',array('size'=>'newsletter-img'));?>
						</a>
						<h3><?php the_title(); ?></h3>
						<a href="<?php echo types_render_field('downloadable-newslet',array('output' => 'raw') );?>" class="block-link" target="_blank">Download PDF ></a>
<?php						
					} else {
?>					
						<!-- board member -->
						<?php if (has_post_thumbnail(get_the_ID())) {?>
						    	<?php  echo get_the_post_thumbnail(get_the_ID(),'list-thumb', array('alt' => get_the_title()) ); ?>
						<?php } ?>						
						<h3><?php the_title(); ?></h3>
						<?php echo (strlen(trim(types_render_field('position',array('output' => 'raw'))))>0 ? '<h4><em>'.types_render_field('position',array('output' => 'raw')).'</em></h4>' : '');?>
						<?php the_content();?>
<?php
					}
?>
				</div>
<?php
				// end row
				if ($count % 3 == 0) {
					echo '</div>';
					$section_is_open = 0;
				}
?>				
			<?php endforeach;
			// end row
			if ($section_is_open)
				echo '</div>';	

			// end simple archive section
			echo '</div>';

			// if this is the board page, get matthew's bio! ...and future staff members
			if ($post_type == "board-member") {
				echo '<div class="simple-archive-section archive-'.$post_type.'">';
?>			
				<div class='section group'><h2>Staff</h2></div>				
<?php
				include(locate_template('partials/content-staff-members.php'));						

				// end simple archive section
				echo '</div>';							
			}

		}
		
?>		



	
		



	</div><!-- .site-main -->


</div><!-- .content-area -->

<?php get_footer(); ?>
