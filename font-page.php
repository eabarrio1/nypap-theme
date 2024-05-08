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
	 * Template Name: Front Page
	 */
	
	get_header(); ?>
<div id="main-content" class="main-content container">
	<div id="content" class="site-content" role="main">
		<?php echo do_shortcode('[metaslider title="Home Slideshow"]'); ?>
		<?php					
			// about content
			$thePage = get_page(25);
			global $post;
			$post = $thePage;
			setup_postdata( $post );			
			$captionAlign="left";
			$include_tag = true;
			include(locate_template('partials/content-embed-page-about-home.php'));			
		?>
		<!-- featured videos per oral history category-->
		<div class="section group home-section featured-section">
			<?php
				// our collections
				$thePage = get_page(34);
				global $post;
				$post = $thePage;
				setup_postdata( $post );			
				$captionAlign="left";
				$include_tag = true;
				include(locate_template('partials/content-embed-page-box.php'));
				
				// Program Recordings
				$thePage = get_page(5305);
				global $post;
				$post = $thePage;
				setup_postdata( $post );			
				$captionAlign="left";
				$include_tag = true;
				include(locate_template('partials/content-embed-page-box.php'));	
				
				// oral histories
				$thePage = get_page(37);
				global $post;
				$post = $thePage;
				setup_postdata( $post );			
				$captionAlign="left";
				$include_tag = true;
				include(locate_template('partials/content-embed-page-box-oral.php'));	
				
				?>	
		</div>
		<!-- news & events -->
		<!-- <div class="news-events-preview division"> -->
		<div class="two-by-two-grid" id="phd-grid">	
			<?php
				global $post;
				
				$event_id = get_cat_ID( 'Events');
				$events = get_posts(array('posts_per_page' => 1,'post_type' => 'post','category'=>$event_id,'meta_key'=>'wpcf-news-event-date','orderby'=>'meta_value','order'=>'DESC'));
				
				$news_id = get_cat_ID( 'News');
				      
				// elena update 08.17.2020
				// 	$news = get_posts(array('posts_per_page' => 1,'post_type' => 'post','category'=>$news_id,'meta_key'=>'wpcf-news-event-date','orderby'=>'meta_value','order'=>'DESC'));
				$news = get_posts(array('posts_per_page' => 1,'post_type' => 'post','category'=>$news_id));
				
				echo '<div class="row-wrapper"><div class="section group">';
				if (!empty($news)) {
					// start row					
					$post = $news[0];
					setup_postdata( $post );
					include(locate_template('partials/content-single-post-cell.php'));			
				} else {
					echo '<div class="col span_3_of_6">&nbsp;</div>';
				}
				
				// then events
				if (!empty($events)) {
					$post = $events[0];
					setup_postdata( $post );
					include(locate_template('partials/content-single-post-cell.php'));			
				} else {
					echo '<div class="col span_3_of_6">&nbsp;</div>';
				}					
				echo '</div></div>';
						
				?>							
		</div>
	</div>
	<!-- #content -->
</div>
<!-- #main-content -->
<?php get_footer(); ?>