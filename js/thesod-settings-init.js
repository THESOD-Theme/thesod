(function() {
    function isTouchDevice() {
        return (('ontouchstart' in window) ||
            (navigator.MaxTouchPoints > 0) ||
            (navigator.msMaxTouchPoints > 0));
    }

    window.sodSettings.isTouch = isTouchDevice();

    function userAgentDetection() {
        var ua = navigator.userAgent.toLowerCase(),
        platform = navigator.platform.toLowerCase(),
        UA = ua.match(/(opera|ie|firefox|chrome|version)[\s\/:]([\w\d\.]+)?.*?(safari|version[\s\/:]([\w\d\.]+)|$)/) || [null, 'unknown', 0],
        mode = UA[1] == 'ie' && document.documentMode;

        window.sodBrowser = {
            name: (UA[1] == 'version') ? UA[3] : UA[1],
            version: UA[2],
            platform: {
                name: ua.match(/ip(?:ad|od|hone)/) ? 'ios' : (ua.match(/(?:webos|android)/) || platform.match(/mac|win|linux/) || ['other'])[0]
                }
        };
            }

    window.updateGemClientSize = function() {
        if (window.sodOptions == null || window.sodOptions == undefined) {
            window.sodOptions = {
                first: false,
                clientWidth: 0,
                clientHeight: 0,
                innerWidth: -1
            };
        }

        window.sodOptions.clientWidth = window.innerWidth || document.documentElement.clientWidth;
        if (document.body != null && !window.sodOptions.clientWidth) {
            window.sodOptions.clientWidth = document.body.clientWidth;
        }

        window.sodOptions.clientHeight = window.innerHeight || document.documentElement.clientHeight;
        if (document.body != null && !window.sodOptions.clientHeight) {
            window.sodOptions.clientHeight = document.body.clientHeight;
        }
    };

    window.updateGemInnerSize = function(width) {
        window.sodOptions.innerWidth = width != undefined ? width : (document.body != null ? document.body.clientWidth : 0);
    };

    userAgentDetection();
    window.updateGemClientSize(true);

    window.sodSettings.lasyDisabled = window.sodSettings.forcedLasyDisabled || (!window.sodSettings.mobileEffectsEnabled && (window.sodSettings.isTouch || window.sodOptions.clientWidth <= 800));
})();
