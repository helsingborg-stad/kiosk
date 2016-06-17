HbgKiosk = HbgKiosk || {};
HbgKiosk.Instafeed = HbgKiosk.Instafeed || {};

HbgKiosk.Instafeed.Display = (function ($) {

    var targetWrapper = "";
    var animationTime = 12000;
    var numberOfPages = 3;
    var currentPage = 1;
    var itemsPerPage = 6;
    var fadeOutTime = 300;

    function Display() {
        targetWrapper = jQuery("#instagramList");
        targetWrapper.hide();
        localStorage.setItem("kioskLastInstagramResponse", "");
        $(function(){
            this.init();
            this.ajaxWorker();
            this.animationWorker();
        }.bind(this));
    }

    /**
    * Initialize stream worker
    * @return {void}
    */

    Display.prototype.ajaxWorker = function () {
        setInterval(function(){this.init()}.bind(this), (animationTime + fadeOutTime) * numberOfPages);
    };

    /**
    * Initialize animation worker
    * @return {void}
    */
    Display.prototype.animationWorker = function () {
        setInterval(function(){this.animateItems()}.bind(this), animationTime);
    };

    Display.prototype.animateItems = function () {

        targetWrapper.fadeOut(fadeOutTime,function(){

            //Remove animation class
            jQuery("li",targetWrapper).removeClass("isActiveObject");

            //Show wrapper
            targetWrapper.fadeIn(0);

            //Add animation class
            for (i = 1; i <= itemsPerPage; i++) {
                jQuery("li:nth-child(" + ( ((itemsPerPage*currentPage)-itemsPerPage) + i ) + ")",targetWrapper).addClass("isActiveObject");
            }

            //New page
            if(currentPage != numberOfPages) {
                currentPage++;
            } else {
                currentPage = 1;
            }
        }.bind(this));


    };

    /**
     * Initialize stream
     * @return {void}
     */
    Display.prototype.init = function () {
        if(targetWrapper.length) {
            jQuery.post(ajaxurl,{
                action: "get_instagram_feed",
                post_id: targetWrapper.attr('data-post-id')
            },function(response) {
                if( response = jQuery.parseJSON(response) ) {

                    //Check if new response
                    if(localStorage.getItem("kioskLastInstagramResponse") != response && response != 0) {

                        //Store to check if new later
                        localStorage.setItem("kioskLastInstagramResponse", response);

                        //Empty target
                        targetWrapper.fadeOut(100).empty();

                        //Add new objects
                        for (var index in response.data) {
                            var outputObject = this.createOutputObject(response.data[index]);
                            targetWrapper.append(outputObject);
                        }

                        //Animate
                        this.animateItems();

                        //Fade In
                        targetWrapper.fadeIn(1000);

                    }
                }
            }.bind(this));
        }
    };

    Display.prototype.createOutputObject = function (objectData) {

        if (objectData.type == "image") {
            var output = this.ImageTemplate();
        } else {
            var output = this.VideoTemplate();
        }

        //Likes
        output = output.replace("{{numberoflikes}}", objectData.likes.count);

        //Tags
        if(this.isEmpty(objectData.tags)) {
            output = output.replace("{{listoftags}}", "");
        } else {
            output = output.replace("{{listoftags}}", '<span class="text-holder">#' + objectData.tags.join(" #") + '</span><span class="blurred-bg" style="background-image: url({{imageurl}});"></span>');
        }

        if (objectData.type == "image") {
            output = output.replace(/{{imageurl}}/g, objectData.images.standard_resolution.url);
        } else {
            output = output.replace("{{videosource}}", objectData.videos.standard_resolution.url);
        }

        return output;
    };

    Display.prototype.ImageTemplate = function () {
        return '\
                <li class="grid-xs-6">\
                    <span class="instagram-item">\
                        <img class="item-image" alt="" src="{{imageurl}}"/>\
                        <span class="list-of-tags">{{listoftags}}</span>\
                        <span class="number-of-likes">{{numberoflikes}} <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ3MS43MDEgNDcxLjcwMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDcxLjcwMSA0NzEuNzAxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCI+CjxnPgoJPHBhdGggZD0iTTQzMy42MDEsNjcuMDAxYy0yNC43LTI0LjctNTcuNC0zOC4yLTkyLjMtMzguMnMtNjcuNywxMy42LTkyLjQsMzguM2wtMTIuOSwxMi45bC0xMy4xLTEzLjEgICBjLTI0LjctMjQuNy01Ny42LTM4LjQtOTIuNS0zOC40Yy0zNC44LDAtNjcuNiwxMy42LTkyLjIsMzguMmMtMjQuNywyNC43LTM4LjMsNTcuNS0zOC4yLDkyLjRjMCwzNC45LDEzLjcsNjcuNiwzOC40LDkyLjMgICBsMTg3LjgsMTg3LjhjMi42LDIuNiw2LjEsNCw5LjUsNGMzLjQsMCw2LjktMS4zLDkuNS0zLjlsMTg4LjItMTg3LjVjMjQuNy0yNC43LDM4LjMtNTcuNSwzOC4zLTkyLjQgICBDNDcxLjgwMSwxMjQuNTAxLDQ1OC4zMDEsOTEuNzAxLDQzMy42MDEsNjcuMDAxeiBNNDE0LjQwMSwyMzIuNzAxbC0xNzguNywxNzhsLTE3OC4zLTE3OC4zYy0xOS42LTE5LjYtMzAuNC00NS42LTMwLjQtNzMuMyAgIHMxMC43LTUzLjcsMzAuMy03My4yYzE5LjUtMTkuNSw0NS41LTMwLjMsNzMuMS0zMC4zYzI3LjcsMCw1My44LDEwLjgsNzMuNCwzMC40bDIyLjYsMjIuNmM1LjMsNS4zLDEzLjgsNS4zLDE5LjEsMGwyMi40LTIyLjQgICBjMTkuNi0xOS42LDQ1LjctMzAuNCw3My4zLTMwLjRjMjcuNiwwLDUzLjYsMTAuOCw3My4yLDMwLjNjMTkuNiwxOS42LDMwLjMsNDUuNiwzMC4zLDczLjMgICBDNDQ0LjgwMSwxODcuMTAxLDQzNC4wMDEsMjEzLjEwMSw0MTQuNDAxLDIzMi43MDF6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" /></span>\
                    </span>\
                </li>\
        ';
    };

    Display.prototype.VideoTemplate = function () {
        return '\
                <li class="grid-xs-6">\
                    <span class="instagram-item">\
                        <video src="{{videosource}}" autoplay loop muted></video>\
                        <span class="list-of-tags">{{listoftags}}</span>\
                        <span class="number-of-likes">{{numberoflikes}} <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ3MS43MDEgNDcxLjcwMSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgNDcxLjcwMSA0NzEuNzAxOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjY0cHgiIGhlaWdodD0iNjRweCI+CjxnPgoJPHBhdGggZD0iTTQzMy42MDEsNjcuMDAxYy0yNC43LTI0LjctNTcuNC0zOC4yLTkyLjMtMzguMnMtNjcuNywxMy42LTkyLjQsMzguM2wtMTIuOSwxMi45bC0xMy4xLTEzLjEgICBjLTI0LjctMjQuNy01Ny42LTM4LjQtOTIuNS0zOC40Yy0zNC44LDAtNjcuNiwxMy42LTkyLjIsMzguMmMtMjQuNywyNC43LTM4LjMsNTcuNS0zOC4yLDkyLjRjMCwzNC45LDEzLjcsNjcuNiwzOC40LDkyLjMgICBsMTg3LjgsMTg3LjhjMi42LDIuNiw2LjEsNCw5LjUsNGMzLjQsMCw2LjktMS4zLDkuNS0zLjlsMTg4LjItMTg3LjVjMjQuNy0yNC43LDM4LjMtNTcuNSwzOC4zLTkyLjQgICBDNDcxLjgwMSwxMjQuNTAxLDQ1OC4zMDEsOTEuNzAxLDQzMy42MDEsNjcuMDAxeiBNNDE0LjQwMSwyMzIuNzAxbC0xNzguNywxNzhsLTE3OC4zLTE3OC4zYy0xOS42LTE5LjYtMzAuNC00NS42LTMwLjQtNzMuMyAgIHMxMC43LTUzLjcsMzAuMy03My4yYzE5LjUtMTkuNSw0NS41LTMwLjMsNzMuMS0zMC4zYzI3LjcsMCw1My44LDEwLjgsNzMuNCwzMC40bDIyLjYsMjIuNmM1LjMsNS4zLDEzLjgsNS4zLDE5LjEsMGwyMi40LTIyLjQgICBjMTkuNi0xOS42LDQ1LjctMzAuNCw3My4zLTMwLjRjMjcuNiwwLDUzLjYsMTAuOCw3My4yLDMwLjNjMTkuNiwxOS42LDMwLjMsNDUuNiwzMC4zLDczLjMgICBDNDQ0LjgwMSwxODcuMTAxLDQzNC4wMDEsMjEzLjEwMSw0MTQuNDAxLDIzMi43MDF6IiBmaWxsPSIjRkZGRkZGIi8+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==" /></span>\
                    </span>\
                </li>\
        ';
    };

    Display.prototype.isEmpty = function (obj) {
        if (obj == null) return true;
        if (obj.length > 0)    return false;
        if (obj.length === 0)  return true;

        for (var key in obj) {
            if (hasOwnProperty.call(obj, key)) return false;
        }

        return true;
    };

    return new Display();

})(jQuery);
