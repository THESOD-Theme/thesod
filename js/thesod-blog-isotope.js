(function($) {
	function initBlogMasonryTimeline() {
		if (window.tgpLazyItems !== undefined) {
			var isShowed = window.tgpLazyItems.checkGroupShowed(this, function(node) {
				initBlogMasonryTimeline.call(node);
			});
			if (!isShowed) {
				return;
			}
		}

		var $blog = $(this),
			isTimeline = $blog.hasClass('blog-style-timeline_new');

		if (isTimeline && $blog.closest('.vc_row[data-vc-stretch-content="true"]').length > 0) {
			$('.post-image img.img-responsive', $blog).removeAttr('srcset');
		}

		window.thesodBlogImagesLoaded($blog, 'article img', function() {
			$blog.prev('.preloader').remove();

			var itemsAnimations = $blog.itemsAnimations({
				itemSelector: 'article',
				scrollMonitor: true,
				firstItemStatic: isTimeline
			});

			var init_blog = true;
			if (isTimeline) {
				$blog
					.on('layoutComplete', function(event, laidOutItems) {
						laidOutItems.forEach(function(item) {
							if (item.position.x == 0) {
								$(item.element).removeClass('right-position').addClass('left-position');
							} else {
								$(item.element).removeClass('left-position').addClass('right-position');
							}
						});
					});
			}

			$blog
				.on( 'arrangeComplete', function( event, filteredItems ) {
					$blog.buildSimpleGalleries();
					$blog.updateSimpleGalleries();

					if (init_blog) {
						init_blog = false;
						itemsAnimations.show();
					}
				})
				.isotope({
					itemSelector: 'article',
					layoutMode: 'masonry',
					masonry: {
						columnWidth: 'article:not(.sticky)'
					},
					transitionDuration: 0
				});

			if ($blog.hasClass('fullwidth-block')) {
				$blog.bind('fullwidthUpdate', function() {
					if ($blog.data('isotope')) {
						$blog.isotope('layout');
						return false;
					}
				});
			}
		});

		var $blogParent = $blog;
		if (isTimeline) {
			$blogParent = $blog.parent();
		}
		$blogParent.siblings('.blog-load-more').on('click', function() {
			window.thesodBlogLoadMoreRequest($blog, $(this), false);
		});

		window.thesodInitBlogScrollNextPage($blog, $blogParent.siblings('.blog-scroll-pagination'));

		$blog.buildSimpleGalleries();
		$blog.updateSimpleGalleries();
	}

	$('.blog-style-masonry, .blog-style-timeline_new').each(initBlogMasonryTimeline);
})(jQuery);
