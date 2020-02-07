(function() {
    if (window.sodBrowser.name == 'safari') {
        try {
            var safariVersion = parseInt(window.sodBrowser.version);
        } catch(e) {
            var safariVersion = 0;
        }
        if (safariVersion >= 9) {
            window.sodSettings.parallaxDisabled = true;
            window.sodSettings.fillTopArea = true;
        }
    }
})();
