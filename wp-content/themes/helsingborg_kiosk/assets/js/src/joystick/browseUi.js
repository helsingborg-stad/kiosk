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
        focusableElements = $('[tabindex]:not([tabindex="-1"]):not([tabindex="0"])');
    };

    /**
     * Focus on next tabindex
     * @return {void}
     */
    browseUi.prototype.focusNext = function () {
        var prevFocusedIndex = currentFocusedIndex;
        currentFocusedIndex++;

        if (currentFocusedIndex > focusableElements.length-1) {
            prevFocusedIndex = focusableElements.length-1;
            currentFocusedIndex = 0;
        }

        var prevElement = $(focusableElements[prevFocusedIndex]);
        var nextElement = $(focusableElements[currentFocusedIndex]);

        // If next element is in a the next flicity container make sure to switch page

        // prevElement.parents('ul').first().is(':last-child') && prevElement.parent('li').is(':last-child')

        if (flickity) {
            if (prevElement.parents('ul').first().index() !== 0 && prevElement.parents('ul').first().is(':last-child') && prevElement.parent('li').is(':last-child')) {
                flickity.flickity('next', true);
            } else if (nextElement.parents('ul').first().index() !== 0 && nextElement.parents('ul').first().hasClass('list-section-places') && nextElement.parent('li').index() === 0) {
                flickity.flickity('next', true);
            }
        }

        nextElement.focus();

        $('#center-button-select').show();
        $('#center-button').hide();
    };

    /**
     * Focus on previous tabindex
     * @return {void}
     */
    browseUi.prototype.focusPrev = function () {
        var prevFocusedIndex = currentFocusedIndex;
        currentFocusedIndex--;

        if (currentFocusedIndex < 0) {
            prevFocusedIndex = 0;
            currentFocusedIndex = focusableElements.length-1;
        }

        var prevElement = $(focusableElements[prevFocusedIndex]);
        var nextElement = $(focusableElements[currentFocusedIndex]);

        // If next element is in a the next flicity container make sure to switch page
        if (flickity) {
            if (nextElement.parents('ul').first().hasClass('list-section-places') && prevElement.parent('li').index() === 0) {
                flickity.flickity('previous', true);
            }
        }

        nextElement.focus();

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

        $(document).on('mouseenter.joystick-hover', '[tabindex]:not([tabindex="-1"]):not([tabindex="0"]):not(.event-item-open)', function (e) {
            this.resetFocus();
        }.bind(this));

        $('#center-button-select').on('click', function (e) {
            e.preventDefault();

            $(focusableElements[currentFocusedIndex]).trigger('click');

            if ($(focusableElements[currentFocusedIndex]).is('a') && $(focusableElements[currentFocusedIndex]).attr('href') != '#') {
                location.href = $(focusableElements[currentFocusedIndex]).attr('href');
            }
        });
    };

    return new browseUi();

})(jQuery);