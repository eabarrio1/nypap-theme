
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

get_header(); ?>

<div id="main-content" class="main-content container resources-listing">

	<div id="content" class="site-content" role="main">	
		<!-- page title on mobile only -->
		<div class="section group mobile-only"><div class="col span_6_of_6"><h1>Our Collections</h1></div></div>		
<?php
		// set indicators and call partial to render post type labels
		$indicators = array(
			array("current"=>0,"slug"=>"/preservation-history","display"=>"Preservation History Database"),
			array("current"=>0,"slug"=>"/oral-history","display"=>"Oral Histories")
		);
		include(locate_template('partials/content-post-type-indicator.php'));			
?>

<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
?>
			<div class="our-collections-page division section section-tight">
				<div class="section group page-summary">					

					<div class="col span_5_of_6_offset_1">
	<?php
						if (has_post_thumbnail()) {
							echo get_the_post_thumbnail(); 
					  	} 
	?>
					</div>
				</div>
				<div class="section group page-summary">
					<div class="col span_5_of_6_offset_1" >
						<?php the_content();?>
					</div>
				</div>
<?php 
				if (strlen(trim(the_thumbnail_caption(get_the_ID() ))) > 0) {
?>								
					<div class="section group ">
<?php
						echo ($captionAlign=="left" ? '<div class="col span_1_of_6">&nbsp;</div><div class="col span_2_of_6">' : '<div class="col span_2_of_6_offset_4">') ;
?>						
							<?php  echo the_thumbnail_caption(get_the_ID()); ?>
						</div>
					</div>				
<?php 
				}
?>					
				
			</div><!--end our-collections-page division -->
			<!-- pres database excerpt and categories -->
<?php					
			$thePage = get_page_by_title( 'Preservation History Database' );
?>

			<div class="<?php echo $thePage->post_name;?>-page-excerpt division">
				

				<div class="section group ">
					<div class="col span_5_of_6"><h2>The Preservation History Database</h2></div>
					<div class="col span_1_of_6"><a href="/preservation-history" class="support-header-link">View All ></a></div>
				</div>
				<div class="section group page-summary">
					<div class="col span_4_of_6">

						<?php echo $thePage->post_excerpt;?>
						<a href="/preservation-history" class="block-link">Explore This Collection ></a>
					</div>
				</div>

				<!-- two by two grid of preservation database categories -->
<?php
					$count = 0;
					$section_is_open = 0;
					// get preservation all database terms 
					$terms = get_terms( 'phd-category', 'hide_empty=0' );
					if  ($terms) {
?>
						<div class="two-by-two-grid" id="phd-grid">
<?php						
						foreach ($terms as $term) {

						$count++;
						// start row
						if ($count % 2 == 1) {
							echo '<div class="row-wrapper"><div class="section section-tight group">';
							$section_is_open = 1;
						}
?>
						 <!-- start  cell -->
						<div class="col span_3_of_6">
							<!-- image -->
							<div class="section group">  													
								<!-- show custom thumb if there is one. else featured thumb -->
								<div class="span_2_of_3_offset_1 col">
									<a href="<?php the_permalink() ?>" rel="bookmark">
<?php
									// if ( types_render_field('custom-thumbnail', array('size' => 'list-thumb')) ) { 

									echo types_render_termmeta("category-thumbnail", array( "term_id" => $term->term_id, "width" => "600", "height" => "474" ) );
?>
									</a>
								</div>	
							</div>	
							<!-- terms, title, excerpt, read more -->
							<div class="section group">  											
								<div class="span_1_of_3 col"><div class="tags"><a href="<?php echo get_term_link( $term );?>" title="<?php echo $term->slug;?>"><?php echo $term->name;?></a></div></div>
								<div class="span_2_of_3 col">
								
									<h3><a href="<?php the_permalink() ?>" rel="bookmark">
										<?php echo types_render_termmeta("category-subtitle",array("term_id" => $term->term_id,'output'=>'raw')); ?></a></h3>
									<div class="excerpt">
										<p><?php echo $term->description;?></p>										
									</div>
									<a href="<?php echo get_term_link( $term );?>" class="block-link">View All <?php echo $term->name;?> ></a>
								</div>
							</div>
						</div><!--end block-->
<?php						
						// end row
						if ($count % 2 == 0) {
							echo '</div></div>';
							$section_is_open = 0;
						}

					}/*end foreach*/

					if ($section_is_open)
						echo '</div>';
					} /*end if terms*/	
?>	

			</div><!--two-by-two-grid-->				

			<!--  oral history overview -->
			</div><!--oral history section-->
				<div class="section group ">
					<div class="col span_5_of_6"><h2>Oral Histories</h2></div>
					<div class="col span_1_of_6"><a href="/oral-history" class="support-header-link">View All ></a></div>
				</div>
<?php									
				$thePage = get_page_by_title( 'Oral Histories' );
				include(locate_template('partials/content-embed-page.php'));			
?>


<?php
		// End of the loop.
		endwhile;
?>

	</div><!-- .site-main -->


</div><!-- .content-area -->

<?php get_footer(); ?>
