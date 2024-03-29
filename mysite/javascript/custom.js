// If JavaScript is enabled remove 'no-js' class and give 'js' class
jQuery('html').removeClass('no-js').addClass('js');

// When DOM is fully loaded
jQuery(document).ready(function($) {

	/* ---------------------------------------------------------------------- */
	/*	Custom Functions
	/* ---------------------------------------------------------------------- */
	
	$('#shareMessage').hide();
	$('#fbShareButton').on('mouseenter',function(){
		$('#shareMessage').slideDown();
	});
	$('#appointmentNotice').hide();
	$('#bookViewing').one('click', function(){
		$('#appointmentNotice').slideDown('slow');
		return false;
	});
	// Fixed scrollHorz effect
	$.fn.cycle.transitions.fixedScrollHorz = function($cont, $slides, opts) {

		$('.image-gallery-slider-nav a').on('click', function(e) {
			$cont.data('dir', '')
			if( e.target.className.indexOf('prev') > -1 ) $cont.data('dir', 'prev');
		});
		
		$cont.css('overflow', 'hidden');
		opts.before.push($.fn.cycle.commonReset);
		var w = $cont.width();
		opts.cssFirst.left = 0;
		opts.cssBefore.left = w;
		opts.cssBefore.top = 0;
		opts.animIn.left = 0;
		opts.animOut.left = 0-w;

		if( $cont.data('dir') === 'prev' ) {
			opts.cssBefore.left = -w;
			opts.animOut.left = w;
		}

	};

	// Slide effects for #portfolio-items-filter
	$.fn.slideHorzShow = function( speed, easing, callback ) { this.animate( { marginLeft : 'show', marginRight : 'show', paddingLeft : 'show', paddingRight : 'show', width : 'show' }, speed, easing, callback ); };
	$.fn.slideHorzHide = function( speed, easing, callback ) { this.animate( { marginLeft : 'hide', marginRight : 'hide', paddingLeft : 'hide', paddingRight : 'hide', width : 'hide' }, speed, easing, callback ); };

	// Test whether argument elements are parents of the first matched element
	$.fn.hasParent = function(objs) {
		objs = $(objs);
		var found = false;
		$(this[0]).parents().andSelf().each(function() {
			if ($.inArray(this, objs) != -1) {
				found = true;
				return false;
			}
		});
		return found;
	};

	/* end Custom Functions */

	/* ---------------------------------------------------------------------- */
	/*	Detect Touch Device
	/* ---------------------------------------------------------------------- */

	(function() {

		if( Modernizr.touch ) {

			$('body').addClass('touch-device');

		}

	})();

	/* end Detect Touch Device */

	/* ---------------------------------------------------------------------- */
	/*	Main Navigation
	/* ---------------------------------------------------------------------- */
	
	(function() {

		var $mainNav    = $('#main-nav').children('ul'),
			optionsList = '<option value="" selected>Navigate...</option>';
		
		// Regular nav
		$mainNav.on('mouseenter', 'li', function() {
			var $this    = $(this),
				$subMenu = $this.children('ul');
			if( $subMenu.length ) $this.addClass('hover');
			$subMenu.hide().stop(true, true).fadeIn(200);
		}).on('mouseleave', 'li', function() {
			$(this).removeClass('hover').children('ul').stop(true, true).fadeOut(50);
		});

		// Responsive nav
		$mainNav.find('li').each(function() {
			var $this   = $(this),
				$anchor = $this.children('a'),
				depth   = $this.parents('ul').length - 1,
				indent  = '';

			if( depth ) {
				while( depth > 0 ) {
					indent += '--';
					depth--;
				}
			}

			optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
		}).end()
		  .after('<select class="responsive-nav">' + optionsList + '</select>');

		$('.responsive-nav').on('change', function() {
			window.location = $(this).val();
		});
		
	})();

	/* end Main Navigation */

	/* ---------------------------------------------------------------------- */
	/*	Min-height
	/* ---------------------------------------------------------------------- */

	(function() {

		// Set minimum height so footer will stay at the bottom of the window, even if there isn't enough content
		$('#content').css( 'min-height', $(window).outerHeight(true) - parseInt( $('body').css('border-top-width') ) - $('#header').outerHeight(true) - $('#footer').outerHeight(true) - $('#footer-bottom').outerHeight(true) + 11 );

	})();

	/* end Min-height */

	/* ---------------------------------------------------------------------- */
	/*	Fancybox
	/* ---------------------------------------------------------------------- */

	(function() {

		// Images
		$('.single-image, .image-gallery').fancybox({
			'transitionIn'  : 'fade',
			'transitionOut' : 'fade',
			'titlePosition' : 'over'
		}).each(function() {
			$(this).append('<span class="zoom">&nbsp;</span>');
		});

		// Iframe
		$('.iframe').fancybox({
			'autoScale'     : false,
			'transitionIn'  : 'fade',
			'transitionOut' : 'fade',
			'type'          : 'iframe',
			'titleShow'     : false
		}).each(function() {
			$(this).append('<span class="zoom">&nbsp;</span>');
		});

	})();

	/* end Fancybox */

	/* ---------------------------------------------------------------------- */
	/*	Features Slider
	/* ---------------------------------------------------------------------- */

	(function() {

		var $slider = $('#features-slider');

		if( $slider.length ) {

			$('#features-slider').smartStartSlider({
				pos             : 0,
				hideContent     : true,
				timeout         : 3000,
				pause           : false,
				pauseOnHover    : true,
				type            : {
					mode        : 'random',
					speed       : 400,
					easing      : 'easeInOutExpo',
					seqfactor   : 100
				}
			});

			// Detect swipe gestures support
			if( Modernizr.touch ) {

				function swipeFunc( e, dir ) {
				
					var $slider = $(e.currentTarget);
					
					if( dir === 'left' ) {
						$slider.find('.pagination-container .next').trigger('click');
					}
					
					if( dir === 'right' ) {
						$slider.find('.pagination-container .prev').trigger('click');
					}
					
				}
				
				$slider.swipe({
					swipeLeft       : swipeFunc,
					swipeRight      : swipeFunc,
					allowPageScroll : 'auto'
				});
				
			}

		}
		
	})();

	/* end Features Slider */

	/* ---------------------------------------------------------------------- */
	/*	Logos Slider
	/* ---------------------------------------------------------------------- */

	(function() {

		var $slider = $('#logos-slider');

		if( $slider.length ) {

			$('#logos-slider').smartStartSlider({
				pos             : 0, 
				hideContent     : true,
				contentPosition : 'center',
				timeout         : 3000,
				pause           : false,
				pauseOnHover    : true,
				type            : {
					mode        : 'random',
					speed       : 400,
					easing      : 'easeInOutExpo',
					seqfactor   : 100
				}
			});

			// Detect swipe gestures support
			if( Modernizr.touch ) {
				
				function swipeFunc( e, dir ) {
				
					var $slider = $(e.currentTarget);
					
					if( dir === 'left' ) {
						$slider.find('.pagination-container .next').trigger('click');
					}
					
					if( dir === 'right' ) {
						$slider.find('.pagination-container .prev').trigger('click');
					}
					
				}
				
				$slider.swipe({
					swipeLeft       : swipeFunc,
					swipeRight      : swipeFunc,
					allowPageScroll : 'auto'
				});
				
			}

		}
		
	})();

	/* end Logos Slider */

	/* ---------------------------------------------------------------------- */
	/*	Photos Slider
	/* ---------------------------------------------------------------------- */

	(function() {

		var $slider = $('#photos-slider');

		if( $slider.length ) {

			$('#photos-slider').smartStartSlider({
				pos             : 0,
				hideContent     : true,
				contentPosition : 'bottom',
				timeout         : 3000,
				pause           : false,
				pauseOnHover    : true,
				type            : {
					mode        : 'random',
					speed       : 400,
					easing      : 'easeInOutExpo',
					seqfactor   : 100
				}
			});

			// Detect swipe gestures support
			if( Modernizr.touch ) {
				
				function swipeFunc( e, dir ) {
				
					var $slider = $(e.currentTarget);
					
					if( dir === 'left' ) {
						$slider.find('.pagination-container .next').trigger('click');
					}
					
					if( dir === 'right' ) {
						$slider.find('.pagination-container .prev').trigger('click');
					}
					
				}
				
				$slider.swipe({
					swipeLeft       : swipeFunc,
					swipeRight      : swipeFunc,
					allowPageScroll : 'auto'
				});
				
			}

		}
		
	})();

	/* end Photos Slider */

	/* ---------------------------------------------------------------------- */
	/*	Projects Carousel & Post Carousel
	/* ---------------------------------------------------------------------- */

	(function() {

		var $carousel = $('.projects-carousel, .post-carousel');

		if( $carousel.length ) {

			var scrollCount;

			if( $(window).width() < 480 ) {
				scrollCount = 1;
			} else if( $(window).width() < 768 ) {
				scrollCount = 2;
			} else if( $(window).width() < 960 ) {
				scrollCount = 3;
			} else {
				scrollCount = 4;
			}

			$carousel.jcarousel({
				animation : 600,
				easing    : 'easeOutCubic',
				scroll    : scrollCount
			});

			// Detect swipe gestures support
			if( Modernizr.touch ) {
				
				function swipeFunc( e, dir ) {
				
					var $carousel = $(e.currentTarget);
					
					if( dir === 'left' ) {
						$carousel.parent('.jcarousel-clip').siblings('.jcarousel-next').trigger('click');
					}
					
					if( dir === 'right' ) {
						$carousel.parent('.jcarousel-clip').siblings('.jcarousel-prev').trigger('click');
					}
					
				}
			
				$carousel.swipe({
					swipeLeft       : swipeFunc,
					swipeRight      : swipeFunc,
					allowPageScroll : 'auto'
				});
				
			}

		}

	})();

	/* end Projects Carousel & Post Carousel */

	/* ---------------------------------------------------------------------- */
	/*	Image Gallery Slider
	/* ---------------------------------------------------------------------- */

	(function() {

		var $slider = $('.image-gallery-slider ul');

		if( $slider.length ) {

			// Run slider when all images are fully loaded
			$(window).load(function() {
				
				$slider.each(function(i) {
					var $this = $(this);

					$this.css('height', $this.find('li:first img').height() )
						 .after('<div class="image-gallery-slider-nav"> <a class="prev image-gallery-slider-nav-prev-' + i + '">Prev</a> <a class="next image-gallery-slider-nav-next-' + i + '">Next</a> </div>')
						 .cycle({
							 before: function(curr, next, opts) {
								 var $this = $(this);
								 // set the container's height to that of the current slide
								 $this.parent().stop().animate({ height: $this.height() }, opts.speed);
								 // remove temporary styles, if they exist
								 $('.ss-temp-slider-styles').remove();
							 },
							 containerResize : false,
							 easing          : 'easeInOutExpo',
							 fx              : 'fixedScrollHorz',
							 fit             : true,
							 next            : '.image-gallery-slider-nav-next-' + i,
							 pause           : true,
							 prev            : '.image-gallery-slider-nav-prev-' + i,
							 slideExpr       : 'li',
							 slideResize     : true,
							 speed           : 600,
							 timeout         : 0,
							 width           : '100%'
						 });
					
				});
			
				// Position nav
				var $arrowNav = $('.image-gallery-slider-nav a');
				$arrowNav.css('margin-top', - $arrowNav.height() / 2 );

				// Pause on nav hover
				$('.image-gallery-slider-nav a').on('mouseenter', function() {
					$(this).parent().prev().cycle('pause');
				}).on('mouseleave', function() {
					$(this).parent().prev().cycle('resume');
				})
				
			});

			// Resize
			$(window).on('resize', function() {
				$slider.css('height', $slider.find('li:visible img').height() );
			});

			// Detect swipe gestures support
			if( Modernizr.touch ) {
				
				function swipeFunc( e, dir ) {
				
					var $slider = $(e.currentTarget);
				
					$slider.data('dir', '')
					
					if( dir === 'left' ) {
						$slider.cycle('next');
					}
					
					if( dir === 'right' ) {
						$slider.data('dir', 'prev')
						$slider.cycle('prev');
					}
					
				}
				
				$slider.swipe({
					swipeLeft       : swipeFunc,
					swipeRight      : swipeFunc,
					allowPageScroll : 'auto'
				});
				
			}

		}

	})();

	/* end Image Gallery Slider */

	/* ---------------------------------------------------------------------- */
	/*	Portfolio Filter
	/* ---------------------------------------------------------------------- */

	(function() {

		var $container = $('#portfolio-items');

		if( $container.length ) {

			var $itemsFilter = $('#portfolio-items-filter'),
				mouseOver;

			// Copy categories to item classes
			$('article', $container).each(function(i) {
				var $this = $(this);
				$this.addClass( $this.attr('data-categories') );
			});

			// Run Isotope when all images are fully loaded
			$(window).on('load', function() {

				$container.isotope({
					itemSelector : 'article',
					layoutMode   : 'fitRows'
				});

			});

			// Filter projects
			$itemsFilter.on('click', 'a', function(e) {
				var $this         = $(this),
					currentOption = $this.attr('data-categories');

				$itemsFilter.find('a').removeClass('active');
				$this.addClass('active');

				if( currentOption ) {
					if( currentOption !== '*' ) currentOption = currentOption.replace(currentOption, '.' + currentOption)
					$container.isotope({ filter : currentOption });
				}

				e.preventDefault();
			});

			$itemsFilter.find('a').first().addClass('active');
			$itemsFilter.find('a').not('.active').hide();

			$itemsFilter.on('mouseenter', function() {
				var $this = $(this);

				clearTimeout( mouseOver );

				// Wait 100ms before animating to prevent unnecessary flickering
				mouseOver = setTimeout( function() {
					$this.find('li a').stop(true,true).slideHorzShow(300);
				}, 100);
			}).on('mouseleave', function() {
				clearTimeout( mouseOver );

				$(this).find('li a').not('.active').stop(true,true).slideHorzHide(150);
			});

		}

	})();

	/* end Portfolio Filter */

	/* ---------------------------------------------------------------------- */
	/*	MediaElement
	/* ---------------------------------------------------------------------- */

	(function() {

		var $player = $('video, audio');

		if( $player.length ) {

			$player.mediaelementplayer({
				audioWidth  : '100%',
				audioHeight : '30px',
				videoWidth  : '100%',
				videoHeight : '100%'
			});

			// Fix for player, if in Image Gallery Slider
			$('.mejs-fullscreen-button').on('click', 'button', function() {
			
				if( $(this).hasParent('.image-gallery-slider ul') ) {

					// Minimize
					if( $(this).parent().hasClass('mejs-unfullscreen') ) {

						$(this).parents('.image-gallery-slider ul').css({
							'height'   : $(this).parents('.image-gallery-slider ul').height(),
							'overflow' : 'hidden',
							'z-index'  : ''
						});

					// Enlarge
					} else {

						// Add temporary styling so cycle slider won't screw up the height totally
						$('head').append('<style class="ss-temp-slider-styles"> .image-gallery-slider ul { height: ' + $(this).parents('.image-gallery-slider ul').css('height') + ' !important; } </style>')

						$(this).parents('.image-gallery-slider ul').css({
							'overflow' : 'visible',
							'z-index'  : '999'
						});

					}
				}

			});

			// Same thing but with an ESC key
			$(document).keyup(function(e) {

				// Minimize
				if (e.keyCode == 27) {

					$('.mejs-fullscreen-button').parents('.image-gallery-slider ul').css({
						'height'   : $('.mejs-fullscreen-button').parents('.image-gallery-slider ul').height(),
						'overflow' : 'hidden',
						'z-index'  : ''
					});

				}

			});

		}

	})();

	/* end MediaElement */

	/* ---------------------------------------------------------------------- */
	/*	FitVids
	/* ---------------------------------------------------------------------- */

	(function() {

		$('.container').each(function(){
			var selectors  = [
				"iframe[src^='http://player.vimeo.com']",
				"iframe[src^='http://www.youtube.com']",
				"iframe[src^='http://blip.tv']",
				"object",
				"embed"
			],
				$allVideos = $(this).find(selectors.join(','));

			$allVideos.each(function(){
				var $this = $(this);
				if (this.tagName.toLowerCase() == 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; } 
				var height = this.tagName.toLowerCase() == 'object' ? $this.attr('height') : $this.height(),
				aspectRatio = height / $this.width();
				if(!$this.attr('id')){
					var videoID = 'fitvid' + Math.floor(Math.random()*999999);
					$this.attr('id', videoID);
				}
				$this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
				$this.removeAttr('height').removeAttr('width');
			});
		});

	})();

	/* end FitVids */

	/* ---------------------------------------------------------------------- */
	/*	Google Maps
	/* ---------------------------------------------------------------------- */

	

	/* end Google Maps */

	/* ---------------------------------------------------------------------- */
	/*	Accordion Content
	/* ---------------------------------------------------------------------- */

	(function() {

		var $container = $('.acc-container'),
			$trigger   = $('.acc-trigger');

		$container.hide();
		$trigger.first().addClass('active').next().show();

		var fullWidth = $container.outerWidth(true);
		$trigger.css('width', fullWidth);
		$container.css('width', fullWidth);
		
		$trigger.on('click', function(e) {
			if( $(this).next().is(':hidden') ) {
				$trigger.removeClass('active').next().slideUp(300);
				$(this).toggleClass('active').next().slideDown(300);
			}
			e.preventDefault();
		});

		// Resize
		$(window).on('resize', function() {
			fullWidth = $container.outerWidth(true)
			$trigger.css('width', $trigger.parent().width() );
			$container.css('width', $container.parent().width() );
		});

	})();

	/* end Accordion Content */
	
	/* ---------------------------------------------------- */
	/*	Content Tabs
	/* ---------------------------------------------------- */

	(function() {

		var $tabsNav    = $('.tabs-nav'),
			$tabsNavLis = $tabsNav.children('li'),
			$tabContent = $('.tab-content');

		$tabContent.hide();
		$tabsNavLis.first().addClass('active').show();
		$tabContent.first().show();

		$tabsNavLis.on('click', function(e) {
			var $this = $(this);

			$tabsNavLis.removeClass('active');
			$this.addClass('active');
			$tabContent.hide();
			
			$( $this.find('a').attr('href') ).fadeIn();

			e.preventDefault();
		});

	})();

	/* end Content Tabs */

	/* ---------------------------------------------------------------------- */
	/*	PHP Widgets
	/* ---------------------------------------------------------------------- */

	(function() {

		function fetchFeed( url, element ) {

			element.html('<img src="img/loader.gif" height="11" width="16" alt="Loading..." />');

			$.ajax({
				url: url,
				dataType: 'html',
				timeout: 10000,
				type: 'GET',
				error:
					function(xhr, status, error) {
						element.html( 'An error occured: ' + error );
					},
				success:
					function(data, status, xhr) {
						element.html( data );
					}
			});
			
		}

		// Latest Tweets
		var $tweetsContainer = $('.tweets-feed');
		if( $tweetsContainer.length ) fetchFeed( 'php/tweets.php', $tweetsContainer );

		// Latest Flickr Images
		var $flickrContainer = $('.flickr-feed');
		if( $flickrContainer.length ) fetchFeed( 'php/flickr.php', $flickrContainer );

	})();
		
	/* end PHP Widgets */

	/* ---------------------------------------------------------------------- */
	/*	Contact Form
	/* ---------------------------------------------------------------------- */

	(function() {

		// Setup any needed variables.
		var $form   = $('.contact-form'),
			$loader = '<img src="img/loader.gif" height="11" width="16" alt="Loading..." />';

		$form.append('<div id="response" class="hidden">');
		var $response = $('#response');
		
		// Do what we need to when form is submitted.
		$form.on('click', 'input[type=submit]', function(e){

			// Hide any previous response text and show loader
			$response.hide().html( $loader ).show();
			
			// Make AJAX request 
			$.post('php/contact-send.php', $form.serialize(), function( data ) {
				// Show response message
				$response.html( data );

				// Scroll to bottom of the form to show respond message
				var bottomPosition = $form.offset().top + $form.outerHeight() - $(window).height();
				if( $(document).scrollTop() < bottomPosition ) $('html, body').animate({ scrollTop : bottomPosition });
			});
			
			// Cancel default action
			e.preventDefault();
		});

	})();

	/* end Contact Form */
	
	/* ---------------------------------------------------- */
	/*	UItoTop (Back to Top)
	/* ---------------------------------------------------- */

	(function() {

		var settings = {
				button      : '#back-to-top',
				text        : 'Back to Top',
				min         : 200,
				fadeIn      : 400,
				fadeOut     : 400,
				scrollSpeed : 800,
				easingType  : 'easeInOutExpo'
			},
			oldiOS     = false,
			oldAndroid = false;

		// Detect if older iOS device, which doesn't support fixed position
		if( /(iPhone|iPod|iPad)\sOS\s[0-4][_\d]+/i.test(navigator.userAgent) )
			oldiOS = true;

		// Detect if older Android device, which doesn't support fixed position
		if( /Android\s+([0-2][\.\d]+)/i.test(navigator.userAgent) )
			oldAndroid = true;
	
		$('body').append('<a href="#" id="' + settings.button.substring(1) + '" title="' + settings.text + '">' + settings.text + '</a>');

		$( settings.button ).click(function( e ){
				$('html, body').animate({ scrollTop : 0 }, settings.scrollSpeed, settings.easingType );

				e.preventDefault();
			});

		$(window).scroll(function() {
			var position = $(window).scrollTop();

			if( oldiOS || oldAndroid ) {
				$( settings.button ).css({
					'position' : 'absolute',
					'top'      : position + $(window).height()
				});
			}

			if ( position > settings.min ) 
				$( settings.button ).fadeIn( settings.fadeIn );
			else 
				$( settings.button ).fadeOut( settings.fadeOut );
		});

	})();

	/* end UItoTop (Back to Top) */

});
