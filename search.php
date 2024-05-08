<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage NYPAP
 */

get_header(); ?>

<div id="main-content" class="main-content container search-results">

	<div id="content" class="site-content" role="main">	

		<div class="section group">
			<div class="col span_6_of_6">
				<h1 class="search_term"><?php printf( __( 'You searched for: "%s"', 'twentysixteen' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
			</div>
		</div>

		<?php if ( have_posts() ) : ?>
			<!-- this is not really a grid, but the easy loader is looking for this container -->
			<div id="phd-grid">
			
			

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				$post_type = get_post_type( get_the_ID() );
				$posttypeobj = get_post_type_object( $post_type ); 
				// $custom_term_name = get_term_name($post_type);

?>
				<div id="post-<?php the_ID(); ?>" <?php post_class('section group division soft-division'); ?>>
				<!-- <article id="post-<?php the_ID(); ?>" > -->
					<div class="col span_1_of_6">
						<div class="tags">
<?php
							// echo $posttypeobj->labels->singular_name;
							// $terms = get_the_term_list( get_the_ID(), get_term_name($post_type) );
							// if (strlen(trim($terms))> 0) {
								// echo ':<br/>'.$terms;
								// echo '<div class="span_3_of_6 col">';
							// } 
							search_label();
								// echo '<div class="span_3_of_6 offset_1 col">';
							// }							
?>
						</div>
					</div>
					<div class="col span_3_of_6">
						<?php if ($post_type != "library") { ?>
							<?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
						<? } else { ?>

<?php
							if (strlen(trim(types_render_field('resource-download',array('output' => 'raw') )))>0) {
?>						
								<h2><a href="<?php echo types_render_field('resource-download',array('output' => 'raw') );?>" target="_blank"><?php the_title();?></a></h2>
<?php
							} else if (strlen(trim(types_render_field('external-link',array('output' => 'raw') )))>0) {
?>
								<h2><a href="<?php echo types_render_field('external-link',array('output' => 'raw') );?>" target="_blank"><?php the_title();?></a></h2>
<?php
							}	
?>	

						<? } ?>
						<!-- if oral history, show subtitle -->
						<?php if ($post_type == "oral-history") { ?>
							<p><?php echo types_render_field('oral-hist-subtitle',array('output' => 'raw') );?></p>
						<?php } else if ($post_type == "preservation-history") {?>
							<p><strong><i><?php echo types_render_field('subtitle',array('output' => 'raw') );?></i></strong></p>
							<p><?php the_excerpt();?></p>
						<?php }  else {?>
							<?php the_excerpt(); ?>
						<?php } ?>




<?php 	
						if ($post_type != "library") { 
?>
							<a href="<?php the_permalink() ?>" class="block-link">Read More ></a>							
<?php
						} else {
							if (strlen(trim(types_render_field('resource-download',array('output' => 'raw') )))>0) {
?>						
								<a href="<?php echo types_render_field('resource-download',array('output' => 'raw') );?>" target="_blank" class="block-link" >Download PDF ></a>
<?php
							} else if (strlen(trim(types_render_field('external-link',array('output' => 'raw') )))>0) {
?>
								<a href="<?php echo types_render_field('external-link',array('output' => 'raw') );?>" target="_blank" class="block-link" target="_blank">External Link ></a>
<?php
							}	
						}
?>							
					</div>
					<!-- to do: check if thumbnail exists AND for custom thumbnail  -->
					<div class="col span_2_of_6">
<?php
						if ( types_render_field('custom-thumbnail', array('size' => 'thumb')) ) { 
?>								
					    	<?php echo types_render_field('custom-thumbnail', array('size' => 'list-thumb') );?>
				    
<?php 					} else  if (has_post_thumbnail(get_the_ID())) {?>
				    		<?php  echo get_the_post_thumbnail(get_the_ID(),'list-thumb', array('alt' => get_the_title()) ); ?>
<?php 					} 
?>
					</div>
				</div>
					


				<!-- </article> -->
<?php				

			// End the loop.
			endwhile;
?>
		</div>
		<div class="section group division"><div class="col span_6_of_6" id="button-container" data-button-label="View More Results"><?php load_more_button();?></div></div>			
<?php
		else :
			echo '<div class="section group"><div class="col span_6_of_6">';
			echo '<p class="intro">Sorry there are no results for your search.<br/>Please try another term.</p>';
			echo '</div></div>';
?>

<?php
		endif;
		?>

		</div><!-- .site-main -->
	</div><!-- .content-area -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>
