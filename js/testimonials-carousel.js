(function($) {
	$(function() {

		$('.sod-testimonials').each(function() {

			var $testimonialsElement = $(this);

			var $testimonials = $('.sod-testimonial-item', $testimonialsElement);

			var $testimonialsWrap = $('<div class="sod-testimonials-carousel-wrap"/>')
				.appendTo($testimonialsElement);
			var $testimonialsCarousel = $('<div class="sod-testimonials-carousel"/>')
				.appendTo($testimonialsWrap);
			if($testimonialsElement.hasClass('fullwidth-block')) {
				$testimonialsCarousel.wrap('<div class="container" />');
			}
			var $testimonialsNavigation = $('<div class="sod-testimonials-navigation"/>')
				.appendTo($testimonialsWrap);
			var $testimonialsPrev = $('<a href="javascript:void(0);" class="sod-prev sod-testimonials-prev"/></a>')
				.appendTo($testimonialsNavigation);
			var $testimonialsNext = $('<a href="javascript:void(0);" class="sod-next sod-testimonials-next"/></a>')
				.appendTo($testimonialsNavigation);
			$testimonials.appendTo($testimonialsCarousel);

		});

		$('body').updateTestimonialsCarousel();
		$('.fullwidth-block').each(function() {
			$(this).on('updateTestimonialsCarousel', function() {
				$(this).updateTestimonialsCarousel();
			});
		});
		$('.sod_tab').on('tab-update', function() {
			$(this).updateTestimonialsCarousel();
		});
	});

	$.fn.updateTestimonialsCarousel = function() {
		function initTestimonialsCarousel() {
			if (window.tgpLazyItems !== undefined) {
				var isShowed = window.tgpLazyItems.checkGroupShowed(this, function(node) {
					initTestimonialsCarousel.call(node);
				});
				if (!isShowed) {
					return;
				}
			}

			var $testimonialsElement = $(this);

			var $testimonialsCarousel = $('.sod-testimonials-carousel', $testimonialsElement);
			var $testimonials = $('.sod-testimonial-item', $testimonialsCarousel);
			var $testimonialsPrev = $('.sod-testimonials-prev', $testimonialsElement);
			var $testimonialsNext = $('.sod-testimonials-next', $testimonialsElement);

			$testimonialsElement.thesodPreloader(function() {

				var $testimonialsView = $testimonialsCarousel.carouFredSel({
					auto: ($testimonialsElement.data('autoscroll') > 0 ? $testimonialsElement.data('autoscroll') : false),
					circular: true,
					infinite: true,
					width: '100%',
					height: 'auto',
					items: 1,
					align: 'center',
					responsive: true,
					swipe: true,
					prev: $testimonialsPrev,
					next: $testimonialsNext,
					scroll: {
						pauseOnHover: true,
						fx: 'scroll',
						easing: 'easeInOutCubic',
						duration: 1000,
						onBefore: function(data) {
							data.items.old.css({
								opacity: 1
							}).animate({
								opacity: 0
							}, 500, 'linear');

							data.items.visible.css({
								opacity: 0
							}).animate({
								opacity: 1
							}, 1000, 'linear');
						}
					}
				});

			});
		}

		$('.sod-testimonials', this).add($(this).filter('.sod-testimonials')).each(initTestimonialsCarousel);
	}

})(jQuery);
