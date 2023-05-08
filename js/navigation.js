/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, button, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}
	

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
//		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {
			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
// commented out by PMB 2020-06-25 to support tab key navigation
//					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
	// Script from Storefront | Mariana 20-04-2020
   // Add dropdown toggle that displays child menu items.
		var handheld = document.getElementsByClassName( 'handheld-navigation' );

		if ( handheld.length > 0 ) {
			[].forEach.call( handheld[0].querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' ), function( anchor ) {

				// Add dropdown toggle that displays child menu items
				var btn = document.createElement( 'button' );
				btn.setAttribute( 'aria-expanded', 'false' );
				btn.classList.add( 'dropdown-toggle' );

				var btnSpan = document.createElement( 'span' );
				btnSpan.classList.add( 'screen-reader-text' );
				btnSpan.appendChild( document.createTextNode( miles2020ScreenReaderText.expand ) );

				btn.appendChild( btnSpan );

				anchor.parentNode.insertBefore( btn, anchor.nextSibling );

				// Set the active submenu dropdown toggle button initial state
				if ( anchor.parentNode.classList.contains( 'current-menu-ancestor' ) ) {
					btn.setAttribute( 'aria-expanded', 'true' );
					btn.classList.add( 'toggled-on' );
					btn.nextElementSibling.classList.add( 'toggled-on' );
				}

				// Add event listener
				btn.addEventListener( 'click', function() {
					btn.classList.toggle( 'toggled-on' );

					// Remove text inside span
					while ( btnSpan.firstChild ) {
						btnSpan.removeChild( btnSpan.firstChild );
					}

					var expanded = btn.classList.contains( 'toggled-on' );

					btn.setAttribute( 'aria-expanded', expanded );
					btnSpan.appendChild( document.createTextNode( expanded ? miles2020ScreenReaderText.collapse : miles2020ScreenReaderText.expand ) );
					btn.nextElementSibling.classList.toggle( 'toggled-on' );
				} );
			} );
		}

		// Add focus class to parents of sub-menu anchors.
		[].forEach.call( document.querySelectorAll( '.site-header .menu-item > a, .site-header .page_item > a, .site-header-cart a' ), function( anchor ) {
			anchor.addEventListener( 'focus', function() {

				// Remove focus class from other sub-menus previously open.
				var elems = document.querySelectorAll( '.focus' );

				[].forEach.call( elems, function( el ) {
					if ( ! el.contains( anchor ) ) {
						el.classList.remove( 'focus' );

						// Remove blocked class, if it exists.
						if ( el.firstChild && el.firstChild.classList ) {
							el.firstChild.classList.remove( 'blocked' );
						}
					}
				} );

				// Add focus class.
				var li = anchor.parentNode;

				li.classList.add( 'focus' );
			} );
		} );

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
			//		menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();

// Mariana 2020-04-10
// Toggle Meny button
jQuery('.menu-toggle').click(function (e) {
  console.log("click");
	
  jQuery(this).siblings('.handheld-navigation').toggleClass('is-active');

  var activemenus =  jQuery(this).siblings('.handheld-navigation.is-active').length;

  if (activemenus>0) {
    console.log("Yes");
  
 // jQuery('#page').addClass('open-menu');
  jQuery('body').addClass('open-menu');

 } else {
  console.log("No");
  
 //  jQuery('#page').removeClass('open-menu');
   jQuery('body').removeClass('open-menu');
 }
});


// Sticky Menu JQUery

var el = jQuery(".site-main");
var menu = jQuery("#masthead");
var menuItems = jQuery(".main-navigation > a");
var pos = el.offset().top;
didScroll = false;

jQuery(window).on("scroll", function() {
  didScroll = true;
});


setInterval(function() {
  if(didScroll) {
    didScroll = false;
      var scrollPos = jQuery(window).scrollTop();
  

  if (scrollPos > (pos - 25)) { //Adjust menu opening
    // menu.addClass('fixed');
  } 
  else { 
    // menu.removeClass('fixed');
  }; 
  jQuery('.inview').each(function(){
  var itemOffset = Math.abs(jQuery(this).offset().top);
    if (itemOffset > 0 && itemOffset < scrollPos) {
      var menuElm = jQuery(this).attr('id');
      console.log(menuElm);
      menuItems.removeClass("active");
      jQuery("." + menuElm).addClass("active");
    }
  });     
  }
}, 250);



// Block accordion

// pointer to remember chosen accordion PMB 2019-06-20
var activeAccordion = null;

jQuery(document).ready(function () {

    // ----------------------------
    // Accordion. code to open and lose accordion PMB 2019-06-20
    // ----------------------------
    jQuery('.accordion-button').click(function () {

        // $('.row-content').hide();

        if (jQuery(this).next().is(':hidden') == true) {
            jQuery(this).next().show();
            jQuery(this).addClass('open');

/*
            if (activeAccordion != null && activeAccordion != this) {
	        	$(activeAccordion).next().hide();
            	$(activeAccordion).removeClass('open');
            }
*/
            // set a pointer to remember the element PMB 2019-06-20
            activeAccordion = this;
        }
        else {
        	jQuery(this).next().hide();
        	jQuery(this).removeClass('open');
/*
        	$(activeAccordion).next().hide();
           	$(activeAccordion).removeClass('open');
*/
        }
    });
    jQuery('.row-content').hide(); // Hide Content
    jQuery('.accordion-title').removeClass('open');

});


/**********************
	Mega-menu
 ********************/
 
// Add Mega-menu Hamburger to menu-item with the class .has_hamburger 
jQuery('.menu-topmenu li.has-hamburger > a span').after("<div class=\"hamburger\"><div id=\"nav-icon\" class=\"menu-toggle-icon\" ><span></span><span></span><span></span><span></span></div></div> ");


// Toggle mega-menu Hamburger
jQuery('.menu-item.has-mega-menu > a').click(function (e) {
 jQuery(this).siblings('.mega-menu-block').toggleClass('is-active');
 if (jQuery(this).siblings('.mega-menu-block.is-active').length>0) {
  console.log("Yes");
  jQuery('.menu-item.has-hamburger').closest('ul').addClass('open-menu');
  jQuery('#page').addClass('open-menu');
  jQuery('.page').addClass('mega-menu-open');
  jQuery('.archive').addClass('mega-menu-open');
  jQuery('.single').addClass('mega-menu-open');
 } else {
  console.log("No");
  jQuery('.menu-item.has-hamburger').closest('ul').removeClass('open-menu');
  jQuery('#page').removeClass('open-menu');
  jQuery('.page').removeClass('mega-menu-open');
  jQuery('.archive').removeClass('mega-menu-open');
  jQuery('.single').removeClass('mega-menu-open');
 }
});



