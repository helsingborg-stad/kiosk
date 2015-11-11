HbgKiosk = HbgKiosk || {};
HbgKiosk.Joystick = HbgKiosk.Joystick || {};

HbgKiosk.Joystick.browseUi = (function ($) {

    // Which data attribute to look after for the prev and next buttons
    // Example: "joystick" => data-joystick
    var dataAttr = 'joystick';

    var currentFocusedIndex = -1;
    var focusableElements = [];

    function browseUi() {
        $(function(){

            this.init();

        }.bind(this));
    }

    /**
     * Initialize the joystick function
     * @return {void}
     */
    browseUi.prototype.init = function () {
        this.findTabindex();
        this.handleEvents();
    };

    /**
     * Find elements with tabindex
     * @return {void}
     */
    browseUi.prototype.findTabindex = function () {
        focusableElements = $('[tabindex]:not([tabindex="-1"])');
    };

    /**
     * Focus on next tabindex
     * @return {void}
     */
    browseUi.prototype.focusNext = function () {
        currentFocusedIndex++;

        if (currentFocusedIndex > focusableElements.length-1) {
            currentFocusedIndex = 0;
        }

        focusableElements[currentFocusedIndex].focus();

        $('#center-button-select').show();
        $('#center-button').hide();
    };

    /**
     * Focus on previous tabindex
     * @return {void}
     */
    browseUi.prototype.focusPrev = function () {
        currentFocusedIndex--;

        if (currentFocusedIndex < 0) {
            currentFocusedIndex = focusableElements.length-1;
        }

        focusableElements[currentFocusedIndex].focus();

        $('#center-button-select').show();
        $('#center-button').hide();
    };

    /**
     * Resets focus to zero
     * @return {void}
     */
    browseUi.prototype.resetFocus = function () {
        if (currentFocusedIndex > -1) {
            focusableElements[currentFocusedIndex].blur();
            currentFocusedIndex = -1;
        }

        $('#center-button-select').hide();
        $('#center-button').show();
    };

    /**
     * Handle joystick events
     * @return {void}
     */
    browseUi.prototype.handleEvents = function () {
        $(document).on('click.joystick-prev', '[data-' + dataAttr + '="previous"]', function (e) {
            e.preventDefault();
            this.focusPrev();
        }.bind(this));

        $(document).on('click.joystick-next', '[data-' + dataAttr + '="next"]', function (e) {
            e.preventDefault();
            this.focusNext();
        }.bind(this));

        $(document).on('click.joystick-outside', function (e) {
            if (!$(e.target).closest('[tabindex]').length) {
                this.resetFocus();
            }
        }.bind(this));

        $(document).on('mouseenter.joystick-hover', '[tabindex]:not([tabindex="-1"])', function (e) {
            this.resetFocus();
        }.bind(this));

        $('#center-button-select').on('click', function (e) {
            e.preventDefault();

            if ($(focusableElements[currentFocusedIndex]).is('a')) {
                location.href = $(focusableElements[currentFocusedIndex]).attr('href');
            }
        });
    };

    return new browseUi();

})(jQuery);