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
 *
 * Template Name: Job Listing Page
 */

get_header(); 

	while ( have_posts() ) : the_post();
			$thePage = $post;
			$pageID = $thePage->ID;					
			$content = $thePage->post_content;
			$title = $thePage->post_title;			
			$content = apply_filters('the_content', $content);	
?>

<div id="main-content" class="main-content container page page-joblisting">

	<div id="content" class="site-content" role="main">	

		<div class="division">
		
		<div class="section group "><div class="col span_6_of_6">
			<a href="/support-us"><h1>Support Us</h1></a>
		</div></div>		
<?php
		// set indicators and call partial to render post type labels
		$indicators = array(
			array("current"=>0,"slug"=>"/support-us/donate","display"=>"Donate"),
			array("current"=>0,"slug"=>"/support-us/stewardship-society/","display"=>"Stewardship Society"),
			array("current"=>0,"slug"=>"/support-us/columns-club/","display"=>"Columns Club"),
			array("current"=>1,"slug"=>"/support-us/work-with-us/","display"=>"Work With Us")
		);
		include(locate_template('partials/content-post-type-indicator.php'));			
?>

			
				<!-- image -->					
<?php 							
				if (has_post_thumbnail(get_the_ID())) {
					echo '<div class="section group">';
					echo '<div class="col span_5_of_6_offset_1">';
					echo get_the_post_thumbnail(get_the_ID(), array('alt' => get_the_title()) ); 
					echo '</div></div>';
				} 
?>					
				<!-- tag, title -->
				<div class="section group">
					<div class="col span_1_of_6">
						<div class="section-tag">Job Opening</div>
					</div>
					<div class="col span_5_of_6"><h2><?php the_title();?></h2></div>
				</div>
				<!-- content -->
				<div class="section group page-summary">
					<div class="col span_5_of_6 offset_1" >
						<?php the_content();?>
					</div>
				</div>
				<!-- caption -->
<?php
				if (has_post_thumbnail(get_the_ID()) && strlen(trim(the_thumbnail_caption($pageID)))>0) {
?>
					<div class="section group ">				
						<div class="col span_2_of_6_offset_4">
							<?php echo the_thumbnail_caption(get_the_ID()); ?>
						</div>
					</div>
<?php
				}
?>					

<?php				

	endwhile;	

?>


	</div>
	</div><!-- .site-main -->


</div><!-- .content-area -->

<?php get_footer(); ?>
