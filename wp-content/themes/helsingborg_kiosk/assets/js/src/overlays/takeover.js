HbgKiosk = HbgKiosk || {};
HbgKiosk.Overlays = HbgKiosk.Overlays || {};

HbgKiosk.Overlays.Takeover = (function ($) {

    var takeoverSelector = '#takeover';
    var timer = null;

    function Takeover() {
        $(function(){

            if (typeof takeovers === 'object') {
                this.init();
            }

        }.bind(this));
    }

    /**
     * Initialize the takeover timer
     * @return {void}
     */
    Takeover.prototype.init = function () {
        timer = setInterval(function () {
            this.run();
        }.bind(this), 1000);
    };

    /**
     * Check for takeover to display
     * @return {void}
     */
    Takeover.prototype.run = function () {
        $.each(takeovers, function (index, item) {
            var current_date = new Date();

            var date = item.takeover_date.split('-');
            var time = item.takeover_time.split(':');

            var dateParts = {
                year: parseInt(date[0]),
                month: parseInt(date[1])-1,
                day: parseInt(date[2]),
                hours: parseInt(time[0]),
                minutes: parseInt(time[1])
            };

            var takeover_datetime = new Date(dateParts.year, dateParts.month, dateParts.day, dateParts.hours, dateParts.minutes);

            if (current_date > takeover_datetime) {
                if (!this.isPlayed(item.takeover_id)) {
                    this.show(item);
                    clearInterval(timer);
                    return false;
                }
            }
        }.bind(this));
    };

    /**
     * Show the takeover with specified media element and text
     * @param  {object} item The item to show
     * @return {void}
     */
    Takeover.prototype.show = function (item) {
        var element = null;

        // Create takeover element
        switch (item.takeover_media.type) {
            case 'video':
                element = '<video id="takeover-video" width="1080" height="1920" autoplay><source src="' + item.takeover_media.url + '" type="' + item.takeover_media.mime_type + '"></video>';
                break;

            case 'image':
                element = '<img width="1080" height="1920" src="' + item.takeover_media.url + '">';
                break;
        }

        // Fade in takeover
        $(takeoverSelector).html(element).fadeIn();

        // What to do when video is done playing
        if (item.takeover_media.type === 'video') {
            var video = document.getElementById('takeover-video');

            video.onended = function (e) {
                 $(takeoverSelector).html('').fadeOut();
            };
        } else {
            setTimeout(function () {
                this.hide();
            }.bind(this), item.takeover_timeout);
        }

        this.setPlayed(item.takeover_id);
    };

    /**
     * Hide takeover and restart the timer
     * @return {void}
     */
    Takeover.prototype.hide = function () {
        $(takeoverSelector).html('').fadeOut();

        timer = setInterval(function () {
            this.run();
        }.bind(this), 1000);
    };

    /**
     * Set takeover as played (stored in html5 localstorage)
     * @param {string} id The takeover unuique id
     */
    Takeover.prototype.setPlayed = function (id) {
        var played = localStorage.getItem('takeoverPlayed');

        if (played !== null) {
            played = played.split(',');

            if (played.indexOf(id) == -1) {
                played.push(id);
            }
        } else {
            played = new Array(id);
        }

        played.join(',');
        localStorage.setItem('takeoverPlayed', played);
    };

    /**
     * Check if takeover already is played
     * @param  {string}  id Takeover unique id
     * @return {void}
     */
    Takeover.prototype.isPlayed = function (id) {
        var played = localStorage.getItem('takeoverPlayed');

        if (played === null) {
            return false;
        } else {
            if (played.indexOf(id) > -1) {
                return true;
            }
        }

        return false;
    };

    /**
     * Empty/remove the html5 localstorage is played data
     * @return {string) just confirms the deletion
     */
    Takeover.prototype.reset = function () {
        localStorage.removeItem('takeoverPlayed');
        return "Localstorage for played takeovers is now emptied";
    };

    return new Takeover();

})(jQuery);