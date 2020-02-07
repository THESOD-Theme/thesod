(function($) {
    function init_odometer(el) {
        if ($('.sod-counter-odometer', el).size() == 0)
            return;
        var odometer = $('.sod-counter-odometer', el).get(0);
        var format = $(el).closest('.sod-counter-box').data('number-format');
        format = format ? format : '(ddd).ddd';
        var od = new Odometer({
            el: odometer,
            value: $(odometer).text(),
            format: format
        });
        od.update($(odometer).data('to'));
    }

    window.thesod_init_odometer = init_odometer;

    $('.sod-counter').each(function(index) {
        if ($(this).closest('.sod-counter-box').size() > 0 && $(this).closest('.sod-counter-box').hasClass('lazy-loading') && !window.sodSettings.lasyDisabled) {
            $(this).addClass('lazy-loading-item').data('ll-effect', 'action').data('item-delay', '0').data('ll-action-func', 'thesod_init_odometer');
            $('.sod-icon', this).addClass('lazy-loading-item').data('ll-effect', 'fading').data('item-delay', '0');
            $('.sod-counter-text', this).addClass('lazy-loading-item').data('ll-effect', 'fading').data('item-delay', '0');
            return;
        }
        init_odometer(this);
    });
})(jQuery);
