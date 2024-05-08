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
		$captionAlign = "right";
		if ($post->post_title == "Support Us" || ($parent_title=="Support Us" && $post->post_title != "Work With Us")) {
			include(locate_template('partials/content-embed-page-basic.php'));	
		} else {
			include(locate_template('partials/content-embed-page-shortform.php'));	
		}

		// to do: embed membership form if relevent		
?>

<!-- now get children -->
<?php 

	if ( $childpages && $parent_title!="About Us") {
		foreach ( $childpages as $child ) {
			$thePage = $child;
			// black box
			if ($child->post_title=="Donate") {
				
				// include(locate_template('partials/content-callout-box.php'));					
			}
			else {
				if ($post->post_title == "Support Us") {
?>
					<div class="section group ">
						<div class="col span_5_of_6"><h2><?php echo $child->post_title;?></h2></div>
					</div>
<?php				
					$captionAlign = "right";
					$show_excerpt = 1;
					include(locate_template('partials/content-embed-page-shortform.php'));					
				} else {
					include(locate_template('partials/content-embed-page.php'));					
				}				 

			}
		}
	}

	endwhile;	

?>


	<!-- heading -->
	<div class="section group" id="collection-listing">
		<div class="col span_3_of_6"><h2>George McAneny Collection</h2></div>
	</div>


	<div id="phd-grid" class="two-by-two-grid">
		
		<?php $args = array('tag' => 'george-mcaneny');
			$recent_posts = new WP_Query( $args );

			if ($recent_posts->have_posts()) : 
	        while ($recent_posts->have_posts()) : $recent_posts->the_post();
				
			endwhile; 
			
			else :
			echo "Nothing";
			endif;
			wp_reset_postdata();
		?>
	  
		<?php
		$count = 0;
		$section_is_open = 0;

        while ($recent_posts->have_posts()) : $recent_posts->the_post();

			$count++;
			if ($count % 2 == 1) {
				echo '<div class="row-wrapper"><div class="section section-tight group">';
				$section_is_open = 1;
			}
?>
			<div class="col span_3_of_6 single-entry">
				
					<div class="span_1_of_3 col">
						<div class="tags">
			<?php				
							echo events_term(get_the_ID(), (int)types_render_field('news-event-date',array('output' => 'raw'))); 
							echo '<div class="subtags">';
							echo date('m.d.y');
							echo '<br/>';
							echo types_render_field('event-time',array('output'=>'raw')); 			
							echo '</div>';
			?>				
						</div>
					</div>
					<div class="span_2_of_3 col">
						<a href="<?php the_permalink() ?>" rel="bookmark">
							
							<?php if (has_post_thumbnail(get_the_ID())) {

								 echo get_the_post_thumbnail(get_the_ID(),'list-thumb', array('alt' => get_the_title()) ); 
	
							} else { 
			
								echo '<img src="' .get_template_directory_uri(). '/images/news-default1.png" class="no-image">'; 

							}?>
							
						</a>
						
						<h3><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						
						<div class="excerpt">
							<div class="excerpt"><?php the_excerpt();?></div>
							<a href="<?php the_permalink() ?>" class="block-link">Learn More ></a>
						</div>


					</div>	
				</div>	
				
		<?php						
			if ($count % 2 == 0) {
				echo '</div></div>';
				$section_is_open = 0;
			}

		endwhile;

		if ($section_is_open)
			echo '</div>';
?>	


	</div><!-- .site-main -->


</div><!-- .content-area -->

<?php get_footer(); ?>
