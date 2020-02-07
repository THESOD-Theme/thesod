(function($) {
    $(function() {

        $('.sod-featured-posts-slider').each(function() {

            var $this = $(this);
            var paginator = JSON.parse($this.attr('data-paginator'));
            var $items = $('article', $this);

            var $wrap = $('<div class="sod-featured-posts-slider-wrap"/>').appendTo($this);
            var $item = $('<div class="sod-featured-posts-slider-carousel"/>').appendTo($wrap);

            switch (paginator.type) {
                case 'arrows':
                    var $nav = $('<div class="sod-featured-posts-slider-nav"/>').appendTo($wrap);
                    $nav.addClass('size-'+paginator.size.replace('_', '-'));
                    $nav.addClass('style-'+paginator.style.replace('_', '-'));
                    $nav.addClass('position-'+paginator.position.replace('_', '-'));
                    $nav.addClass('style-icon-'+paginator.icon);

                    $('<a href="#" class="sod-featured-posts-slide-prev"></a>').appendTo($nav);
                    $('<a href="#" class="sod-featured-posts-slide-next"></a>').appendTo($nav);
                    break;
                case 'bullets':
                    var $dots = $('<div class="sod-featured-posts-slider-dots"/>').appendTo($wrap)
                    $dots.addClass('size-'+paginator.size.replace('_', '-'));
                    $dots.addClass('style-'+paginator.style.replace('_', '-'));
                    break;
            }

            $items.appendTo($item);

        });

        $('body').updateFeaturedPostsSlider();

    });

    $.fn.updateFeaturedPostsSlider = function() {
        $('.sod-featured-posts-slider', this).each(function() {
            var $this = $(this),
                $itemsCarousel = $('.sod-featured-posts-slider-carousel', $this),
                $item = $('article', $itemsCarousel),
                slidingEffect = $this.attr('data-sliding-effect'),
                autoScroll = $this.attr('data-auto-scroll') > 0 ? $this.attr('data-auto-scroll') : false,
                paginator = JSON.parse($this.attr('data-paginator'));

            var sliderConfig = {
                auto: autoScroll,
                circular: true,
                infinite: true,
                responsive: true,
                width: '100%',
                height: 'auto',
                align: 'center',
                items: 1,
                swipe: true,
                scroll : {
                    items         : 1,
                    pauseOnHover  : true
                }
            };

            if (paginator.type == 'arrows') {
                var $nav = $('.sod-featured-posts-slider-nav', $this);
                sliderConfig.prev = $('.sod-featured-posts-slide-prev', $nav);
                sliderConfig.next = $('.sod-featured-posts-slide-next', $nav);
            }

            if (paginator.type == 'bullets') {
                var $dots = $('.sod-featured-posts-slider-dots', $this);
                sliderConfig.pagination = {
                    container: $dots
                };
            }

            switch (slidingEffect) {
                case 'slide':
                    sliderConfig.scroll.fx = 'scroll';
                    break;
                case 'fade':
                    sliderConfig.scroll.fx = 'crossfade';
                    sliderConfig.scroll.duration = 1000;
                    break;
            }

            $this.thesodPreloader(function() {
                $itemsCarousel.carouFredSel(sliderConfig);
            });
        });
    }

})(jQuery);