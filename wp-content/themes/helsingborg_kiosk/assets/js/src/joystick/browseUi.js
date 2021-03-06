HbgKiosk = HbgKiosk || {};
HbgKiosk.Joystick = HbgKiosk.Joystick || {};

HbgKiosk.Joystick.browseUi = (function ($) {

    // Which data attribute to look after for the prev and next buttons
    // Example: "joystick" => data-joystick
    var dataAttr = 'joystick';

    var hasDragged = false;
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

        if (focusableElements.length > 0) {
            this.handleEvents();
        } else {
            $('[data-' + dataAttr + '="previous"], [data-' + dataAttr + '="next"]').hide();
        }
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
        if (hasDragged) {
            currentFocusedIndex--;
        }

        var prevFocusedIndex = currentFocusedIndex;
        currentFocusedIndex++;

        if (currentFocusedIndex > focusableElements.length-1) {
            prevFocusedIndex = focusableElements.length-1;
            currentFocusedIndex = 0;
        }

        var prevElement = $(focusableElements[prevFocusedIndex]);
        var nextElement = $(focusableElements[currentFocusedIndex]);

        if (flickity && !hasDragged && prevElement.parent('li').is(':last-child') && nextElement.parents('ul').first().hasClass('slider-page')) {
            flickity.flickity('next', true);
        }

         setTimeout(function () {
            nextElement.focus();
        }, 50);

        $('#center-button-select').show();
        $('#center-button').hide();

        hasDragged = false;
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
        if (flickity && !hasDragged && nextElement.parents('ul').first().hasClass('slider-page') && prevElement.parent('li').index() === 0) {
            flickity.flickity('previous', true);
        }

        if (hasDragged) {
            flickity.flickity('previous', true);
        }

        nextElement.focus();

        $('#center-button-select').show();
        $('#center-button').hide();

        hasDragged = false;
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

        if (flickity) {
            var index = $('.slider-page.is-selected li').first().find('[tabindex]:not([tabindex="-1"]):not([tabindex="0"]):not(.event-item-open)').attr('tabindex');
            hasDragged = true;
            currentFocusedIndex = index-1;
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

        // What to do if the user first uses the next/prev controls and then swipes with hand gestures
        if (flickity) {
            flickity.on('dragStart', function (e) {
                this.resetFocus();
            }.bind(this));

            flickity.on('dragEnd', function (e) {
                var index = $('.slider-page.is-selected li').first().find('[tabindex]:not([tabindex="-1"]):not([tabindex="0"]):not(.event-item-open)').attr('tabindex');
                hasDragged = true;
                currentFocusedIndex = index-2;
            }.bind(this));

            $(document).on('click', '.flickity-prev-next-button', function (e) {
                setTimeout(function () {
                    this.resetFocus();
                    hasDragged = true;
                }.bind(this), 50);
            }.bind(this));
        }
    };

    return new browseUi();

})(jQuery);
