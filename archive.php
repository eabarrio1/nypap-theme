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
 * Template Name: News / Events Archive
 *
 */

get_header(); ?>

<?php
	// $q = new WP_Query( array( 'orderby' => array('oh-sort-by'=>'asc' ) ));
?>

<div id="main-content" class="main-content container archive news-events">

	<div id="content" class="site-content division" role="main">

		<!-- page title on mobile only -->
		<div class="section group mobile-only"><div class="col span_6_of_6"><h1>Events &amp; News</h1></div></div>		

<?php
		// set indicators and call partial to render post type labels
		$indicators = array(
			array("current"=>0,"slug"=>"/events-news/events","display"=>"Events"),
			array("current"=>0,"slug"=>"/events-news/news","display"=>"News")
		);
		include(locate_template('partials/content-post-type-indicator.php'));			
?>	
<?php					
			// pres history database content TODO: does this description differ from homepage description??
			$thePage = get_page_by_title( 'News And Events Page' );
			$captionAlign="right";
			include(locate_template('partials/content-embed-page-shortform.php'));			
?>

			<div class="two-by-two-grid" id="phd-grid">
				<div class="row-wrapper"><div class="section section-tight group">
					<div class="col span_3_of_6 heading-col"><h2>Events</h2><a href="/events-news/events" class="support-header-link">View All Events ></a></div>
					<div class="col span_3_of_6 heading-col"><h2>News</h2><a href="/events-news/news" class="support-header-link">View All News ></a></div>
				</div></div>

<?php

				global $post;

		        $event_id = get_cat_ID( 'Events');
		        $news_id = get_cat_ID( 'News');
				$events = get_posts(array('posts_per_page' => 4,'post_type' => 'post','category'=>$event_id,'meta_key'=>'wpcf-news-event-date','orderby'=>'meta_value','order'=>'DESC'));

				// elena update 8.17.2020
				// Updated so that news is organized by publish date
				//$news = get_posts(array('posts_per_page' => 4,'post_type' => 'post','category'=>$news_id,'meta_key'=>'wpcf-news-event-date','orderby'=>'meta_value','order'=>'DESC'));
				
				$news = get_posts(array('posts_per_page' => 4,'post_type' => 'post','category'=>$news_id));
				$loop_count = (count($events) > count($news) ? count($events) : count($news));

				for ( $i=0; $i<$loop_count;$i++){ 

					// start row
					echo '<div class="row-wrapper"><div class="section section-tight group">';

					// events first
					if (!empty($events) && count($events) > ($i)) {
						$post = $events[$i];
						setup_postdata( $post );
						include(locate_template('partials/content-events-cell.php'));			
					} else {
						echo '<div class="col span_3_of_6">&nbsp;</div>';
					}

					// then news
					if (!empty($news) && count($news) > ($i)) {
						$post = $news[$i];
						setup_postdata( $post );
						include(locate_template('partials/content-news-cell.php'));			
					} else {
						echo '<div class="col span_3_of_6">&nbsp;</div>';
					}					
					echo '</div></div>';
				}
?>	

		</div><!--two-by-two-grid-->

		<div class="section group">
			<div class="col span_3_of_6"><a href="/events-news/events" class="button button-full">View All Events</a></div>
			<div class="col span_3_of_6"><a href="/events-news/news" class="button button-full">View All News</a></div>
		</div>

	</div><!--content-->


</div><!-- #main-content -->

<?php
get_footer();
?>