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
		$menuitems = get_pages($menu_args);		
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
		include(locate_template('partials/content-embed-page-basic.php'));	
?>

<?php 
	endwhile;	
?>


<div class="section section-tight group page-summary">					
	<div class="donate-callout callout clearfix">	

		<div class="group section">			
			<div class="col span_1_of_6">
				<div class="section-tag">Donation Amount:</div>
			</div>

			<div class="col span_4_of_6">



				<div id="smart-button-container">
				      <div style="text-align: center;">
				        <div style="margin-bottom: 1.25rem;">
				          <p>Payment Levels</p>
				          <select id="item-options"><option value="Benefit Co-Chair" price="1000">Benefit Co-Chair - 1000 USD</option><option value="Benefit Committee" price="500">Benefit Committee - 500 USD</option><option value="Benefit Supporter" price="150">Benefit Supporter - 150 USD</option><option value="Benefit Backer" price="75">Benefit Backer - 75 USD</option><option value="Name a table for an inspiring preservationist" price="250">Name a table for an inspiring preservationist - 250 USD</option></select>
				          <select style="visibility: hidden" id="quantitySelect"></select>
				        </div>
				      </div>
				    </div>

<!--
        <div id="item-options">
				          <input type="radio" value="Benefit Co-Chair" price="1000"></input><label>Benefit Co-Chair - 1000 USD</label>
				          <input type="radio" value="Benefit Committee" price="500"></input><label>Benefit Committee - 500 USD</label>
				          <input type="radio" value="Benefit Supporter" price="150"></input><label>Benefit Supporter - 150 USD</label>
				          <input type="radio" value="Benefit Backer" price="75"></input><label>Benefit Backer - 75 USD</label>
				          <input type="radio" value="Name a table for an inspiring preservationist" price="250"></input><label>Name a table for an inspiring preservationist - 250 USD</label>
				      </div>
  
-->
			
			
			
										    <div style="text-align: center; margin-top: 0.625rem;" id="paypal-button-container"></div>


				</div>							
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
    
    	

	</div><!-- .site-main -->


</div><!-- .content-area -->

<?php get_footer(); ?>
