(function($) {
	$(function() {

		$('.sod-news-type-carousel').each(function() {

			var $newsCarouselElement = $(this);

			var $newsItems = $('.sod-news-item', $newsCarouselElement);

			var $newsItemsWrap = $('<div class="sod-news-carousel-wrap"/>')
				.appendTo($newsCarouselElement);
			var $newsItemsCarousel = $('<div class="sod-news-carousel"/>')
				.appendTo($newsItemsWrap);
			var $newsItemsPagination = $('<div class="sod-news-pagination sod-mini-pagination"/>')
				.appendTo($newsItemsWrap);
			$newsItems.appendTo($newsItemsCarousel);

		});

		$('.sod-blog-slider').each(function() {

			var $newsCarouselElement = $(this);

			var $newsItems = $('article', $newsCarouselElement);

			var $newsItemsWrap = $('<div class="sod-blog-slider-carousel-wrap"/>')
				.appendTo($newsCarouselElement);
			var $newsItemsCarousel = $('<div class="sod-blog-slider-carousel"/>')
				.appendTo($newsItemsWrap);
			var $newsItemsNavigation = $('<div class="sod-blog-slider-navigation"/>')
				.appendTo($newsItemsWrap);
			var $newsItemsPrev = $('<a href="#" class="sod-blog-slider-prev sod-button sod-button-size-tiny"><i class="sod-print-icon sod-icon-pack-thesod-icons sod-icon-prev"></i></a>')
				.appendTo($newsItemsNavigation);
			var $newsItemsNext = $('<a href="#" class="sod-blog-slider-next sod-button sod-button-size-tiny"><i class="sod-print-icon sod-icon-pack-thesod-icons sod-icon-next"></i></a>')
				.appendTo($newsItemsNavigation);
			$newsItems.appendTo($newsItemsCarousel);
			$newsItemsNavigation.appendTo($newsItems.find('.sod-slider-item-overlay'));

		});

		$('body').updateNews();
		$('body').updateNewsSlider();

	});

	$.fn.updateNews = function() {
		$('.sod-news-type-carousel', this).each(function() {
			var $newsCarouselElement = $(this);

			var $newsItemsCarousel = $('.sod-news-carousel', $newsCarouselElement);
			var $newsItems = $('.sod-news-item', $newsItemsCarousel);
			var $newsItemsPagination = $('.sod-mini-pagination', $newsCarouselElement);

			$newsCarouselElement.thesodPreloader(function() {

				var $newsCarousel = $newsItemsCarousel.carouFredSel({
					auto: 10000,
					circular: false,
					infinite: true,
					width: '100%',
					height: 'variable',
					align: 'center',
					pagination: $newsItemsPagination
				});

			});
		});
	}

	$.fn.updateNewsSlider = function() {
		$('.sod-blog-slider', this).each(function() {
			var $newsCarouselElement = $(this);
			var $newsItemsCarousel = $('.sod-blog-slider-carousel', $newsCarouselElement);
			var $newsItems = $('article', $newsItemsCarousel);
			var $newsItemsNavigation = $('.sod-blog-slider-navigation', $newsCarouselElement);
			var $newsItemsPrev = $('.sod-blog-slider-prev', $newsCarouselElement);
			var $newsItemsNext = $('.sod-blog-slider-next', $newsCarouselElement);

			$newsCarouselElement.thesodPreloader(function() {

				var $newsCarousel = $newsItemsCarousel.carouFredSel({
					auto: ($newsCarouselElement.data('autoscroll') > 0 ? $newsCarouselElement.data('autoscroll') : false),
					circular: true,
					infinite: true,
					responsive: true,
					width: '100%',
					height: 'auto',
					align: 'center',
					items: 1,
					swipe: true,
					prev: $newsItemsPrev,
					next: $newsItemsNext,
					scroll: {
						pauseOnHover: true,
						items: 1
					},
					onCreate: function() {
						$(window).on('resize', function() {
							var heights = $newsItems.map(function() { return $(this).height(); });
							$newsCarousel.parent().add($newsCarousel).height(Math.max.apply(null, heights));
						});
					}
				});

			});
		});
	}

})(jQuery);