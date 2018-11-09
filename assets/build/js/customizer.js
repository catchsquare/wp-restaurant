/**
 * Live-update changed settings in real time in the Customizer preview.
 */

( function( $ ) {	
	var api	 = wp.customize;
	var no_contact_text = '<div class="full-width">\
				<div class="steak-house-home-contact" >\
					<p class="steak-house-no-contact">' + resCustomizer.no_contact + '</p>\
				</div >\
			</div >';
	// Site title.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.logo' ).text( to );
		} );
	} );

	// Site tagline.
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Add custom-background-image body class when background image is added.
	api( 'background_image', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).toggleClass( 'custom-background-image', '' !== to );
		} );
	} );
	
	// Add custom background color
	api( 'background_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'background-color', to );
		} );
	} );

	// welcome
	api( 'welcome_text', function( value ) {
		value.bind( function( to ) {
			$('.steak-house-text-on-image').html(to);			
		} );
	} );

	// show title
	api( 'show-title', function( value ) {
		value.bind( function( to ) {
			if (1 == to) {
				$('.steak-house-text-on-image').show();
				$('.logo').show();
			} else {
				$('.steak-house-text-on-image').hide();				
				$('.logo').hide();
			}
		} );
	} );

	// show tagline
	api( 'show-tagline', function( value ) {
		value.bind( function( to ) {
			if (1 == to) {
				$('.site-description').show();
			} else {
				$('.site-description').hide();
			}
		} );
	} );

	// Color Scheme CSS.
	api.bind( 'preview-ready', function() {
		api.preview.bind( 'update-color-scheme-css', function( css ) {
			style.html( css );
		} );
	} );	
	
	api('home_menu_title',function( value ){
		value.bind( function( to  ) {	
			if ($('.steak-house-menu-title-list .title-main-section').length > 0 ){
				$('.steak-house-menu-title-list .title-main-section').html(to);
			}	
		});
	});

	api('home_menu_subtitle',function( value ){
		value.bind( function( to  ) {		
			if ($('.steak-house-menu-title-list .title-sub-section').length > 0) {
				$('.steak-house-menu-title-list .title-sub-section').html(to);
			}
		});
	});

	api('home_menu_view_more_label',function( value ){
		value.bind( function( to  ) {		
			$('.steak-house-home-view-more').html(to);
		});
	});
	

	api('home_menu_banner_head_title',function( value ){
		value.bind( function( to  ) {		
			$('.home-menu-banner .title-main-section').html(to);
		});
	});

	api('home_menu_banner_main_title',function( value ){
		value.bind( function( to  ) {		
			$('.home-menu-banner .title-sub-section').html(to);
		});
	});

	api('home_menu_banner_link_label',function( value ){
		value.bind( function( to  ) {		
			$('.home-menu-banner  .home-menu-banner-view-more').html(to);
		});
	});


	api('contact_setting_address',function( value ){
		value.bind( function( to  ) {
			if( '' == to ) {
				$('.find-us').hide();
				
			} else {
				var html_block = '\
						<img src="' + resCustomizer.location + '" />\
						<p>' + resCustomizer.location_title + '</p>\
						<div class="steak-house-home-contact-division steak-house-contact-address">\
							<p>' + to + '</p>\
						</div>';
				$('.steak-house-no-contact').remove();
				
				if ( $('.find-us').length <= 0 ) {
					if ($('.steak-house-home-contact').length > 0) {
						$('.steak-house-home-contact').prepend('<div class="find-us">' + html_block + '</div>');
					} else {
						$('.steak-house-home-contact').html('<div class="find-us">' + html_block + '</div>');
					}
				} else {
					$('.find-us').html(html_block).show();
				}
			}
		});
	});

	api('contact_setting_phone',function( value ){
		value.bind( function( to  ) {		
			var email_val = api('contact_setting_email').get();
			if ( '' == to && '' == email_val ) {
				$('.location').hide();
			} else {
				$('.steak-house-no-contact').remove();
				
				var html_block = '\
						<img src="' + resCustomizer.contact + '" />';

				html_block += '\
					<div class="steak-house-contact-phone" > \
							<a href="tel:' + to + '">' + to + '</a> \
						</div>';
				if ( '' != email_val ) {
					html_block += ' \
						<div class="steak-house-contact-email" > \
							<a href="mailto:' + email_val + '">' + email_val + '</a> \
						</div>';
				}

				if ( $('.location').length < 1 ) {					
					if ($('.steak-house-home-contact').length > 0) {
						$('.steak-house-home-contact').append('<div class="location">' + html_block + '</div>');
					} else {
						$('.steak-house-home-contact').html('<div class="location">' + html_block + '</div>');
					}
				} else {
					$('.location').html(html_block).show();
				}			
			}
		});
	});

	api('contact_setting_email',function( value ){
		value.bind( function( to  ) {
			var phone_val = api('contact_setting_phone').get();
			if ( '' == to && '' == phone_val ) {
				$('.location').hide();
			} else {
				$('.steak-house-no-contact').remove();
				var html_block = '\
					<img src="' + resCustomizer.contact + '" />';

				if ( '' != phone_val ) {
					html_block += '\
					<div class="steak-house-contact-phone" > \
						<a href="tel:' + phone_val + '">' + phone_val + '</a> \
					</div>';
				}
				html_block += ' \
				<div class="steak-house-contact-email" > \
					<a href="mailto:' + to + '">' + to + '</a> \
				</div>';			
				
				if ( $('.location').length < 1 ) {
					if ( $('.steak-house-home-contact').length > 0 ) {
						$('.steak-house-home-contact').append( '<div class="location">' +  html_block + '</div>' );
					} else {
						$('.steak-house-home-contact').html('<div class="location">' + html_block + '</div>');
					}
				} else {
					$('.location').html( html_block ).show();
				}
					
			} 
			
		});
	});	
	

	api('home_contact_opening_time',function( value ){
		value.bind( function( to  ) {	
			if( '' == to ) {
				$('.opening-time').hide();
			} else {
				var html_block = '\
						<img src="' + resCustomizer.opening + '" />\
						<div class="steak-house-home-contact-division steak-house-opening-time">\
							<p>' + to + '</p>\
						</div>';
				$('.steak-house-no-contact').remove();
					if ( $('.steak-house-home-contact').length > 0) {
						if ( $('.find-us').length > 0 && $('.location').length > 0  ) {
							if ($('.opening-time').length > 0 ){
								$('.opening-time').html( html_block);

							} else {
								$('<div class="opening-time">' + html_block + '</div>').insertAfter('.find-us');

							}
						} else if ( $('.find-us').length > 0 ) {
							$('<div class="opening-time">' + html_block + '</div>').insertAfter('.find-us');
						} else if ( $('.location').length > 0) {
							$('<div class="opening-time">' + html_block + '</div>').insertBefore('.location');
						}
					} else {
						$('.steak-house-home-contact').html('<div class="opening-time">' + html_block + '</div>');
					}
				$('.opening-time').show();
			}
		});
	});

	api('home_contact_reservation_label',function( value ){
		value.bind( function( to  ) {		
			$('.steak-house-contact-reservation-label').html( to );				
			$('.steak-house-banner-button .reservation_label').html( to );	
		});
	});
	
	api('home_contact_us_label',function( value ){
		value.bind( function( to  ) {		
			
			$('.steak-house-banner-button .contact_us_label').html( to );	
		});
	});

	api('footer_text',function( value ){
		value.bind( function( to  ) {		
			$('.copyright-text').html( to );	
		});
	});	

} )( jQuery );
