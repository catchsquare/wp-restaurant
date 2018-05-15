+(function ($) {

	/* NEW FILE */
	function resYoutube(args) {

		this.player = "undefined";
		this.type = ("undefined" == typeof args.elementType) ? '#' : args.elementType;
		this.ele = args.element;
		this.element = this.type + this.ele;

		this.init = function () {
			var self = this;
			if ("undefined" == typeof (YT) || "undefined" == typeof (YT.Player)) {
				self.youtubeAPI();
			}

			var elementExists = document.getElementById(this.ele);

			if ('.' == this.type) {
				elementExists = document.getElementsByClassName(this.ele);
			}
			if (elementExists) {
				setTimeout(function () {
					self.onYouTubeIframeAPIReady();
				}, 800);
			}
		};

		this.youtubeAPI = function () {

			var tag = document.createElement('script');
			tag.src = "https://www.youtube.com/iframe_api";
			// tag.async = '';
			tag.type = 'text/javascript';

			var firstScriptTag = document.getElementsByTagName('script')[0];

			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
		};

		this.onYouTubeIframeAPIReady = function () {
			var self = this;

			self.player = new YT.Player(self.ele, {
				events: {
					onReady: self.onYoutubeReady
				}
			});
		};

		this.onYoutubeReady = function (event) {
			event.target.mute();
		};

	}

	/* NEW FILE */
	jQuery(document).ready(function ($) {

		var player = new resYoutube({
			elementType: '#',
			element: 'restaurant-video'
		}).init();

		jQuery(".steak-house-navigation li").append("<span></span>");

		jQuery('.cs-col').click(function () {
			jQuery(this).toggleClass('cs-open');
		});

		if (jQuery('body').hasClass('page-template-menu-page')) {
			jQuery('header.menu-group-header').each(function () {
				jQuery(this).css('background-image', 'url(' + WP_RESTAURANT.menu_heading_image + ')');
			});
		}

		window.addEventListener('scroll', function (e) {
			var scroll = jQuery(window).scrollTop();

			if (scroll >= 150) {

				jQuery(".steak-house-container").addClass("no-header");
			} else {
				jQuery(".steak-house-container").removeClass("no-header");
			}

			if (scroll >= 150) {

				jQuery(".steak-house-top-nav").addClass("steak-house-top-nav-menu");
			} else {
				jQuery(".steak-house-top-nav").removeClass("steak-house-top-nav-menu");
			}
		});

	});

	/* NEW FILE */
	/**
	 * File navigation.js.
	 *
	 * Handles toggling the navigation menu for small screens and enables TAB key
	 * navigation support for dropdown menus.
	 */
	(function ($) {
		var container, button, menu, links, i, len;

		container = document.getElementById('site-navigation');
		if (!container) {
			return;
		}

		button = container.getElementsByTagName('button')[0];
		if ('undefined' === typeof button) {
			return;
		}

		menu = container.getElementsByTagName('ul')[0];

		// Hide menu toggle button if menu is empty and return early.
		if ('undefined' === typeof menu) {
			button.style.display = 'none';
			return;
		}

		menu.setAttribute('aria-expanded', 'false');
		if (-1 === menu.className.indexOf('nav-menu')) {
			menu.className += ' nav-menu';
		}

		button.onclick = function () {
			if (-1 !== container.className.indexOf('toggled')) {
				container.className = container.className.replace(' toggled', '');
				button.setAttribute('aria-expanded', 'false');
				menu.setAttribute('aria-expanded', 'false');
			} else {
				container.className += ' toggled';
				button.setAttribute('aria-expanded', 'true');
				menu.setAttribute('aria-expanded', 'true');
			}
		};

		// Get all the link elements within the menu.
		links = menu.getElementsByTagName('a');

		// Each time a menu link is focused or blurred, toggle focus.
		for (i = 0, len = links.length; i < len; i++) {
			links[i].addEventListener('focus', toggleFocus, true);
			links[i].addEventListener('blur', toggleFocus, true);
		}

		/**
		 * Sets or removes .focus class on an element.
		 */
		function toggleFocus() {
			var self = this;

			// Move up through the ancestors of the current link until we hit .nav-menu.
			while (-1 === self.className.indexOf('nav-menu')) {

				// On li elements toggle the class .focus.
				if ('li' === self.tagName.toLowerCase()) {
					if (-1 !== self.className.indexOf('focus')) {
						self.className = self.className.replace(' focus', '');
					} else {
						self.className += ' focus';
					}
				}

				self = self.parentElement;
			}
		}

		/**
		 * Toggles `focus` class to allow submenu access on tablets.
		 */
		(function (container) {
			var touchStartFn, i,
				parentLink = container.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

			if ('ontouchstart' in window) {
				touchStartFn = function (e) {
					var menuItem = this.parentNode, i;

					if (!menuItem.classList.contains('focus')) {
						e.preventDefault();
						for (i = 0; i < menuItem.parentNode.children.length; ++i) {
							if (menuItem === menuItem.parentNode.children[i]) {
								continue;
							}
							menuItem.parentNode.children[i].classList.remove('focus');
						}
						menuItem.classList.add('focus');
					} else {
						menuItem.classList.remove('focus');
					}
				};

				for (i = 0; i < parentLink.length; ++i) {
					parentLink[i].addEventListener('touchstart', touchStartFn, false);
				}
			}
		}(container));
	})(jQuery);


	/* NEW FILE */
	/**
	 * File skip-link-focus-fix.js.
	 *
	 * Helps with accessibility for keyboard only users.
	 *
	 * Learn more: https://git.io/vWdr2
	 */
	(function ($) {
		var isIe = /(trident|msie)/i.test(navigator.userAgent);

		if (isIe && document.getElementById && window.addEventListener) {
			window.addEventListener('hashchange', function () {
				var id = location.hash.substring(1),
					element;

				if (!(/^[A-z0-9_-]+$/.test(id))) {
					return;
				}

				element = document.getElementById(id);

				if (element) {
					if (!(/^(?:a|select|input|button|textarea)$/i.test(element.tagName))) {
						element.tabIndex = -1;
					}

					element.focus();
				}
			}, false);
		}
	})(jQuery);


	/* NEW FILE */
})(jQuery);