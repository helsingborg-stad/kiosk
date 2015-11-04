var Helsingborg;

// Gallery settings
var gallery_image_per_row = 2;
var gallery_use_masonry = false;

jQuery(document).ready(function ($) {

    $('html').removeClass('no-js');

    $('.nav-mobilemenu, .navbar-mainmenu').find('a:hidden').attr('disabled', 'disabled').addClass('auto-disabled');
    $(window).on('resize', function (e) {
        $('.nav-mobilemenu, .navbar-mainmenu').find('a.auto-disabled').removeAttr('disabled').removeClass('auto-disabled');
        $('.nav-mobilemenu, .navbar-mainmenu').find('a:hidden').attr('disabled', 'disabled').addClass('auto-disabled');
    });

    /**
     * Initializes Foundation JS with necessary plugins:
     * Equalizer
     */
    $(document).foundation({
        equalizer: {
            equalize_on_stack: true
        },
        orbit: {
            slide_number_text: 'av',
            navigation_arrows: false
        }
    });

    /**
     * Append navigation buttons to orbit
     */
    $(document).on("ready.fndtn.orbit", function(e) {
        $('.orbit-container').append('<div class="orbit-navigation"><button class="orbit-prev" aria-label="Visa föregående bild"><i class="fa fa-chevron-circle-left"></i> Föregående</button><button class="orbit-next" aria-label="Visa nästa bild">Nästa <i class="fa fa-chevron-circle-right"></i></button></div>');
    });

    /**
     * Get disturbances
     */
    jQuery.post(ajaxurl, { action: 'big_notification' }, function(response) {
        if (response) {
            response = JSON.parse(response);
            $.each(response, function (index, item) {
                var message = '<a href="' + item.link + '">' + item.title + '</a>';
                Helsingborg.Prompt.Alert.show(item.class, message);
            });
        }
    });

    /**
     * Table list
     */
    if ($('.table-list').length > 0) {
        $('.table-list').delegate('tbody tr.table-item','click', function(){
            if(!$(this).is('.active')) {
                $('.table-item').removeClass('active');
                $('.table-content').removeClass('open');
                $(this).addClass('active');
                $(this).next('.table-content').addClass('open');
            } else if($(this).hasClass('active')) {
                $(this).toggleClass('active');
                $(this).next('.table-content').removeClass('open');
            }
        });
    }

    if (typeof is_front_page !== 'undefined') {
        var mobile_menu_offset = $('.nav-mainmenu-container').offset().top;
        if ($('body').find('#wpadminbar').length) mobile_menu_offset = mobile_menu_offset - 32;

        $(window).on('scroll', function (e) {
            if ($(window).scrollTop() >= mobile_menu_offset) {
                $('.nav-mainmenu-container, body').addClass('nav-fixed');
                if ($('body').find('#wpadminbar').length) $('.nav-mainmenu-container.nav-fixed').css('top', '32px');
            } else {
                if ($('body').find('#wpadminbar').length) $('.nav-mainmenu-container.nav-fixed').css('top', '0');
                $('.nav-mainmenu-container, body').removeClass('nav-fixed');
            }
        });
    }
   
    $('.mobile-menu-wrapper').find('input, button').attr('tabindex', '-1');

    $('[data-tooltip*="click"]').on('click', function (e) {
        if ($(e.target).is('[data-tooltip-toggle]')) {
            e.preventDefault();
            $(this).find('.tooltip').toggle().find('textarea:first').focus();
        }
    });

    $('[class^="sidebar"] .widget_text').append('<div class="stripe"><div></div><div></div><div></div><div></div><div></div></div>');

});
(function (server, psID) {
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.src = server + '/' + psID + '/ps.js';
    document.getElementsByTagName('head')[0].appendChild(s);
}('https://account.psplugin.com', '331F5271-4B0B-4625-BF08-4157F101DBFF'));
Helsingborg = Helsingborg || {};
Helsingborg.Client = Helsingborg.Client || {};

Helsingborg.Client.Browser = (function ($) {

    var browser = null;

    var userAgent = navigator.userAgent;

    function Browser() {
        $(function(){

            this.detect();
            this.addBodyClass();

        }.bind(this));
    }

    Browser.prototype.detect = function () {
        $.each(_browserData, function (index, item) {
            if (userAgent.indexOf(item.string) > -1) {
                browser = item.identity;
                return false;
            }
        }.bind(this))
    }

    Browser.prototype.addBodyClass = function () {
        $('body').addClass('browser-' + browser);
    }

    var _browserData = [
        {string: 'Edge', identity: 'ms-edge'},
        {string: 'Chrome', identity: 'chrome'},
        {string: 'MSIE', identity: 'explorer'},
        {string: 'Trident', identity: 'trident'},
        {string: 'Firefox', identity: 'firefox'},
        {string: 'Safari', identity: 'safari'},
        {string: 'Opera', identity: 'opera'}
    ];

    return new Browser();

})(jQuery);

/*
var BrowserDetect = {
        init: function () {
            this.browser = this.searchString(this.dataBrowser) || "Other";
            this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "Unknown";
        },
        searchString: function (data) {
            for (var i = 0; i < data.length; i++) {
                var dataString = data[i].string;
                this.versionSearchString = data[i].subString;

                if (dataString.indexOf(data[i].subString) !== -1) {
                    return data[i].identity;
                }
            }
        },
        searchVersion: function (dataString) {
            var index = dataString.indexOf(this.versionSearchString);
            if (index === -1) {
                return;
            }

            var rv = dataString.indexOf("rv:");
            if (this.versionSearchString === "Trident" && rv !== -1) {
                return parseFloat(dataString.substring(rv + 3));
            } else {
                return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
            }
        },

        dataBrowser: [
            {string: navigator.userAgent, subString: "Edge", identity: "MS Edge"},
            {string: navigator.userAgent, subString: "Chrome", identity: "Chrome"},
            {string: navigator.userAgent, subString: "MSIE", identity: "Explorer"},
            {string: navigator.userAgent, subString: "Trident", identity: "Explorer"},
            {string: navigator.userAgent, subString: "Firefox", identity: "Firefox"},
            {string: navigator.userAgent, subString: "Safari", identity: "Safari"},
            {string: navigator.userAgent, subString: "Opera", identity: "Opera"}
        ]

    };
    
    BrowserDetect.init();
    document.write("You are using <b>" + BrowserDetect.browser + "</b> with version <b>" + BrowserDetect.version + "</b>");
    */
Helsingborg = Helsingborg || {};
Helsingborg.Client = Helsingborg.Client || {};

Helsingborg.Client.Lazyload = (function ($) {

    function Lazyload() {
        $(function(){

            if (typeof lazyloadImages != 'undefined') this.handleEvents();

        }.bind(this));
    }

    Lazyload.prototype.loadImage = function (el) {
        var imageToLoad = $(el).data('lazyload');
        $(el).attr('src', imageToLoad).removeAttr('data-lazyload');
    }

    Lazyload.prototype.isInViewport = function (el) {

        el = $(el)[0];

        var rect = el.getBoundingClientRect();

        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /*or $(window).height() */
            rect.right <= (window.innerWidth || document.documentElement.clientWidth) /*or $(window).width() */
        );
    }

    Lazyload.prototype.handleEvents = function () {
        
        $(window).on('scroll, load', function (e) {

            $('[data-lazyload]').each(function (index, element) {
                this.loadImage(element);
            }.bind(this));

        }.bind(this));

    }

    return new Lazyload();

})(jQuery);
Helsingborg = Helsingborg || {};
Helsingborg.Event = Helsingborg.Event || {};

Helsingborg.Event.List = (function ($) {

    var events = {};
    var options = {};

    function List() {
        $(function(){

            // Find and loop all event-lists on the page
            $('[data-event-list]').each(function (index, element) {
                this.init(element)
            }.bind(this));

        }.bind(this));
    }

    /**
     * Initialize event calendar on element
     * @param  {string} element The element
     * @return {void}
     */
    List.prototype.init = function(element) {
        this.options = this.getOptions(element);
        this.getEvents(element);
        this.handleClickEvent(element);
    }

    List.prototype.handleClickEvent = function(element) {
        $(document).on('click', '.event-item:not(.featured)', function(e) {
            e.preventDefault();
            var $modal = $('#eventModal');

            $('#event-times').show();
            $('#event-organizers').hide();
            $('.event-times-loading').show();
            $('.event-times-item').remove();

            // Find the clicked event
            var clickedEventID = $(e.target).closest('.event-item').attr('id');
            var clickedEvent;
            for (var i = 0; i < this.events.length; i++) {
                if (this.events[i].EventID === clickedEventID) {
                    clickedEvent = this.events[i];
                    break;
                }
            }

            // Get event times
            var dates_data = {
                action: 'load_event_dates',
                id: clickedEventID,
                location: clickedEvent.Location
            };

            $.post(ajaxurl, dates_data, function(response) {
                html = "";
                var dates = JSON.parse(response);

                for (var i=0;i<dates.length;i++) {
                    html += '<li class="event-times-item">';
                    html += '<span class="event-date"><i class="fa fa-clock-o"></i> ' + dates[i].Date;
                    if (dates[i].Time) html += ' kl. ' + dates[i].Time;
                    html += '</span><span class="event-location">' + dates_data.location + '</span>';
                    html += '</li>';
                }

                $('#time-modal').prepend(html);
                $('.event-times-loading').hide();

                if (dates.length == 0) {
                    $('#event-times').hide();
                }
            });

            // Organizers
            var organizers_data = {
                action: 'load_event_organizers',
                id: clickedEventID
            };

            $.post(ajaxurl, organizers_data, function(response) {
                var organizers = JSON.parse(response); html = '';

                for (var i=0;i<organizers.length;i++) {
                    html += '<li><span>' + organizers[i].Name + '</span></li>';
                }

                $('#organizer-modal').html(html);
                if (organizers.length > 0) {
                    $('event-organizers').show();
                } else {
                    $('event-organizers').hide();
                }
            });

            // Output information            
            if (clickedEvent.ImagePath != "") {
                $('.modal-image').attr('src', clickedEvent.ImagePath);
            } else {
                $('.modal-image').attr('src', '/wp-content/themes/This-is-Helsingborg/assets/images/event-placeholder.jpg');
            }

            if (clickedEvent.Link) {
                $('.modal-link').html('<a class="link-item" href="' + clickedEvent.Link + '" target="blank">' + clickedEvent.Link + '</a>').show();
            } else {
                jQuery('.modal-link').empty();
            }

            $('.modal-title').html(clickedEvent.Name);
            $('.modal-date').html(clickedEvent.Date);
            $('.modal-description').html(this.nl2br(clickedEvent.Description));
            $('.modal-ics a').attr('href', '?ics=' + clickedEvent.EventID);

        }.bind(this));
    }

    List.prototype.nl2br = function(str) {
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + '<br>' + '$2');
    }

    /**
     * Get and append calendar events
     * @param  {string} element The base element
     * @return {void}           Outputs the events to the calendar and saves them to the "this.events" variable
     */
    List.prototype.getEvents = function(element) {
        var data = {
            action: 'update_event_calendar',
            amount: this.options.ammount,
            ids: this.options.administrationIds
        };

        $.post(ajaxurl, data, function(response) {
            var $element = $(element);

            var obj = JSON.parse(response);
            this.events = obj.events;

            // Remove loading icon
            $element.find('.event-loading').remove();

            // Append calendar items
            if ($element.find('.event-list li:first').hasClass('event-item-featured')) {
                $element.find('.event-item-featured').after(obj.list);
            } else {
                $element.find('.event-list').prepend(obj.list);
            }

        }.bind(this));
    }

    /**
     * Get the options set in hte data-event-list html attribute
     * @param  {string} element The element to check for options in
     * @return {object}         The options
     */
    List.prototype.getOptions = function(element) {
        var options = $(element).data('event-list');
        options = options.replace(/'/g, "\"");
        return JSON.parse(options);
    }

    return new List();

})(jQuery);
Helsingborg = Helsingborg || {};
Helsingborg.Mobile = Helsingborg.Mobile || {};

Helsingborg.Mobile.Menu = (function ($) {

    var navHeight = 0;
    var animationSpeed = 100;

    function Menu() {
        $(function(){

            this.handleEvents();

        }.bind(this));
    }

    /**
     * Get the height of the navigation
     * @param  {object} element The navigation
     * @return {void}
     */
    Menu.prototype.getNavHeight = function(element) {
        navHeight = $('.mobile-menu-wrapper').height();
    }

    /**
     * Set default element style attributes
     * @return {void}
     */
    Menu.prototype.initialize = function() {
        $('.mobile-menu-wrapper').css({
            maxHeight: 0,
            position: 'relative',
            zIndex: 1
        });

        $('.mobile-menu-wrapper .stripe').css('height', navHeight + 'px');
    }

    /**
     * Toggles the mobile menu
     * @param  {void} element The reference element clicked
     * @return {void}
     */
    Menu.prototype.toggle = function(element) {
        element = $(element);
        element.closest('button').toggleClass('open');
        $('body').toggleClass('mobile-menu-in');

        if ($('body').hasClass('mobile-menu-in')) {
            this.show();
        } else {
            this.hide();
        }
    }

    /**
     * Shows the mobile menu
     * @return {void}
     */
    Menu.prototype.show = function() {
        $('.mobile-menu-wrapper').css('visibility', 'visible').animate({
            maxHeight: navHeight + 'px'
        }, animationSpeed);
    }

    /**
     * Hides the mobile menu
     * @return {void}
     */
    Menu.prototype.hide = function () {
        $('.mobile-menu-wrapper').css('visibility', 'visible').animate({
            maxHeight: 0 + 'px'
        }, animationSpeed);
    }

    /**
     * Keeps track of events
     * @return {void}
     */
    Menu.prototype.handleEvents = function() {

        $(document).ready(function () {
            $('.mobile-menu-wrapper').css('opacity', 1);
            this.getNavHeight();
            this.initialize();
        }.bind(this));

        $(document).on('click', '[data-action="toggle-mobile-menu"]', function (e) {
            e.preventDefault();
            this.toggle(e.target);
        }.bind(this));

    }

    return new Menu();

})(jQuery);
Helsingborg = Helsingborg || {};
Helsingborg.Prompt = Helsingborg.Prompt || {};

Helsingborg.Prompt.Alert = (function ($) {

    var _animationSpeed = 300;
    var _wrapperSelector = '[data-prompt-wrapper="alert"]';
    var _message = 'Alert';

    function Alert() {
        $(function(){

            this.handleEvents();

            // Show cookies alert if not accepted
            if (window.localStorage.getItem('accept-cookies') != 'true') {
                this.show('info',
                    'På helsingborg.se använder vi cookies (kakor) för att webbplatsen ska fungera på ett bra sätt för dig. Genom att klicka vidare godkänner du att vi använder cookies. <a href="http://www.helsingborg.se/startsida/toppmeny/om-webbplatsen/om-cookies-pa-webbplatsen/">Vad är cookies?</a>',
                    [
                        {
                            label: 'Jag godkänner',
                            class: 'btn-submit',
                            action: 'accept-cookies'
                        }
                    ]
                );
            }

        }.bind(this));
    }

    /**
     * Displays an alert
     * @param  {string} type    The class name of the alert
     * @param  {string} text    The text of the alert
     * @param  {object} buttons Buttons to place in the alert
     * @return {void}
     */
    Alert.prototype.show = function(type, text, buttons) {
        buttons = typeof buttons !== 'undefined' ? buttons : null;

        // Append alert container
        $('<div class="alert"><div class="container"><div class="row"></div></div></div>').prependTo(_wrapperSelector);

        // If we have a type set, append the class to the alert container
        if (type != null) {
            $(_wrapperSelector).find('.alert:first-child').addClass('alert-' + type);
        }

        // Add alert text
        $(_wrapperSelector).find('.alert:first-child .row').append('<div class="columns large-9 medium-9">' + text + '</div>');

        // Add alert button contaioner
        $(_wrapperSelector).find('.alert:first-child .row').append('<div class="buttons columns large-3 medium-3"></div>');

        // Add close button or add defined buttons
        if (buttons == null) {
            $(_wrapperSelector).find('.alert:first-child .columns:last-child').append('<button class="btn btn-alert-close" data-action="alert-close"><i class="fa fa-times"></i></button>');
        } else {
            $.each(buttons, function (index, item) {
                $(_wrapperSelector).find('.alert:first-child .columns:last-child').append('<button class="btn ' + item.class +'" data-action="' + item.action + '">' + item.label + '</button>')
            });
        }

        $(_wrapperSelector).find('.alert:first-child').slideDown(_animationSpeed);
    }

    /**
     * Accept use of cookies (store answer in html5localstorage)
     * @return {string} Success message
     */
    Alert.prototype.acceptCookies = function() {
        try {
            window.localStorage.setItem('accept-cookies', true);
            return true;
        } catch(e) {
            return false;
        }
    }

    /**
     * Clear the saved "acceptCookies" value from html5localstorage
     * To clear from JS Console: Helsingborg.Prompt.Alert.clearAcceptCookies();
     * @return {string} Success message
     */
    Alert.prototype.clearAcceptCookies = function() {
        try {
            window.localStorage.removeItem('accept-cookies');
            return true;
        } catch(e) {
            return false;
        }
    }

    /**
     * Hides and removes a specific alert
     * @param  {object} element The element to hide/remove
     * @return {void}
     */
    Alert.prototype.hide = function(element) {
        $(element).closest('.alert').slideUp(_animationSpeed,   function() {
            $(this).remove();
        });
    }

    /**
     * Keeps track of events
     * @return {void}
     */
    Alert.prototype.handleEvents = function() {

        $(document).on('click', '[data-action="alert-close"]', function (e) {
            this.hide(e.target);
        }.bind(this));

        $(document).on('click', '[data-action="accept-cookies"]', function (e) {
            this.acceptCookies();
            this.hide(e.target);
        }.bind(this));

    }

    return new Alert();

})(jQuery);
Helsingborg = Helsingborg || {};
Helsingborg.Prompt = Helsingborg.Prompt || {};

Helsingborg.Prompt.Modal = (function ($) {

    var fadeSpeed = 300;
    var openingElement = null;

    function Modal() {
        $(function(){

            this.handleEvents();

        }.bind(this));
    }

    /**
     * Opens a modal window
     * @param  {object} element Link item clicked
     * @return {void}
     */
    Modal.prototype.open = function(element) {
        this.openingElement = element;
        var targetElement = $(element).closest('[data-reveal]').data('reveal');
        $('#' + targetElement).fadeIn(fadeSpeed);
        this.forceModalFocus(targetElement);
        this.disableBodyScroll();
    }

    /**
     * Handle first tab if modal window is open
     * @param  {string} e The element
     * @return {void}
     */
    Modal.prototype.forceModalFocus = function (targetElement) {
        $('body').on('keydown.foceModalFocus', function (e) {
            if (e.keyCode == 9) {
                e.preventDefault();
                $('.modal-close').focus();
                $('body').off('keydown.foceModalFocus');
            }
        });

        $('#' + targetElement).find('a').last().on('keydown.forceModalFocus2', function (e) {
            if (e.keyCode == 9) {
                e.preventDefault();
                $('.modal-close').focus();
            }
        });
    }

    /**
     * Closes a modal window
     * @param  {object} element Link item clicked
     * @return {void}
     */
    Modal.prototype.close = function(element) {
        $(element).closest('.modal').fadeOut(fadeSpeed);
        $(element).closest('.modal').find('a').last().off('keydown.forceModalFocus2');
        $('body').off('keydown.foceModalFocus');
        this.enableBodyScroll();
        $(this.openingElement).closest('a').focus();
    }

    /**
     * Disables scroll on body
     * @return {void}
     */
    Modal.prototype.disableBodyScroll = function() {
        $('body').addClass('no-scroll');
    }

    /**
     * Enables scroll on body
     * @return {void}
     */
    Modal.prototype.enableBodyScroll = function() {
        $('body').removeClass('no-scroll');
    }

    /**
     * Keeps track of events
     * @return {void}
     */
    Modal.prototype.handleEvents = function() {

        // Open modal
        $(document).on('click', '[data-reveal]', function (e) {
            e.preventDefault();
            this.open(e.target);
        }.bind(this));

        // Close modal
        $(document).on('click', '[data-action="modal-close"]', function (e) {
            e.preventDefault();
            this.close(e.target);
        }.bind(this));

    }

    return new Modal();

})(jQuery);
Helsingborg = Helsingborg || {};
Helsingborg.Prompt = Helsingborg.Prompt || {};

Helsingborg.Prompt.Button = (function ($) {

    function Button() {
        $(function(){

            this.handleEvents();

        }.bind(this));
    }

    Button.prototype.openPopup = function(element) {
        // Width and height of the popup
        var width = 626;
        var height = 305;

        // Gets the href from the button/link
        var url = $(element).closest('a').attr('href');

        // Calculate popup position
        var leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
        var topPosition = (window.screen.height / 2) - ((height / 2) + 50);

        // Popup window features
        var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=no,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";

        // Open popup
        window.open(url, 'Share', windowFeatures);
    }

    /**
     * Keeps track of events
     * @return {void}
     */
    Button.prototype.handleEvents = function() {

        $(document).on('click', '[data-action="share-popup"]', function (e) {
            e.preventDefault();
            this.openPopup(e.target);
        }.bind(this));

    }

    return new Button();

})(jQuery);
Helsingborg = Helsingborg || {};
Helsingborg.Search = Helsingborg.Search || {};

Helsingborg.Search.Autocomplete = (function ($) {

    var typingTimer;
    var doneTypingInterval = 1000;

    function Autocomplete() {
        $(function(){

            this.handleEvents();

        }.bind(this));
    }

    /**
     * Performs an ajax post to retrive matching pages
     * @param  {string} searchString The search string
     * @param  {string} element      Element selector
     * @return {void}
     */
    Autocomplete.prototype.search = function(searchString, element) {
        if (searchString.length >= 3) {
            $(element).parents('.form-element').find('.hbg-loading').show();

            jQuery.post(
                ajaxurl,
                {
                    action: 'search',
                    keyword: searchString,
                    index:   '1'
                },
                function(response) {
                    response = JSON.parse(response);

                    if (response.items !== undefined) {
                        var autocomplete = $(element).siblings('ul.autocomplete');
                        autocomplete.empty();
                        autocomplete.append('<li class="heading">Utvalda resultat (klicka på "sök" för alla resultat):</li>');

                        $.each(response.items, function (index, item) {
                            var snippet = $.trim(item.htmlSnippet);

                            autocomplete.append('<li>\
                                <a href="' + item.link + '">\
                                    <strong class="link-item">' + item.htmlTitle + '</strong>\
                                    <p>' + snippet + '</p>\
                                </a>\
                            </li>');

                            if (index >= 5) return false;
                        });

                        this.show(element);
                    }

                    $(element).parents('.form-element').find('.hbg-loading').hide();
                }.bind(this)
            );
        } else {
            this.hide(element);
        }
    }

    /**
     * Hides the autocomplete container
     * @param  {string} element Element selector
     * @return {void}
     */
    Autocomplete.prototype.hide = function(element) {
        $(element).siblings('ul.autocomplete').hide();
    }

    /**
     * Shows the autocomplete container
     * @param  {string} element Element selector
     * @return {void}
     */
    Autocomplete.prototype.show = function(element) {
        $(element).siblings('ul.autocomplete').show();
    }

    /**
     * Handles highlighting "next"
     * @param  {string} element Element selecotr
     * @return {void}
     */
    Autocomplete.prototype.arrowNext = function(element) {
        var autocomplete = $(element).siblings('ul.autocomplete');
        var selected = autocomplete.find('li.selected');

        if (selected.length) {
            var next = selected.next('li:not(.heading)');
            selected.removeClass('selected');
            next.addClass('selected');
        } else {
            autocomplete.find('li:nth-child(2)').addClass('selected');
        }
    }

    /**
     * Handles highlighting "prev"
     * @param  {string} element Element selector
     * @return {void}
     */
    Autocomplete.prototype.arrowPrev = function(element) {
        var autocomplete = $(element).siblings('ul.autocomplete');
        var selected = autocomplete.find('li.selected');

        if (selected.length) {
            var next = selected.prev('li:not(.heading)');
            selected.removeClass('selected');
            next.addClass('selected');
        } else {
            autocomplete.find('li:not(.heading):last-child').addClass('selected');
        }
    }

    /**
     * Keeps track of events
     * @return {void}
     */
    Autocomplete.prototype.handleEvents = function() {

        $(document).on('input', '[data-autocomplete="pages"]', function (e) {
            if ($(e.target).parents('.mobile-menu-wrapper').length == 0) {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(function () {
                    var val = $(e.target).closest('input').val();
                    this.search(val, e.target);
                }.bind(this), doneTypingInterval);
            }
        }.bind(this));

        $(document).on('blur', '[data-autocomplete="pages"]', function (e) {
            this.hide(e.target);
        }.bind(this));

        $(document).on('focus', '[data-autocomplete="pages"]', function (e) {
            this.show(e.target);
        }.bind(this));

        $(document).on('keydown', function (e) {
            if ($(e.target).data('autocomplete')) {
                switch (e.which) {
                    case 38 : // Up
                        e.preventDefault();
                        this.arrowPrev(e.target);
                        break;

                    case 40 : // Down
                        e.preventDefault();
                        this.arrowNext(e.target);
                        break;

                    case 13 : // Enter/return
                        if ($(e.target).closest('input').siblings('ul.autocomplete').find('li.selected a').length) {
                            e.preventDefault();
                            location.href = $(e.target).closest('input').siblings('ul.autocomplete').find('li.selected a').attr('href');
                        } else {
                            return true;
                        }
                        break;
                }
            }
        }.bind(this));

        $(document).on('mouseenter', '.autocomplete li:not(.heading)', function (e) {
            $(this).siblings('.selected').removeClass('selected');
        });

        $(document).on('mousedown', '.autocomplete li a', function (e) {
            e.preventDefault();
            location.href = $(e.target).closest('a').attr('href');;
        });

    }

    return new Autocomplete();

})(jQuery);





Helsingborg.Search.Button = (function ($) {

    function Button() {
        $(function(){

            this.handleEvents();

        }.bind(this));
    }

    /**
     * Keeps track of events
     * @return {void}
     */
    Button.prototype.handleEvents = function() {

        $(document).on('click', '.search .btn-submit', function (e) {
            if ($(this).parents('.hero').length || $(this).parents('.site-header').length) {
                $(this).html('<i class="dots-loading dots-loading-sm"></i>');
            } else {
                $(this).html('<i class="dots-loading"></i>');
            }
        });

    }

    return new Button();

})(jQuery);
Helsingborg = Helsingborg || {};
Helsingborg.TableList = Helsingborg.TableList || {};

Helsingborg.TableList.Search = (function ($) {

    function Search() {
        $(function(){

            this.init();

        }.bind(this));
    }

    /**
     * Initializes table filtering
     * @return {void}
     */
    Search.prototype.init = function () {
        $('[data-filter-table]').each(function (index, element) {
            var input = $(element).find('input[data-filter-table-input]');
            var table = $(element).data('filter-table');
            var tableItem = $(element).data('filter-table-selector');

            input.on('keyup.filter-table', function (e) {
                var value = $(e.target).val();
                this.filterTable(value, table, tableItem);
            }.bind(this));
        }.bind(this));
    }

    /**
     * Do the actual filtering with :contains
     * @param  {string} query     The search "query"
     * @param  {string} table     The table selector
     * @param  {string} tableItem The table item selector
     * @return {void}
     */
    Search.prototype.filterTable = function (query, table, tableItem) {
        if (query.length > 0) {
            $(table).find(tableItem).hide();
            $(table).find(tableItem + ':contains(' + query + ')').show();
        } else {
            $(table).find(tableItem).show();
        }
    }

    return new Search();

})(jQuery);

/**
 * Make :contains insensitive
 */
jQuery.expr[":"].contains = $.expr.createPseudo(function(arg) {
    return function( elem ) {
        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});
Helsingborg = Helsingborg || {};
Helsingborg.TableList = Helsingborg.TableList || {};

Helsingborg.TableList.Sorting = (function ($) {

    var items = null;

    function Sorting() {
        $(function(){

            this.handleEvents();

        }.bind(this));
    }

    /**
     * Get the items in the table
     * @param  {object} e The event
     * @return {array}    Array with all items
     */
    Sorting.prototype.getItems = function (e) {
        var items = $(e.target).parents('.table-list').find('tbody');
        return items;
    }

    /**
     * Sort the table
     * @param  {object} e The event
     * @return {void}
     */
    Sorting.prototype.sortTable = function (e) {
        var element = $(e.target);
        var items = this.getItems(e);
        var columnIndex = element.index();

        var order = (element.hasClass('sorting-asc')) ? 'desc' : 'asc';

        element.parents('.table-list').find('thead th').removeClass('sorting-asc sorting-desc');

        if (order == 'asc') {
            items.sort(function (a, b) {
                var a = $(a).find('.table-item td:nth-child(' + columnIndex + ')').text().toLowerCase();
                var b = $(b).find('.table-item td:nth-child(' + columnIndex + ')').text().toLowerCase();

                if (a < b) {
                    return -1;
                }
                else if (a > b) {
                    return 1;
                }
                else {
                    return 0;
                }
            });

            element.removeClass('sorting-desc').addClass('sorting-asc');
        } else if (order == 'desc') {
            items.sort(function (a, b) {
                var a = $(a).find('.table-item td:nth-child(' + columnIndex + ')').text().toLowerCase();
                var b = $(b).find('.table-item td:nth-child(' + columnIndex + ')').text().toLowerCase();

                if (a > b) {
                    return -1;
                }
                else if (a < b) {
                    return 1;
                }
                else {
                    return 0;
                }
            });

            element.removeClass('sorting-asc').addClass('sorting-desc');
        }

        this.outputItems(e, items);
    }

    /**
     * Outputs the table items in its new order
     * @param  {object} e     Event
     * @param  {array} items  The items
     * @return {void}
     */
    Sorting.prototype.outputItems = function(e, items) {
        var $table = $(e.target).parents('.table-list');
        $table.find('tbody').remove();
        $table.append(items);
    }

    Sorting.prototype.handleEvents = function() {
        $('.table-list thead th').on('click', function (e) {
            this.sortTable(e);
        }.bind(this));
    }

    return new Sorting();

})(jQuery);