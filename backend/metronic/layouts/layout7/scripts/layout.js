/**
Core script to handle the entire theme and core functions
**/
var Layout = function() {

    var layoutImgPath = 'layouts/layout7/img/';

    var layoutCssPath = 'layouts/layout7/css/';

    var resBreakpointMd = App.getResponsiveBreakpoint('md'); //992px
    var resBreakpointSm = App.getResponsiveBreakpoint('sm'); //768px

    // handle go to top button
    var handleGo2Top = function () {       
        var Go2TopOperation = function(){
            var CurrentWindowPosition = $(window).scrollTop();// current vertical position
            if (CurrentWindowPosition > 100) {
                $(".go2top").show();
            } else {
                $(".go2top").hide();
            }
        };

        Go2TopOperation();// call headerFix() when the page was loaded
        if (navigator.userAgent.match(/iPhone|iPad|iPod/i)) {
            $(window).bind("touchend touchcancel touchleave", function(e){
                Go2TopOperation();
            });
        } else {
            $(window).scroll(function() {
                Go2TopOperation();
            });
        }

        $(".go2top").click(function(e) {
            e.preventDefault();
            $("html, body").animate({ scrollTop: 0 }, 600);
        });
    };

    var handleMenu = function () {    
        var overlay = $('.menu-bg-overlay');
        var close = $('.menu-close');
        var trigger = $('.menu-trigger');
        var modal = $('.menu-overlay');

        trigger.click(function() {
            var removeModal = function() {
                modal.removeClass('menu-overlay-show');
            }

            modal.addClass('menu-overlay-show');
            overlay.off('click', removeModal);
            overlay.on('click', removeModal);
        });

        close.click(function(e) {
            e.stopPropagation();
            modal.removeClass('menu-overlay-show');
        });
    };

    return {

        // Main init methods to initialize the layout
        // IMPORTANT!!!: Do not modify the core handlers call order.

        init: function () { 
            handleGo2Top(); // handle go to top
            handleMenu(); // handle menu
        },

        getLayoutImgPath: function() {
            return App.getAssetsPath() + layoutImgPath;
        },

        getLayoutCssPath: function() {
            return App.getAssetsPath() + layoutCssPath;
        }
    };

}();

jQuery(document).ready(function() {    
   Layout.init(); // init metronic core componets
});