(function($) {
	$(document).ready(function() {

		$('.sod-nivoslider').each(function() {
			var $slider = $(this);
			$slider.thesodPreloader(function() {

				$slider.nivoSlider({
					effect: thesod_nivoslider_options.effect,
					slices: parseInt(thesod_nivoslider_options.slices),
					boxCols: parseInt(thesod_nivoslider_options.boxCols),
					boxRows: parseInt(thesod_nivoslider_options.boxRows),
					animSpeed: parseInt(thesod_nivoslider_options.animSpeed),
					pauseTime: parseInt(thesod_nivoslider_options.pauseTime),
					directionNav: thesod_nivoslider_options.directionNav,
					controlNav: thesod_nivoslider_options.controlNav,
					beforeChange: function(){
						$('.nivo-caption', $slider).animate({ opacity: 'hide' }, 500);
					},
					afterChange: function(){
						var data = $slider.data('nivo:vars');
						var index = data.currentSlide;
						if($('.sod-nivoslider-slide:eq('+index+') .sod-nivoslider-caption', $slider).length) {
							$('.nivo-caption', $slider).html($('.sod-nivoslider-slide:eq('+index+') .sod-nivoslider-caption', $slider).html());
							$('.nivo-caption', $slider).animate({ opacity: 'show' }, 500);
						} else {
							$('.nivo-caption', $slider).html('');
						}
					},
					afterLoad: function(){
						$slider.next('.nivo-controlNav').appendTo($slider).addClass('sod-mini-pagination');
						$('.nivo-directionNav .nivo-prevNav', $slider).addClass('sod-prev');
						$('.nivo-directionNav .nivo-nextNav', $slider).addClass('sod-next');
						if($('.sod-nivoslider-slide:eq(0) .sod-nivoslider-caption', $slider).length) {
							$('.nivo-caption', $slider).html($('.sod-nivoslider-slide:eq(0) .sod-nivoslider-caption', $slider).html());
							$('.nivo-caption', $slider).show();
						}
					}
				});

			});
		});

	});
})(jQuery);