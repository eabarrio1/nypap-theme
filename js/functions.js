/* global screenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

( function( $ ) {
	var body, masthead, menuToggle, siteNavigation, socialNavigation, siteHeaderMenu, resizeTimer;

	// function initMainNavigation( container ) {

	// 	// Add dropdown toggle that displays child menu items.
	// 	var dropdownToggle = $( '<button />', {
	// 		'class': 'dropdown-toggle',
	// 		'aria-expanded': false
	// 	} ).append( $( '<span />', {
	// 		'class': 'screen-reader-text',
	// 		text: screenReaderText.expand
	// 	} ) );

	// 	container.find( '.menu-item-has-children > a' ).after( dropdownToggle );

	// 	// Toggle buttons and submenu items with active children menu items.
	// 	container.find( '.current-menu-ancestor > button' ).addClass( 'toggled-on' );
	// 	container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

	// 	// Add menu items with submenus to aria-haspopup="true".
	// 	container.find( '.menu-item-has-children' ).attr( 'aria-haspopup', 'true' );

	// 	container.find( '.dropdown-toggle' ).click( function( e ) {
	// 		var _this            = $( this ),
	// 			screenReaderSpan = _this.find( '.screen-reader-text' );

	// 		e.preventDefault();
	// 		_this.toggleClass( 'toggled-on' );
	// 		_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

	// 		// jscs:disable
	// 		_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
	// 		// jscs:enable
	// 		screenReaderSpan.text( screenReaderSpan.text() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
	// 	} );
	// }
	// initMainNavigation( $( '.main-navigation' ) );

	masthead         = $( '#masthead' );
	menuToggle       = masthead.find( '#menu-toggle' );
	siteHeaderMenu   = masthead.find( '#site-header-menu' );
	siteNavigation   = masthead.find( '#site-navigation' );
	socialNavigation = masthead.find( '#social-navigation' );

	// Enable menuToggle.
	( function() {

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

		// Add an initial values for the attribute.
		// menuToggle.add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded', 'false' );

		// menuToggle.on( 'click.twentysixteen', function() {
		// 	alert("click");
		// 	$( this ).add( siteHeaderMenu ).toggleClass( 'toggled-on' );


		// 	// rearrange:
		// 	$(".secondary-nav").appendTo($(".menu-main-navigation-container"));
		// 	// jscs:disable
		// 	// $( this ).add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded', $( this ).add( siteNavigation ).add( socialNavigation ).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
		// 	// jscs:enable
		// } );

		$( menuToggle ).on( 'click', function() {
			$(this).toggleClass("toggled-on");
			$( siteHeaderMenu ).toggleClass( 'toggled-on' );
			$( siteHeaderMenu ).slideToggle();
		} );


	} )();

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	( function() {
		if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( window.innerWidth >= 910 ) {
				$( document.body ).on( 'touchstart.twentysixteen', function( e ) {
					if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
						$( '.main-navigation li' ).removeClass( 'focus' );
					}
				} );
				siteNavigation.find( '.menu-item-has-children > a' ).on( 'touchstart.twentysixteen', function( e ) {
					var el = $( this ).parent( 'li' );

					if ( ! el.hasClass( 'focus' ) ) {
						e.preventDefault();
						el.toggleClass( 'focus' );
						el.siblings( '.focus' ).removeClass( 'focus' );
					}
				} );
			} else {
				siteNavigation.find( '.menu-item-has-children > a' ).unbind( 'touchstart.twentysixteen' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.twentysixteen', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find( 'a' ).on( 'focus.twentysixteen blur.twentysixteen', function() {
			$( this ).parents( '.menu-item' ).toggleClass( 'focus' );
		} );
	} )();

	// Add the default ARIA attributes for the menu toggle and the navigations.
	// function onResizeARIA() {
	// 	if ( window.innerWidth < 910 ) {
	// 		if ( menuToggle.hasClass( 'toggled-on' ) ) {
	// 			menuToggle.attr( 'aria-expanded', 'true' );
	// 		} else {
	// 			menuToggle.attr( 'aria-expanded', 'false' );
	// 		}

	// 		if ( siteHeaderMenu.hasClass( 'toggled-on' ) ) {
	// 			siteNavigation.attr( 'aria-expanded', 'true' );
	// 			socialNavigation.attr( 'aria-expanded', 'true' );
	// 		} else {
	// 			siteNavigation.attr( 'aria-expanded', 'false' );
	// 			socialNavigation.attr( 'aria-expanded', 'false' );
	// 		}

	// 		menuToggle.attr( 'aria-controls', 'site-navigation social-navigation' );
	// 	} else {
	// 		menuToggle.removeAttr( 'aria-expanded' );
	// 		siteNavigation.removeAttr( 'aria-expanded' );
	// 		socialNavigation.removeAttr( 'aria-expanded' );
	// 		menuToggle.removeAttr( 'aria-controls' );
	// 	}
	// }

	// Add 'below-entry-meta' class to elements.
	function belowEntryMetaClass( param ) {
		if ( body.hasClass( 'page' ) || body.hasClass( 'search' ) || body.hasClass( 'single-attachment' ) || body.hasClass( 'error404' ) ) {
			return;
		}

		$( '.entry-content' ).find( param ).each( function() {
			var element              = $( this ),
				elementPos           = element.offset(),
				elementPosTop        = elementPos.top,
				entryFooter          = element.closest( 'article' ).find( '.entry-footer' ),
				entryFooterPos       = entryFooter.offset(),
				entryFooterPosBottom = entryFooterPos.top + ( entryFooter.height() + 28 ),
				caption              = element.closest( 'figure' ),
				newImg;

			// Add 'below-entry-meta' to elements below the entry meta.
			if ( elementPosTop > entryFooterPosBottom ) {

				// Check if full-size images and captions are larger than or equal to 840px.
				if ( 'img.size-full' === param ) {

					// Create an image to find native image width of resized images (i.e. max-width: 100%).
					newImg = new Image();
					newImg.src = element.attr( 'src' );

					$( newImg ).load( function() {
						if ( newImg.width >= 840  ) {
							element.addClass( 'below-entry-meta' );

							if ( caption.hasClass( 'wp-caption' ) ) {
								caption.addClass( 'below-entry-meta' );
								caption.removeAttr( 'style' );
							}
						}
					} );
				} else {
					element.addClass( 'below-entry-meta' );
				}
			} else {
				element.removeClass( 'below-entry-meta' );
				caption.removeClass( 'below-entry-meta' );
			}
		} );
	}

	$(document).ready( function() {
		body = $(document.body);

		// load more buttons:
		if ($("#button-container").length > 0 && $(".elm-button").length > 0){
			var buttonLabel = $("#button-container").attr("data-button-label");
			$("#button-container button .elm-button-text").text(buttonLabel);
		}


		// filters / dropdowns:
		$("#phd-filters").selectmenu({
			appendTo:"#filter-container",
			width:"100%",
			positionOptions: {
				my: "left top",
				at: "left top",
				of: '#filter-container'
			} 

		});	

		$("#phd-filters").on('selectmenuchange', function(e,ui) {
			// window.location=ui.item.value+"/#filter-container";
			window.location=ui.item.value;
		});	      		
		
		// Metaslider Link - add to button

		$('.metaslider .slides li').each( function() {
			var href = $(this).find('a:first-child').attr('href');
			var target = $(this).find('a:first-child').attr('target');

			$(this).find('.link').attr("href", href).attr("target", target);; // Set herf value.
			
			console.log(href, target);
		});	 


		// George McAneny Timeline
  		$(".timeline-page-excerpt ul li").slice(0, 20).show();

		$(".timeline-container ul li img").each(function() {
			
			var img = $(this);
		    // Create dummy image to get real width and height
		    $(this).attr("src", $(img).attr("src")).load(function(){
		        var realWidth = this.width;
		        var realHeight = this.height;
		        
		        $(this).wrap( "<div class='image-container'><div class='inner'></div></div>" );
		        
		        if (realWidth > realHeight) {
		            $(this).addClass("horizontal");	            
		        } else if (realHeight > realWidth) {
			        $(this).addClass("vertical");
		        } else {
			        $(this).addClass("square");
		        };
		    });
		    
		});
		
			  
	  $("#loadMore").on("click", function(e){
	    e.preventDefault();
	    $(".timeline-page-excerpt ul li:hidden").slice(0, 20).css('opacity', 0).slideDown('slow').animate(
	    	{opacity: 1 },{queue: true, duration: 'fast' }
		);
	    if($(".timeline-page-excerpt ul li:hidden").length == 0) {
	      $("#loadMore").fadeOut();	    
	     }
	       
	  });
  
		// Cookie

/*
		var banner = $("#banner");
		var firstVisit = $.cookie("first-visit")

		if (firstVisit == null) {
			banner.removeClass('hidden');
			banner.addClass('show');
		} else {
			banner.removeClass('hidden');
			body.addClass('loaded');
		}

		// set cookie
		$.cookie('first-visit', 'yes', { expires: 1, path: '/' });
*/

	} );
	

			
} )( jQuery );
