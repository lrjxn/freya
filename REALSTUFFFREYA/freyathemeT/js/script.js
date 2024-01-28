(function ($, root, undefined) {
	$(function () {
		'use strict';

		var $document = $(document);
		var $window = $(window);
		var $body = $('body');
		var $header = $('header');
		var date = new Date();

		$document.ready(function() {
			fade();
			handleScroll();
            handleCookies();

            var hash = window.location.hash;
            if(hash == '#contact') {
                scrollToElem('footer');
            }

            if(hash == '#reservation') {
                $('#reservation').fadeIn(150);
                $body.addClass('scrolling_disabled');
            }

            if(hash.indexOf('scroll') != -1) {
                var hashparts = hash.replace('#', '');
                hashparts = hashparts.split('&');
                for(var i = 0; i < hashparts.length; i++) {
                    if(hashparts[i].indexOf('scroll') != -1) {
                        var scrollTo = hashparts[i].split('=')[1];
                        scrollToElem('#' + scrollTo);
                    }
                }
            }

			$('[data-scroll]').on('click', function() {
                var scrollTo = $(this).data('scroll');
                scrollToElem('#' + scrollTo);
            });
            
			$('[href="#contact"]').on('click', function() {
                $('header .hamburger').removeClass('is-active');
                $header.removeClass('menu_open');
                $body.removeClass('scrolling_disabled');

                scrollToElem('footer');
            });
            
			$('[href="#reservation"]').on('click', function() {
                $('#reservation').fadeIn(150);
                $body.addClass('scrolling_disabled');
            });

            $('.close_reservation').on('click', function() {
                $('#reservation').fadeOut(150);
                $body.removeClass('scrolling_disabled');
            });

            $('.newsletter').on('click', function() {
                $('#newsletter').fadeIn(150);
                $body.addClass('scrolling_disabled');
            });

            $('.close_newsletter').on('click', function() {
                $('#newsletter').fadeOut(150);
                $body.removeClass('scrolling_disabled');
            });

            $(document).on('click',function(event){
                var $target = $(event.target);

                if(!$target.closest('.reservation_container').length && !$target.hasClass('reservation_link') && $('.reservation_container').is(":visible")) {
                    $('#reservation').fadeOut(150);
                    $body.removeClass('scrolling_disabled');
                }

                if(!$target.closest('.newsletter_container').length && !$target.hasClass('newsletter') && $('.newsletter_container').is(":visible")) {
                    $('#newsletter').fadeOut(150);
                    $body.removeClass('scrolling_disabled');
                }   
            });

			/* Mobile Menu Btn */
			$('header .hamburger').on('click', function() {
				if(!$(this).hasClass('is-active')) {
					$('header .hamburger').addClass('is-active');
					$header.addClass('menu_open');
					$body.addClass('scrolling_disabled');

                    if($window.width() <= 1199) {
                        $('#burger_menu').stop().fadeIn(150);
                    }
				} else {
					$('header .hamburger').removeClass('is-active');
					$header.removeClass('menu_open');
					$body.removeClass('scrolling_disabled');

                    if($window.width() <= 1199) {
                        $('#burger_menu').stop().fadeOut(150);
                    }
				}
			});

			/* IE */
			var isIE = checkIfIE();
			if(isIE == true) {
				$body.addClass('is_IE');
			} else {
                var vh = window.innerHeight * 0.01;
                document.documentElement.style.setProperty('--vh', vh + 'px');
            }

		
			$window.resize(function() {
				fade();
			});
		});

		$window.on('load', function() {
            handleScroll();
			fade();
		});

		$window.scroll(function() {
            handleScroll();
			fade();
		});

        function handleScroll() {
			var pos = $window.scrollTop();
            var footerTop = $('footer').offset().top;

            if($window.width() > 1199) {
                if(pos >= window.innerHeight - 81) {
                    $header.removeClass('scrolled');
                    $('#header_scroll').fadeIn(150);

                    /*if($('.menu_links_fixed').length > 0) {
                        $('.menu_links_fixed').fadeIn(150);
                    }*/

                    if(pos >= footerTop - 81) {
                        $('#header_scroll').addClass('darkBlue');
                    } else {
                        $('#header_scroll.darkBlue').removeClass('darkBlue');
                    }
                } else {
                    $header.removeClass('scrolled');
                    $('#header_scroll').fadeOut(150);
                    $('#header_scroll.darkBlue').removeClass('darkBlue');

                    if($('.menu_links_fixed').length > 0) {
                        $('.menu_links_fixed').fadeOut(150);
                    }
                }
            } else if($window.width() <= 1199 && $body.hasClass('home')) {
                if(pos < window.innerHeight - 63) {
                    $('#header_scroll').addClass('transparent_mob');
                } else{
                    $('#header_scroll').removeClass('transparent_mob');
                }
            }
		}

		function scrollToElem(elem) {
			var minusHeight = 24;
            var headerHeight = 81;

            if(elem == 'footer') {
                minusHeight = 0;
            }

            if($window.width() <= 1199) {
                headerHeight = 63;
            }

            minusHeight += headerHeight;
            
            /*if($window.width() > 1199 && $('.menu_links_fixed').length > 0 && $('.page_banner .menu_links_container').length > 0) {
                minusHeight += Math.floor($('.page_banner .menu_links_container').height());
            }*/

            if($window.width() <= 1199) {
                $('#burger_menu').stop().fadeOut(150);
            }

			$('html, body').stop().animate({
				scrollTop: Math.ceil($(elem).offset().top) - minusHeight
			}, 1000);
		}

        function handleCookies() {
			var cookiesConsent = window.localStorage.getItem('freya_cookies');
			if(cookiesConsent) {
				var consentParts = cookiesConsent.split('|');
				var cookiesExpires = consentParts['0'];
				var consentType = consentParts['1'];
				
				var timeoutDate = new Date(cookiesExpires);
				if(date >= timeoutDate) {
					window.localStorage.removeItem('freya_cookies');
					cookiesConsent = false;
				} else {
					if(consentType == 2) {
						getScripts();
					}
				}
			}
				
			if(!cookiesConsent) {
				$('#cookies').stop().fadeIn(300);
				$('#cookies').addClass('animated');
			}

			$('#cookies_save').on('click', function() {
				var consentType;
				var timeoutDate = new Date();
				timeoutDate.setDate(date.getDate() + 30);

				if($('#cookies input[name="analytics"]').is(':checked')) {
					consentType = 2;
				} else {
					consentType = 1;
				}

				window.localStorage.setItem('freya_cookies', timeoutDate+'|'+consentType);

				if(consentType === 2){
					getScripts();
				}

				$('#cookies').stop().fadeOut(300);
				$('#cookies').removeClass('animated');
			});
			
			$('#cookies_close').on('click', function() {
				$('#cookies').stop().fadeOut(300);
				$('#cookies').removeClass('animated');
			});
			
		}

		function getScripts() {
            var siteUrl = $('#siteurl').val();
            var lang = $('#sitelang').val();
			$.ajax({
				type: 'get',
				url: siteUrl+'/wp-admin/admin-ajax.php',
				data: {
					action: 'getAnalytics',
                    lang: lang
				},
				success: function(data) {
					$('body').append(data);
				},
				error: function (XMLHttpRequest, textStatus, errorThrown) {
					console.log("Status: " + textStatus);
					console.log("Error: " + errorThrown);
				}
			});
		}

		/** Fade in different blocks */
        function fade() {
			if($('.fade-in-up').length > 0) {
				var animation_height = $window.innerHeight() * 0.10;

				$('.fade-in-up').each(function() {
					var $this = $(this);
					var objectTop = $this.offset().top;
					var windowBottom = $window.scrollTop() + $window.innerHeight();

					if(objectTop < windowBottom) {
						if(objectTop < windowBottom - animation_height) {
							if(!$this.hasClass('animated')){
								$this.addClass('animated');
							}
						}
					}
				});
			}
		}

		function checkIfIE() {
			var ua = window.navigator.userAgent;
			var msie = ua.indexOf("MSIE ");
		
			if(msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
				return true;
			} else {
				return false;
			}
		}
	});
})(jQuery, this);
