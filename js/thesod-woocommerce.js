(function($) {
	$('.variations_form').each(function() {
		$form = $(this)
			.on('change', '.variations select', function(event) {
				var $text = $(this).closest('.combobox-wrapper').find('.combobox-text');
				$text.text($('option:selected', $(this)).text());
			});
	});

	$('body').on('updated_checkout', function() {
		$('input.sod-checkbox').checkbox();
		$('select.shipping_method').combobox();
		window.init_checkout_navigation();
	});

	$('body').on('updated_shipping_method', function() {
		$('input.sod-checkbox').checkbox();
		$('select.shipping_method').combobox();
	});

	$('.remove_from_wishlist_resp').on('click', function(e) {
		$(this).closest('.cart-item').find('.wishlist_table .product-remove .remove_from_wishlist').click();
		e.preventDefault();
        return false;
    });

	$(function() {
		$('.price_slider_amount .button').addClass('sod-button sod-button-style-outline sod-button-size-tiny');
	});

	// Quantity buttons
	$( 'form:not(.cart) div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<button type="button" class="plus" >+</button>' ).prepend( '<button type="button" class="minus" >-</button>' );

	$( document ).on( 'click', '.plus, .minus', function() {

		// Get values
		var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
			currentVal	= parseFloat( $qty.val() ),
			max			= parseFloat( $qty.attr( 'max' ) ),
			min			= parseFloat( $qty.attr( 'min' ) ),
			step		= $qty.attr( 'step' );

		// Format values
		if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
		if ( max === '' || max === 'NaN' ) max = '';
		if ( min === '' || min === 'NaN' ) min = 0;
		if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

		// Change the value
		if ( $( this ).is( '.plus' ) ) {

			if ( max && ( max == currentVal || currentVal > max ) ) {
				$qty.val( max );
			} else {
				$qty.val( currentVal + parseFloat( step ) );
			}

		} else {

			if ( min && ( min == currentVal || currentVal < min ) ) {
				$qty.val( min );
			} else if ( currentVal > 0 ) {
				$qty.val( currentVal - parseFloat( step ) );
			}

		}
		$qty.trigger('change');
	});

	$( document ).on( 'click', '.product-bottom a.add_to_cart_button', function() {
		$(this).closest('.product-bottom').find('a, .yith-wcwl-add-to-wishlist').hide();
	});

	$( document ).on( 'click', '.product-bottom a.add_to_wishlist', function() {
		$(this).closest('.product-bottom').find('a').hide();
		$(this).parent().addClass('ajax');
		$(this).closest('.product-bottom').find('.yith-wcwl-wishlistaddedbrowse a').show();
		$(this).closest('.yith-wcwl-add-to-wishlist').addClass('added');
	});


	$( document ).on( 'click', '.woocommerce-review-link', function(e) {
		$('.sod-woocommerce-tabs').find('a[data-vc-accordion][href="#tab-reviews"]').trigger('click');
	});

	$(function() {
		if(typeof wc_add_to_cart_variation_params !== 'undefined') {
			$('.variations_form').each( function() {
				$(this).on('show_variation', function(event, variation) {
					if(variation.image_id) {
						var $product_content = $(this).closest('.single-product-content');
						var $gallery = $product_content.find('.sod-gallery').eq(0);
						if($gallery.length) {
							var $gallery_item = $gallery.find('.sod-gallery-thumbs-carousel .sod-gallery-item[data-image-id="'+variation.image_id+'"] a');
							$gallery_item.closest('.sod-gallery-item').addClass('active');
							$gallery_item.trigger('click');
						}
					}
				});
			});
		}
	});

	$(document.body).on('updated_wc_div applied_coupon removed_coupon', function() {
		$( '.shop_table.cart' ).closest( 'form' ).eq(0).nextAll('.woocommerce-message').remove();
		$( '.shop_table.cart' ).closest( 'form' ).eq(0).nextAll('.woocommerce-info').remove();
		$( '.shop_table.cart' ).closest( 'form' ).eq(0).nextAll('.woocommerce-error').remove();
		$( '.shop_table.cart' ).closest( 'form' ).eq(1).nextAll('form').remove();
		$('input.sod-checkbox').checkbox();
		$('select.shipping_method').combobox();
		$( 'form:not(.cart) div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<button type="button" class="plus" >+</button>' ).prepend( '<button type="button" class="minus" >-</button>' );

		$.ajax( {
			type: 'POST',
			url: thesod_woo_data.ajax_url,
			data: {
				action: 'thesod_cart_items_html',
			},
			dataType: 'html',
			success: function( response ) {
				$('.cart-short-info').replaceWith($(response));
			}
		} );
	});

	$(function() {
		$(document.body).on('click', '.product .quick-view-button, .product-quick-view-navigation a', function(e) {
			e.preventDefault();
			var $button = $(this);
			$.fancybox.close();
			$.fancybox.open({
				type: 'ajax',
				src: thesod_woo_data.ajax_url,
				ajax: {
					settings: {
						method: 'POST',
						data: {
							ajax_nonce: thesod_woo_data.ajax_nonce,
							action: 'thesod_product_quick_view',
							product_id: $(this).data('product-id')
						}
					}
				},
				slideClass: 'woo-modal-product',
				afterShow: function(el) {
					$('.sod-combobox').combobox();
					el.current.$content.buildSimpleGalleries();
					el.current.$content.updateSimpleGalleries();
					$( '.variations_form', el.current.$content).each( function() {
						var $form = $(this);
						$form.on('reset_image show_variation', function () {
							el.removeEvents();
							window.setTimeout( function() {
								el.addEvents();
							}, 100);
						});
						$form.on('show_variation', function (e, variation) {
							if(variation.image && variation.image.src) {
								var $g_item = $('.sod-quick-view-gallery .sod-gallery-item img[src="' + variation.image.src + '"]', el.current.$content).closest('.sod-gallery-item');
								$('.sod-quick-view-gallery .sod-gallery-items-carousel', el.current.$content).trigger('slideTo', [$g_item]);
							}
						});
						$form.wc_variation_form();
						$form.on('change', '.variations select', function(event) {
							var $text = $(this).closest('.combobox-wrapper').find('.combobox-text');
							$text.text($('option:selected', $(this)).text());
						});
					});
				}
			}, {
				spinnerTpl : '<div class="sod-fancybox-preloader"><div class="preloader-spin"></div></div>',
				caption: '<div class="product-navigation-caption"></div>'
			});
		});

		$('.sod-product-load-more').each(function() {
			if ($.fn.itemsAnimations !== undefined) {
				var $products_parent = $(this).siblings('.products');
				if (!$products_parent.hasClass('item-animation-move-up')) {
					$products_parent.addClass('item-animation-move-up');
				}
				$products_parent.itemsAnimations({
					itemSelector: '.product'
				});
			}
			$(this).on('click', 'button', function() {
				products_load_core_request($(this).closest('.sod-product-load-more'));
			});
		});

		$('.sod-product-scroll-pagination').each(function() {
			var $this = $(this),
				watcher = scrollMonitor.create(this);
			watcher.enterViewport(function() {
				products_load_core_request($this);
			});

			if ($.fn.itemsAnimations !== undefined) {
				var $products_parent = $(this).siblings('.products');
				if (!$products_parent.hasClass('item-animation-move-up')) {
					$products_parent.addClass('item-animation-move-up');
				}
				$products_parent.itemsAnimations({
					itemSelector: '.product'
				});
			}
		});
	});

	function products_load_core_request($pagination) {
		var current = parseInt($pagination.data('pagination-current')),
			total = parseInt($pagination.data('pagination-total')),
			base_url = $pagination.data('pagination-base'),
			is_processing_request = $pagination.data('request-process') || false,
			next_page = current + 1,
			next_page_url = base_url.replace('%#%', next_page);

		if (is_processing_request || next_page > total) {
			return false;
		}
		$pagination.data('request-process', true);
		if ($pagination.hasClass('sod-product-load-more')) {
			$('.sod-button', $pagination).before('<div class="loading"><div class="preloader-spin"></div></div>');
		}
		if ($pagination.hasClass('sod-product-scroll-pagination')) {
			$pagination.addClass('active').html('<div class="loading"><div class="preloader-spin"></div></div>');
		}

		$.ajax({
			url: next_page_url,
			data: {thesod_products_ajax: 1},
			success: function(response) {
				if ($pagination.hasClass('sod-product-load-more')) {
					$('.sod-button .loading', $pagination).remove();
				}
				if ($pagination.hasClass('sod-product-scroll-pagination')) {
					$pagination.removeClass('active').html('');
				}

				var $response = $(response),
					$products = $('.products .product', $response);

				if ($products.length) {
					var $products_parent = $pagination.siblings('.products');
					$products_parent.append($products);
					if ($.fn.itemsAnimations !== undefined) {
						var itemsAnimations = $products_parent.itemsAnimations('instance');
						if (itemsAnimations) {
							itemsAnimations.show($products);
						}
					}
					$pagination.data('pagination-current', next_page);
					if (next_page >= total) {
						$pagination.hide().remove();
					}
				}
				if ($pagination.hasClass('sod-product-load-more')) {
					$('.loading', $pagination).remove();
				}
				if ($pagination.hasClass('sod-product-scroll-pagination')) {
					$pagination.removeClass('active').html('');
				}
				$pagination.data('request-process', false);
			}
		});
	}

})(jQuery);
