/* Scripts */
(function( $ ){
	"use strict";

	/**
	 * Add class body on load
	 */
	$(window).on('load', function(){
		$('body').addClass('dom-loaded');
	});

	/** Window width **/
	var windowWidth = $( '#top' ).width(),
		$adminbar = $( '#wpadminbar' ),
		$siteHeader = $( '#site_header, .kind-header' ),
		breakPointSmall = 480, // Small screens break point
		breakPointMedium = 767; // Medium screen break point

	/**
	 * Get Scrollbar width
	 */
	kind.getScrollBarWidth = function() {
		const scrollbarWidth = window.innerWidth - document.body.clientWidth;
		document.documentElement.style.setProperty('--scroll-bar-width', scrollbarWidth + 'px');
	}

	/**
	 * Open Off-Canvas
	 */
	kind.openOffcanvas = function( e ){

		$('.kind-header').addClass('menu-open');

		setTimeout( function(){
			kindUpdateScreenReaderAlert(kind.i18n.a11y.offCanvasIsOpen);
			setTimeout( function(){
				$('.kind-offcanvas-close').focus();
			},500);
		},400);

	};

	/**
	 * Close Off-Canvas
	 */
	kind.closeOffcanvas = function( e ){

		if ( $('.kind-header').hasClass( 'menu-open' ) ) {
			$('.kind-header').removeClass( 'menu-open' );

			$('.main-menu')
				.find('.menu-item-has-children.open').removeClass('open')
				.find('.kind-mobile-submenu-toggle').attr('aria-expanded', 'false').attr('aria-label', kind.i18n.a11y.expand)
				.next('.sub-menu').slideUp( 300 );

			var focusButton = true;

			if ( $(e.target).parents('.main-menu').length ) {
				focusButton = false;
			}

			setTimeout( function(){
				kindUpdateScreenReaderAlert(kind.i18n.a11y.offCanvasIsClosed);
				if ( focusButton ) {
					setTimeout( function(){
						$('.kind-header__inner-desktop .kind-offcanvas-toggle').focus();
					},500);
				}
			},400);
		}

	};

	kind.openSearch= function( e ){
		$('.kind-search').fadeIn().find('.kind-search__input').focus();
		$('body').addClass('kind-search-open');
	};

	kind.closeSearch= function( e ){
		if ( $('body').hasClass('kind-search-open') ) {
			$('.kind-search')
				.fadeOut()
				.removeAttr('aria-modal')
				.attr('aria-hidden', 'true' );
			$('.kind-search-toggle').focus();
			$('body').removeClass('kind-search-open');
		}
	};

	/**
	 * Accesibility Alert
	 */
	function kindUpdateScreenReaderAlert( message ){
		$('.kind-screen-reader-alert').html( ' ' ).html( message );
	}

	/**
	 * Search Open
	 */
	$('.kind-search-toggle').on('click', function(e){
		e.preventDefault();
		kind.openSearch(e);
	});

	/**
	 * Search Close
	 */
	$('.kind-search-close').on('click', function(e){
		e.preventDefault();
		kind.closeSearch(e);
	});

	/** Off-Canvas **/
	$('.kind-offcanvas-toggle').on( 'click', function(e) {
		e.preventDefault();
		kind.openOffcanvas(e);
	});

	$('.kind-offcanvas-close, .nav-overlay').on( 'click', function(e) {
		e.preventDefault();
		kind.closeOffcanvas(e);
	});

	/** Close offcanvas and search on keydown ESC */
	$( document ).on( 'keydown', function(e) {
		if ( 27 === e.keyCode ) {
			kind.closeOffcanvas(e);
			kind.closeSearch(e);
		}
	});

	/** Submenu toggle  **/
	$( '.kind-mobile-submenu-toggle' ).on( 'click', function( e ) {
		e.preventDefault();

		var thisParent = $(this).parent('.menu-item-has-children');

		if ( thisParent.hasClass('open') ) {
			$(this).attr('aria-expanded', 'false').attr('aria-label', kind.i18n.a11y.expand);
			$(this).next('.sub-menu' ).slideUp( 300, function(){
				thisParent.removeClass('open');
			});
		} else {
			$(this).attr('aria-expanded', 'true').attr('aria-label', kind.i18n.a11y.collapse);
			thisParent.addClass('open');
			$(this).next('.sub-menu' ).slideDown( 300 );
		}

	});

	// Dropdown menu Accesibility.
	$('.kind-submenu-toggle').on('click', function(e){
		e.preventDefault();
		$(this).parent('.menu-item-has-children').toggleClass('focus');
		if ( $(this).parent('.menu-item-has-children').hasClass('focus') ) {
			$(this).attr('aria-expanded', 'true').attr('aria-label', kind.i18n.a11y.collapse);
		} else {
			$(this).attr('aria-expanded', 'false').attr('aria-label', kind.i18n.a11y.expand);
		}
	});

	// Close dropdown menu on focusout.
	$('.menu-item-has-children').on('focusout', function (e) {
		var $elem = $(this);
		setTimeout( function() {
			var hasFocus = !! ($elem.find(':focus').length > 0);
			if (! hasFocus) {
				$elem.removeClass('focus')
				$elem.find('.kind-submenu-toggle').attr('aria-expanded', 'false').attr('aria-label', kind.i18n.a11y.expand);
			}
		}, 10);
	});

	/**
	 * Keeping sub menu inside screen
	 */
	$(window).on('load resize', function(){
		var subMenus = $('.kind-header-nav .menu-item-has-children > .sub-menu');
		subMenus.each(function( index ) {
			var subMenuLeft = $(this).offset().left;
			if ( subMenuLeft + $(this).outerWidth() > $(window).width()) {
				$(this).addClass('sub-menu-left');
			}
		});
	});

	/** Responsive media **/
	function kindResponsiveEmbeds() {
		var proportion, parentWidth;

		// Loop iframe elements.
		document.querySelectorAll( 'iframe' ).forEach( function( iframe ) {
			// Only continue if the iframe has a width & height defined.
			if ( iframe.width && iframe.height ) {
				// Calculate the proportion/ratio based on the width & height.
				proportion = parseFloat( iframe.width ) / parseFloat( iframe.height );
				// Get the parent element's width.
				parentWidth = parseFloat( window.getComputedStyle( iframe.parentElement, null ).width.replace( 'px', '' ) );
				// Set the max-width & height.
				iframe.style.maxWidth = '100%';
				iframe.style.maxHeight = Math.round( parentWidth / proportion ).toString() + 'px';
			}
		} );
	}

	// Run on initial load.
	kindResponsiveEmbeds();

	// Run on resize.
	window.onresize = kindResponsiveEmbeds;

	/**
	 * Scroll To Element on click link with hash
	 */
	// a[href^="#"]
	$( '.kind-nav-menu a, .main-menu a, .kind-toc a' ).on( 'click', function( e ) {

		var lacationUrl = window.location.href.replace(/#.*$/, '');
		var thisUrl     = this.href.replace(/#.*$/, '');

		var offset = 0;
		if ( $('#wpadminbar').length ) {
			var adminbarHeight = $('#wpadminbar').height();
			offset = adminbarHeight;
		}

		if ( this.hash && lacationUrl === thisUrl ) {

			var target = $( this.hash ).offset();
			if ( target) {

				$( 'body, html' ).animate( {
					scrollTop: target.top - offset
				}, 400 );

				if ( $(this).parents('.main-menu') ) {
					window.kind.closeOffcanvas(e);
				}

			}

			$( this ).blur();
			e.preventDefault();
		}

	});

	/**
	 * Scroll To Element on window load
	 */
	$(window).on('load', function(){
		if ( window.location.hash ) {
			var target = $( window.location.hash ).offset();
			if ( target) {

				var offset = 0;
				if ( $('#wpadminbar').length ) {
					var adminbarHeight = $('#wpadminbar').height();
					offset = adminbarHeight;
				}

				$( 'body, html' ).animate( {
					scrollTop: target.top - offset
				}, 400 );
			}
		}
	});

	/**
	 * Scroll To Top Button
	 */
	$( document ).ready( function() {

		var btnToTop = $( '.kind-to-top' );

		$( window ).scroll( function() {
			var offset = $( 'body' ).innerHeight() * 0.1;

			if ( $( this ).scrollTop() > offset ) {
				btnToTop.addClass( 'active' );
			} else {
				btnToTop.removeClass( 'active' );
			}
		} );

		btnToTop.on( 'click', function() {

			$( this ).blur();

			$( 'body, html' ).animate( {
				scrollTop: 0
			}, 400 );

			return false;
		} );
	} );

	// Focus repeat in container.
	function kindFocusInModal( selector ){

		// add all the elements inside modal which you want to make focusable
		const focusableElements = 'button, [href]:not([aria-hidden="true"]), input, [tabindex]:not([tabindex="-1"])';

		const modal = document.querySelector( selector ); // select the modal by it's id

		if ( ! modal ) {
			return;
		}

		const firstFocusableElement = modal.querySelectorAll(focusableElements)[0]; // get first element to be focused inside modal
		const focusableContent = modal.querySelectorAll(focusableElements);
		const lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal

		document.addEventListener('keydown', function(e) {
			let isTabPressed = e.key === 'Tab' || e.keyCode === 9;

			if (!isTabPressed) {
				return;
			}

			if (e.shiftKey) { // if shift key pressed for shift + tab combination
				if (document.activeElement === firstFocusableElement) {
					lastFocusableElement.focus(); // add focus for the last focusable element
					e.preventDefault();
				}
			} else { // if tab key is pressed
				if (document.activeElement === lastFocusableElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
					firstFocusableElement.focus(); // add focus for the first focusable element
					e.preventDefault();
				}
			}
		});

		firstFocusableElement.focus();
	}

	kindFocusInModal( '.site-nav' );
	kindFocusInModal( '.kind-search' );

	kind.getScrollBarWidth();


})( jQuery );
