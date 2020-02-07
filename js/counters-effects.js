(function($) {
	$(function() {

		$('.sod-counter').each(function() {
			var $item = $(this);
			var initHover = {
				icon_color1: $('.sod-icon-half-1', $item).css('color'),
				icon_color2: $('.sod-icon-half-2', $item).css('color'),
				icon_background: $('.sod-icon-inner', $item).css('background-color'),
				icon_border: $('.sod-icon', $item).css('border-left-color'),
				icon_box_border: $('.sod-counter-icon-circle-1', $item).css('border-left-color'),
				icon_box_shadow: $('.sod-icon', $item).css('box-shadow'),
				box_color: $('.sod-counter-inner', $item).css('background-color'),
				number_color: $('.sod-counter-number', $item).css('color'),
				text_color: $('.sod-counter-text', $item).css('color'),
			};
			$item.data('initHover', initHover);
			if($item.hasClass('sod-counter-effect-background-reverse') || $item.hasClass('sod-counter-effect-border-reverse')) {
				$('.sod-icon-inner', $item).prepend('<div class="sod-counter-animation"/>');
				if($item.hasClass('sod-counter-effect-border-reverse')) {
					$('.sod-counter-animation', $item).css('background-color', initHover.box_color);
				} else if($item.data('hover-background-color')) {
					$('.sod-counter-animation', $item).css('background-color', $item.data('hover-background-color'));
				}
			}
		});

		$('body').on('mouseenter', '.sod-counter a', function() {
			var $item = $(this).closest('.sod-counter');
			var initHover = $item.data('initHover');
			var $box = $item.closest('.sod-counter-box');
			$item.addClass('hover');
			if($item.data('hover-icon-color')) {
				if($box.hasClass('sod-counter-style-2')) {
					$('.sod-icon-half-1', $item).css('color', initHover.icon_box_border);
					$('.sod-icon-half-2', $item).css('color', initHover.icon_box_border);
					$('.sod-counter-icon-circle-1', $item).css('border-color', $item.data('hover-icon-color'));
					$('.sod-counter-icon-circle-1', $item).css('background-color', $item.data('hover-icon-color'));
					$('.sod-counter-icon-circle-2', $item).css('border-color', 'transparent');
				} else {
					if($item.hasClass('sod-counter-effect-background-reverse')) {
						$('.sod-icon', $item).css('border-color', $item.data('hover-icon-color'));
						$('.sod-icon-half-1', $item).css('color', $item.data('hover-icon-color'));
						$('.sod-icon-half-2', $item).css('color', $item.data('hover-icon-color'));
					}
					if($item.hasClass('sod-counter-effect-border-reverse')) {
						$('.sod-icon', $item).css('border-color', $item.data('hover-icon-color'));
						$('.sod-icon-inner', $item).css('background-color', $item.data('hover-icon-color'));
						$('.sod-icon-half-1', $item).css('color', '#ffffff');
						$('.sod-icon-half-2', $item).css('color', '#ffffff');
					}
					if($item.hasClass('sod-counter-effect-simple')) {
						$('.sod-icon-half-1', $item).css('color', $item.data('hover-icon-color'));
						$('.sod-icon-half-2', $item).css('color', $item.data('hover-icon-color'));
					}
				}
			}
			if($item.data('hover-numbers-color')) {
				$('.sod-counter-number', $item).css('color', $item.data('hover-numbers-color'));
			}
			if($item.data('hover-text-color')) {
				$('.sod-counter-text', $item).css('color', $item.data('hover-text-color'));
			}
			if($item.data('hover-background-color')) {
				$('.sod-counter-inner', $item).css('background-color', $item.data('hover-background-color'));
				$('.sod-counter-bottom-left, .sod-counter-bottom-right', $item).css('background-color', $item.data('hover-background-color'));
				$('.sod-counter-bottom svg', $item).css('fill', $item.data('hover-background-color'));
				if(!$box.hasClass('sod-counter-style-vertical')) {
					$('.sod-icon', $item).css('box-shadow', '0 0 0 5px '+$item.data('hover-background-color') + ', 0 0 0 6px ' + ($item.data('hover-icon-color') ? $item.data('hover-icon-color') : '#ffffff'));
				}
			}
		});

		$('body').on('mouseleave', '.sod-counter a', function() {
			var $item = $(this).closest('.sod-counter');
			var initHover = $item.data('initHover');
			$item.removeClass('hover');
			$('.sod-icon', $item).css('border-color', initHover.icon_border);
			$('.sod-icon-inner', $item).css('background-color', initHover.icon_background);
			$('.sod-icon-half-1', $item).css('color', initHover.icon_color1);
			$('.sod-icon-half-2', $item).css('color', initHover.icon_color2);
			$('.sod-icon', $item).css('box-shadow', initHover.icon_box_shadow),
			$('.sod-counter-icon-circle-1, .sod-counter-icon-circle-2', $item).css('border-color', initHover.icon_box_border);
			$('.sod-counter-icon-circle-1').css('background-color', 'transparent');
			$('.sod-counter-inner', $item).css('background-color', initHover.box_color);
			$('.sod-counter-bottom-left, .sod-counter-bottom-right', $item).css('background-color', initHover.box_color);
			$('.sod-counter-bottom svg', $item).css('fill', initHover.box_color);
			$('.sod-counter-number', $item).css('color', initHover.number_color);
			$('.sod-counter-text', $item).css('color', initHover.text_color);
		});

	});
})(jQuery);