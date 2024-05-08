<?php
/**
 * nypap functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'nypap_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 *
 */
function nypap_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
	// load_theme_textdomain( 'twentysixteen', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	// variable height, width at 825
// 	set_post_thumbnail_size( 825, 300, true ); //fixed height

	add_image_size( 'full-width', 1100, 300, true ); //variable height
	add_image_size( 'soft-large', 825, 99999 ); //variable height
	add_image_size( 'list-thumb', 600, 474, true ); //double display of 300 x 237
	add_image_size( 'newsletter-img', 600, 775, true ); //double display of 300 x 390
	add_image_size( 'slide-thumb', 600, 400, true ); //double display of 300 x 215
	add_image_size( 'partner-thumb', 600, 430 ); //double display of 300 x 215
	add_image_size( 'slideshow-zoom', 875 ); //max width 875 for slideshow. is this big enough?

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'nypap' ),
		'footer'  => __( 'Footer Menu', 'nypap' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	// add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );
}
endif; // nypap_setup
add_action( 'after_setup_theme', 'nypap_setup' );

 add_post_type_support( 'page', 'excerpt' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function nypap_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'nypap_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 */
function nypap_scripts() {

/*
	------------------------------------------------------------------------------------------------------
	START - Commented out by Elena 9/11/2020
	We are using the WP-SCSS plugin which compiles SASS files.
	See /scss folder in the root directory of the theme
	------------------------------------------------------------------------------------------------------
	
	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );
	
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'nypap-fonts', get_template_directory_uri() .'/css/fonts.css', array( ) ); //add arg in array if we are 
	
	// Load the reset style
	wp_enqueue_style( 'nypap-reset', get_template_directory_uri() . '/css/reset.css' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'nypap-grid', get_template_directory_uri() . '/css/grid.css' );

	// jquery ui stylesheet
	wp_enqueue_style( 'jquery-ui-css', get_template_directory_uri() . '/css/jquery-ui.css' ,array('nypap-fonts'));

	// Theme stylesheet.
	wp_enqueue_style( 'nypap-style', get_stylesheet_uri(), array( 'nypap-reset','nypap-fonts' ), current_time('timestamp'));
	
	------------------------------------------------------------------------------------------------------
	END - Commented out by Elena
	------------------------------------------------------------------------------------------------------
*/


	// TO DO: Load the html5 shiv.
	// wp_enqueue_script( 'nypap-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	// wp_script_add_data( 'nypap-html5', 'conditional', 'lt IE 9' );

//     wp_enqueue_script( 'jquery-cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array(), '1.4.1' );

	// wp_enqueue_script( 'nypap-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151112', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'nypap-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20151104' );
	}	

	wp_enqueue_script( 'jquery-ui-core');
	wp_enqueue_script( 'jquery-ui-widget');
	wp_enqueue_script( 'jquery-ui-position');
	wp_enqueue_script( 'jquery-ui-selectmenu');

	wp_enqueue_script( 'nypap-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20151204', true );		

	wp_localize_script( 'nypap-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'nypap' ),
		'collapse' => __( 'collapse child menu', 'nypap' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'nypap_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function nypap_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'nypap_body_classes' );


/* 
 * Customize Menu Item Classes
 *
 * @param array $classes, current menu classes
 * @param object $item, current menu item
 * @param object $args, menu arguments
 * @return array $classes
 */
function be_menu_item_classes( $classes, $item, $args ) {

	global $wp_query;
	// if( 'header' !== $args->theme_location )
	// 	return $classes;
	// echo 'title: '.$item->title;
	// echo 'post type: '.$wp_query->query_vars['post_type'];
    if(isset($wp_query->query_vars['post_type'])
    	&& ($wp_query->query_vars['post_type']=='oral-history' || $wp_query->query_vars['post_type']=='preservation-history') 
    	&& 'Our Collections' == $item->title ) {
    		$classes[] = 'current-menu-item';
    }	
    if(  (is_singular( 'post' ) || is_category()) && 'Events & News' == $item->title  )
		$classes[] = 'current-menu-item';
		

	// if( ( is_singular( 'oral-history' ) || is_singular( 'preservation-history' ) || is_category() || is_tag() ) && 'Collections' == $item->title )	
	// if( ( is_singular( 'code' ) || is_tax( 'code-tag' ) ) && 'Resource Library' == $item->title )
	// 	$classes[] = 'current-menu-item';
		
	// if( is_singular( 'projects' ) && 'Events & News' == $item->title )
	// 	$classes[] = 'current-menu-item';
		
	return array_unique( $classes );
}
add_filter( 'nav_menu_css_class', 'be_menu_item_classes', 10, 3 );


// Script for getting posts by category
function get_posts_for_category( $post_type, $cat_type, $cat_id ) {
	  
    $cat_type;
    $category;
    $post_type;
    $order_dir;

	$taxonomies = '';
	$count=1;

	$posts_array = get_posts(
	    array(
	        'posts_per_page' => -1,
	        'post_type' => 'library',
	        'tax_query' => array(
	            array(
	                'taxonomy' => 'resource-categories',
	                'field' => 'term_id',
	                'terms' => $cat_id,
	            )
	        ),
	        'orderby' => 'title',
	        'order' => 'ASC'
	    )
	);
	return $posts_array;		
}

// excerpt stuff

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');


function new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');

function the_thumbnail_caption($post_id = 0) {
	global $post;

	if ($post_id == 0)
		$post_id = $post->ID;

	$thumbnail_id    = get_post_thumbnail_id($post_id);

	$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

	if ($thumbnail_image/*  && isset($thumbnail_image[0])  */&& isset($thumbnail_image[0]->post_excerpt)) {
		if (isset($thumbnail_image[0]->post_excerpt) && strlen(trim($thumbnail_image[0]->post_excerpt))>0){	
			return '<div class="front-caption">Above: '.$thumbnail_image[0]->post_excerpt.'</div>';
		}
	}
	return '';
	
} 

function strip_paragraphs($to_strip) {

	$new_copy = strip_tags($to_strip, '<i><b><strong><a>');
	return $new_copy;
}

function search_label() {
	$post_type = get_post_type( get_the_ID() );
	$post_type_label = "";
	if ($post_type != "post") {
		$posttypeobj = get_post_type_object( $post_type );
		$post_type_label = $posttypeobj->labels->singular_name; 
		if (strtolower($post_type_label)=="preservation history database entry") {
			$post_type_label = "Preservation History Database";
		}
		else if (strtolower($post_type_label)=="oral history entry") {
			$post_type_label = "Oral Histories";
		}			
	}

	$terms = get_the_term_list( get_the_ID(), get_term_name($post_type) );		
		
	echo ((strlen(trim($post_type_label)) > 0 && strlen(trim($terms))>0) ? $post_type_label.':<br/>'.$terms : $post_type_label.$terms);

}

// exclude certain post types from search
add_action( 'init', 'update_custom_post_type', 99 );
 
function update_custom_post_type() {
	global $wp_post_types;
 
	if ( post_type_exists( 'custom-section' ) ) {
 
		// exclude from search results
		$wp_post_types['custom-section']->exclude_from_search = true;
	}
}

function get_term_name($posttype) {
	// echo 'post type = '.$posttype;
	if ($posttype=="oral-history") {
		return "oral-history-categor";
	} else if ($posttype=="preservation-history") {
		return "phd-category";
	}
	return "category";
}

function events_term($postID, $events_date, $link = true) {

	$terms = get_the_terms( $postID, 'category' );

	if ( $terms && ! is_wp_error( $terms ) ) {

	  	foreach($terms as $term) {	

			$term_display = $term->name;
			if (strtolower($term_display) == "events") {
				$term_display = "Event";
			}

	  		$term_prefix = "Past ";
	  		if (strtolower($term->name) == "news") {
	  			$term_prefix = "Latest ";
	  		}
	  		// the below wasn't working with time b/c we are only storing date... not TIME. 
	  		// so add 24 hours to the date... that makes it good until midnight
	  		else if (($events_date + (24 * 60 * 60)) > time()) {
	  			$term_prefix = "Upcoming ";
	  		} 
	  		if ($link)
      			return '<a href="'.get_term_link($term).'">'.$term_prefix.$term_display.'</a>';
      		else 
      			return $term_prefix.$term->name; 	
	  	}	
	}
	return '';
}

// shortcode for donation boxes
function donation_box( $atts ) {
    $a = shortcode_atts( array(
        'default_amount' => '500.00',
        'donate_tag' => 'Donate Online Now',
        'donate_title' => 'Thank you for supporting NYPAP!',
        'donate_body' => '',
        'donate_readmore' => false,
        'cols' => 6
    ), $atts );

	ob_start();
	?><div class="section section-tight group page-summary">					
	<div class="donate-callout callout clearfix">	

		<div class="group section">			
			<div class="col span_1_of_<?php echo $a['cols'];?>">
				<div class="section-tag"><?php echo $a['donate_tag'];?></div>
			</div>

			<div class="col span_4_of_<?php echo $a['cols'];?>">
				<p><?php echo $a['donate_title'];?></p>
<?php
				if (strlen(trim(($a['donate_body'])))>0) {
					echo '<p>'.$a['donate_body'].'</p>';
				}
				if ((bool)$a['donate_readmore']) {
					echo '<a class="block-link" href="/support-us/donate">Read More ></a>';
				}				
?>			
			</div>

		</div>


		<div class="section section-tight group">	
			<div class="col span_4_of_<?php echo $a['cols'];?> offset_1"><div class="tags">Donation Amount:</div></div>
		</div>	
		<div class="section group">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
				<div class="col span_3_of_<?php echo $a['cols'];?> offset_1">

					<input type="hidden" name="return" id="edit-return" value="https://www.nypap.org/donation/thanks" />
					<input type="hidden" name="notify_url" id="edit-notify-url" value="https://www.nypap.org/ipn/donation" />
					
					<input type="hidden" name="cmd" value="_s-xclick" />
					<input type="hidden" name="hosted_button_id" value="JSMQSBMX9AM4U" />			
								
					<input type="text" maxlength="255" name="amount" id="edit-amount" size="40" value="$<?php echo $a['default_amount'];?>" class="form-text required" />
				</div>
				<div class="col span_1_of_<?php echo $a['cols'];?>">
					<input type="submit" name="submit" id="edit-submit" value="Donate"  class="button red-button form-submit" />
					<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />

				</div>							
			</form>
		</div>


<!--
		<div class="section section-tight group">	
			<div class="col span_4_of_<?php echo $a['cols'];?> offset_1"><div class="tags">Donation Amount:</div></div>
		</div>	
		<div class="section group">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">							
				<div class="col span_3_of_<?php echo $a['cols'];?> offset_1">
					<input TYPE="hidden" name="charset" value="utf-8">
					<input type="hidden" name="business" id="edit-business" value="info@nypap.org"  />
					<input type="hidden" name="cmd" value="_donations"  />
					<input type="hidden" name="item_name" value="NYPAP.org Donation"  />
					<input type="hidden" name="no_shipping" id="edit-no-shipping" value="1"  />
					<input type="hidden" name="return" id="edit-return" value="http://www.nypap.org/donation/thanks"  />
					 <input type="text" maxlength="255" name="amount" id="edit-amount" size="40" value="$<?php echo $a['default_amount'];?>" class="form-text required" />
					<input type="hidden" name="notify_url" id="edit-notify-url" value="http://www.nypap.org/ipn/donation"  />
					<input type="hidden" name="custom" id="edit-custom" value="0"  />
					<input type="hidden" name="form_build_id" id="form-8izE_XquX58yvm_Rnh9LfLOunI0VBDTA2gEYBFq4cyY" value="form-8izE_XquX58yvm_Rnh9LfLOunI0VBDTA2gEYBFq4cyY"  />
					<input type="hidden" name="form_id" id="edit-donation-form-build" value="donation_form_build"  />
				</div>
				<div class="col span_1_of_<?php echo $a['cols'];?>">
					<input type="submit" name="submit" id="edit-submit" value="Donate"  class="button red-button form-submit" />
				</div>							
			</form>
		</div>
-->
		
		</div>
	</div><?php
	return ob_get_clean();
}
add_shortcode( 'donate_box', 'donation_box' );



// shortcode for donation boxes
function donation_dropdown( $atts ) {
    $a = shortcode_atts( array(
        'default_amount' => '500.00',
        'donation_drop_tag' => 'Donate Online Now',
        'donation_drop_title' => 'Thank you for supporting NYPAP!',
        'donation_drop_body' => '',
        'donation_drop_readmore' => false,
        'cols' => 6
    ), $atts );

	ob_start();
	?>

<div class="section section-tight group page-summary">					
	<div class="donate-callout callout clearfix">	

		<div class="group section">			
			<div class="col span_1_of_6">
				<div class="section-tag"><?php echo $a['donation_drop_tag'];?></div>
			</div>

			<div class="col span_4_of_6">
				<div id="smart-button-container">
			      
			        <div style="margin-bottom: 1.25rem;">
			          <p><?php echo $a['donation_drop_title'];?></p>
			          <select id="item-options">
				          <option value="Benefit Co-Chair" price="1000">Benefit Co-Chair - 1000 USD</option>
				          <option value="Benefit Committee" price="500">Benefit Committee - 500 USD</option>
				          <option value="Benefit Supporter" price="150">Benefit Supporter - 150 USD</option>
				          <option value="Benefit Backer" price="75">Benefit Backer - 75 USD</option>
				          <option value="Name a table for an inspiring preservationist" price="250">Name a table for an inspiring preservationist - $250 USD</option></select>
			          <select style="visibility: hidden" id="quantitySelect"></select>
			        </div>
			    
			    </div>
				<div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>
			</div>							

			<script src="https://www.paypal.com/sdk/js?client-id=Abzrm8jmGHdpOnWOE9iU-WJoZM-Bwv3bvC0fssGg7ux2TZMSR8cq1EZOXnhpYgnRITTozIEGT0U3v-Qw&currency=USD" data-sdk-integration-source="button-factory"></script>
		    <script>
		      function initPayPalButton() {
		        var shipping = 0;
		        var itemOptions = document.querySelector("#smart-button-container #item-options");
		    var quantity = parseInt();
		    var quantitySelect = document.querySelector("#smart-button-container #quantitySelect");
		    if (!isNaN(quantity)) {
		      quantitySelect.style.visibility = "visible";
		    }
		    var orderDescription = 'Payment Levels';
		    if(orderDescription === '') {
		      orderDescription = 'Item';
		    }
		    paypal.Buttons({
		      style: {
		          shape: 'rect',
		          color: 'black',
		          layout: 'horizontal',
		          label: 'paypal',
		        
		      },
		      createOrder: function(data, actions) {
		        var selectedItemDescription = itemOptions.options[itemOptions.selectedIndex].value;
		        var selectedItemPrice = parseFloat(itemOptions.options[itemOptions.selectedIndex].getAttribute("price"));
		        var tax = (0 === 0) ? 0 : (selectedItemPrice * (parseFloat(0)/100));
		        if(quantitySelect.options.length > 0) {
		          quantity = parseInt(quantitySelect.options[quantitySelect.selectedIndex].value);
		        } else {
		          quantity = 1;
		        }
		
		        tax *= quantity;
		        tax = Math.round(tax * 100) / 100;
		        var priceTotal = quantity * selectedItemPrice + parseFloat(shipping) + tax;
		        priceTotal = Math.round(priceTotal * 100) / 100;
		        var itemTotalValue = Math.round((selectedItemPrice * quantity) * 100) / 100;
		
		        return actions.order.create({
		          purchase_units: [{
		            description: orderDescription,
		            amount: {
		              currency_code: 'USD',
		              value: priceTotal,
		              breakdown: {
		                item_total: {
		                  currency_code: 'USD',
		                  value: itemTotalValue,
		                },
		                shipping: {
		                  currency_code: 'USD',
		                  value: shipping,
		                },
		                tax_total: {
		                  currency_code: 'USD',
		                  value: tax,
		                }
		              }
		            },
		            items: [{
		              name: selectedItemDescription,
		              unit_amount: {
		                currency_code: 'USD',
		                value: selectedItemPrice,
		              },
		              quantity: quantity
		            }]
		          }]
		        });
		      },
		      onApprove: function(data, actions) {
		        return actions.order.capture().then(function(details) {
		          alert('Transaction completed by ' + details.payer.name.given_name + '!');
		        });
		      },
		      onError: function(err) {
		        console.log(err);
		      },
		    }).render('#paypal-button-container');
		  }
		  initPayPalButton();
		    </script>
	</div><?php
	return ob_get_clean();
}
add_shortcode( 'donate_dropdown', 'donation_dropdown' );



// shortcode for thumbnail captions
function featured_thumbnail_caption( $atts, $from_new_section = 0 ) {
    $a = shortcode_atts( array(
        'align' => 'left',
        'new_section' => 0
    ), $atts );
	global $post;

	if ($post_id == 0)
		$post_id = $post->ID;

	$thumbnail_id    = get_post_thumbnail_id($post_id);

	$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

	$cols = 6;
	if ($from_new_section)
		$cols = 5;

	if ($thumbnail_image && isset($thumbnail_image[0]) && isset($thumbnail_image[0]->post_excerpt)) {
		if (isset($thumbnail_image[0]->post_excerpt) && strlen(trim($thumbnail_image[0]->post_excerpt))>0){	
			$thumb_content = "";
			$thumb_content .= ((int)$a['new_section'] == 1 ? '<div class="section section-margin-top group">' : '');
			if ($a['align'] == "left") {
				$thumb_content .= '<div class="col span_2_of_'.$cols.' '.((int)$from_new_section == 1 ? '' : 'offset_1').' front-caption">Above: '.$thumbnail_image[0]->post_excerpt.'</div>';
			} else {
				$thumb_content .= '<div class="col span_2_of_'.$cols.'_offset_4 front-caption">Above: '.$thumbnail_image[0]->post_excerpt.'</div>';
			}
			$thumb_content .= ((int)$a['new_section'] == 1 ? '</div>' : '');
			return $thumb_content;
		}
	}
	return '';
	
}
add_shortcode( 'featured_thumbnail_caption', 'featured_thumbnail_caption' );

function social_buttons($atts, $from_new_section = 0) {
    $a = shortcode_atts( array(
        'label' => 'Follow Us:',
        'youtube' =>0
    ), $atts );
	$cols = 6;
	if ($from_new_section)
		$cols = 5;    
    $social_content = "";
    if (strlen(trim($a['label']))>0){
    	$social_content .= '<div class="col span_1_of_'.$cols.' social_label '.((int)$from_new_section == 1 ? 'offset_1' : '').'">'.$a['label'].'</div>';
    }
    if (strlen(trim($a['label']))>0){
    	$social_content .= '<div class="col span_1_of_'.$cols.'"><a class="button social-button instagram" href="https://www.instagram.com/nypap_org/" target="_blank">Instagram</a><a class="button social-button twitter" href="https://twitter.com/nypaproject" target="_blank">Twitter</a><a class="button social-button facebook" href="https://www.facebook.com/NYPAP" target="_blank">Facebook</a></div>';
    }    
    return $social_content;

}
add_shortcode( 'social_buttons', 'social_buttons' );

function section_with_content( $atts ) {
    $a = shortcode_atts( array(
        'content_1' => 'featured_thumbnail_caption',
        'content_2' => 'social_buttons'
    ), $atts );

    // $added_content = "</div><div></div>";
    $added_content = '<div class="section section-margin-top group">';

	if (strlen(trim($a['content_1']))>0) {
		$added_content .= call_user_func($a['content_1'],array(),1);
	} 
	if (strlen(trim($a['content_2']))>0) {
		$added_content .= call_user_func($a['content_2'],array(),1);
	} 

	$added_content .= '</div>';
	return $added_content;					
	
}
add_shortcode( 'section_with_content', 'section_with_content' );


// adding cite option to wysywig
// Add new styles to the TinyMCE "formats" menu dropdown
if ( ! function_exists( 'wpex_styles_dropdown' ) ) {
    function wpex_styles_dropdown( $settings ) {
        // Create array of new styles
        $new_styles = array(
            array(
                'title' => __( 'Custom Styles', 'wpex' ),
                'items' => array(
                    array(
                        'title'     => 'Cite',
                        'inline'		=> 'cite',
                        'classes'   => 'quote-citation'
                    ),
                ),
            ),
        );
        // Merge old & new styles
        $settings['style_formats_merge'] = true;
        // Add new styles
        $settings['style_formats'] = json_encode( $new_styles );
        // Return New Settings
        return $settings;
    }
}
add_filter( 'tiny_mce_before_init', 'wpex_styles_dropdown' );


// adding search capabilities - include custom fields
/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    
    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;
   
    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );




// trying to retrieve captions for custom fields
function get_attachment_id_from_src ($image_src) {
	global $wpdb;
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id = $wpdb->get_var($query);
	return $id;
}


add_filter( 'wp_get_attachment_image_src', function ( $image, $attachment_id, $size ) {

    // For thumbnails
    if ( $size ) {
        switch ( $size ) {
            case 'thumbnail':
            case 'medium':
            case 'medium-large':
            case 'large':
                $image[0] = str_replace( 'localhost:8888/wordpress/', 'nypap.com/', $image[0] );
                break;
            default:
                break;
        }
    } else {
        $image[0] = str_replace( 'localhost:8888/wordpress/', 'nypap.com/', $image[0] );
    }
    return $image;
}, 10, 3 );

function wp_get_attachment( $attachment_id ) {

	$attachment = get_post( $attachment_id );
	return array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
}

add_shortcode('newsletter-signup', 'newsletter_signup'); 

function newsletter_signup($attr, $content) {        
    ob_start();  
    get_template_part( 'partials/content', 'signup' ); 
    $ret = ob_get_contents();  
    ob_end_clean();  
    return $ret;    
}