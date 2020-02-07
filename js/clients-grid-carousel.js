(function($) {
	$(function() {

		$('.sod-clients-type-carousel-grid:not(.carousel-disabled)').each(function() {

			var $clientsCarouselElement = $(this);

			var $clientsItems = $('.sod-clients-slide', $clientsCarouselElement);

			var $clientsItemsWrap = $('<div class="sod-clients-grid-carousel-wrap"/>')
				.appendTo($clientsCarouselElement);
			var $clientsItemsCarousel = $('<div class="sod-clients-grid-carousel"/>')
				.appendTo($clientsItemsWrap);
			var $clientsItemsPagination = $('<div class="sod-clients-grid-pagination sod-mini-pagination"/>')
				.appendTo($clientsItemsWrap);
			$clientsItems.appendTo($clientsItemsCarousel);

		});


		$('.sod_client_carousel-items').each(function () {

			var $clientsElement = $(this);

			var $clients = $('.sod-client-item', $clientsElement);

			var $clientsWrap = $('<div class="sod-client-carousel-item-wrap"/>')
				.appendTo($clientsElement);
			var $clientsCarousel = $('<div class="sod-client-carousel"/>')
				.appendTo($clientsWrap);
			var $clientsNavigation = $('<div class="sod-client-carousel-navigation"/>')
				.appendTo($clientsWrap);
			var $clientsPrev = $('<a href="#" class="sod-prev sod-client-prev"/></a>')
				.appendTo($clientsNavigation);
			var $clientsNext = $('<a href="#" class="sod-next sod-client-next"/></a>')
				.appendTo($clientsNavigation);
			$clients.appendTo($clientsCarousel);

		});

		$('body').updateClientsGrid();
		$('body').updateClientsCarousel();
		$('.fullwidth-block').each(function() {
			$(this).on('updateClientsCarousel', function() {
				$(this).updateClientsCarousel();
			});
		});
		$('.sod_tab').on('tab-update', function() {
			$(this).updateClientsGrid();
		});
		$(document).on('gem.show.vc.tabs', '[data-vc-accordion]', function() {
			$(this).data('vc.accordion').getTarget().updateClientsGrid();
		});
		$(document).on('gem.show.vc.accordion', '[data-vc-accordion]', function() {
			$(this).data('vc.accordion').getTarget().updateClientsGrid();
		});

	});

	$.fn.updateClientsGrid = function() {
		function initClientsGrid() {
			if (window.tgpLazyItems !== undefined) {
				var isShowed = window.tgpLazyItems.checkGroupShowed(this, function(node) {
					initClientsGrid.call(node);
				});
				if (!isShowed) {
					return;
				}
			}

			var $clientsCarouselElement = $(this);

			var $clientsItemsCarousel = $('.sod-clients-grid-carousel', $clientsCarouselElement);
			var $clientsItemsPagination = $('.sod-mini-pagination', $clientsCarouselElement);

			var autoscroll = $clientsCarouselElement.data('autoscroll') > 0 ? $clientsCarouselElement.data('autoscroll') : false;

			$clientsCarouselElement.thesodPreloader(function() {

				var $clientsGridCarousel = $clientsItemsCarousel.carouFredSel({
					auto: autoscroll,
					circular: false,
					infinite: true,
					width: '100%',
					items: 1,
					responsive: true,
					height: 'auto',
					align: 'center',
					pagination: $clientsItemsPagination,
					scroll: {
						pauseOnHover: true
					}
				});

			});
		}

		$('.sod-clients-type-carousel-grid:not(.carousel-disabled)', this).each(initClientsGrid);
	}

	$.fn.updateClientsCarousel = function() {
		function initClientsCarousel() {
			if (window.tgpLazyItems !== undefined) {
				var isShowed = window.tgpLazyItems.checkGroupShowed(this, function(node) {
					initClientsCarousel.call(node);
				});
				if (!isShowed) {
					return;
				}
			}

			var $clientsElement = $(this);

			var $clientsCarousel = $('.sod-client-carousel', $clientsElement);
			var $clientsPrev = $('.sod-client-prev', $clientsElement);
			var $clientsNext = $('.sod-client-next', $clientsElement);

			var autoscroll = $clientsElement.data('autoscroll') > 0 ? $clientsElement.data('autoscroll') : false;

			$clientsElement.thesodPreloader(function() {

				var $clientsView = $clientsCarousel.carouFredSel({
					auto: autoscroll,
					circular: true,
					infinite: false,
					scroll: {
						items: 1
					},
					width: '100%',
					responsive: false,
					height: 'auto',
					align: 'center',
					prev: $clientsPrev,
					next: $clientsNext
				});

			});
		}

		$('.sod_client_carousel-items:not(.carousel-disabled)', this).each(initClientsCarousel);
	}

})(jQuery);
