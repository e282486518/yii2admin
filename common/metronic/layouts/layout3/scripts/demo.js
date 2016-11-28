/**
Demo script to handle the theme demo
**/

var Demo = function () {

    // Handle Theme Settings
    var handleTheme = function () {

        var panel = $('.theme-panel');

        if ($('.page-head > .container-fluid').size() === 1) {
            $('.theme-setting-layout', panel).val("fluid");
        } else {
            $('.theme-setting-layout', panel).val("boxed");
        }

        if ($('.top-menu li.dropdown.dropdown-dark').size() > 0) {
            $('.theme-setting-top-menu-style', panel).val("dark");
        } else {
            $('.theme-setting-top-menu-style', panel).val("light");
        }

        if ($('body').hasClass("page-header-top-fixed")) {
            $('.theme-setting-top-menu-mode', panel).val("fixed");
        } else {
            $('.theme-setting-top-menu-mode', panel).val("not-fixed");
        }

        if ($('.hor-menu.hor-menu-light').size() > 0) {
            $('.theme-setting-mega-menu-style', panel).val("light");
        } else {
            $('.theme-setting-mega-menu-style', panel).val("dark");
        }

        if ($('body').hasClass("page-header-menu-fixed")) {
            $('.theme-setting-mega-menu-mode', panel).val("fixed");
        } else {
            $('.theme-setting-mega-menu-mode', panel).val("not-fixed");
        }

        //handle theme layout
        var resetLayout = function () {
            $("body").
            removeClass("page-header-top-fixed").
            removeClass("page-header-menu-fixed");

            $('.page-header-top > .container-fluid').removeClass("container-fluid").addClass('container');
            $('.page-header-menu > .container-fluid').removeClass("container-fluid").addClass('container');
            $('.page-head > .container-fluid').removeClass("container-fluid").addClass('container');
            $('.page-content > .container-fluid').removeClass("container-fluid").addClass('container');
            $('.page-prefooter > .container-fluid').removeClass("container-fluid").addClass('container');
            $('.page-footer > .container-fluid').removeClass("container-fluid").addClass('container');              
        };

        var setLayout = function () {

            var layoutMode = $('.theme-setting-layout', panel).val();
            var headerTopMenuStyle = $('.theme-setting-top-menu-style', panel).val();
            var headerTopMenuMode = $('.theme-setting-top-menu-mode', panel).val();
            var headerMegaMenuStyle = $('.theme-setting-mega-menu-style', panel).val();
            var headerMegaMenuMode = $('.theme-setting-mega-menu-mode', panel).val();
            
            resetLayout(); // reset layout to default state

            if (layoutMode === "fluid") {
                $('.page-header-top > .container').removeClass("container").addClass('container-fluid');
                $('.page-header-menu > .container').removeClass("container").addClass('container-fluid');
                $('.page-head > .container').removeClass("container").addClass('container-fluid');
                $('.page-content > .container').removeClass("container").addClass('container-fluid');
                $('.page-prefooter > .container').removeClass("container").addClass('container-fluid');
                $('.page-footer > .container').removeClass("container").addClass('container-fluid');

                //App.runResizeHandlers();
            }

            if (headerTopMenuStyle === 'dark') {
                $(".top-menu > .navbar-nav > li.dropdown").addClass("dropdown-dark");
            } else {
                $(".top-menu > .navbar-nav > li.dropdown").removeClass("dropdown-dark");
            }

            if (headerTopMenuMode === 'fixed') {
                $("body").addClass("page-header-top-fixed");
            } else {
                $("body").removeClass("page-header-top-fixed");
            }

            if (headerMegaMenuStyle === 'light') {
                $(".hor-menu").addClass("hor-menu-light");
            } else {
                $(".hor-menu").removeClass("hor-menu-light");
            }

            if (headerMegaMenuMode === 'fixed') {
                $("body").addClass("page-header-menu-fixed");
            } else {
                $("body").removeClass("page-header-menu-fixed");
            }          
        };

        // handle theme colors
        var setColor = function (color) {
            var color_ = (App.isRTL() ? color + '-rtl' : color);
            $('#style_color').attr("href", Layout.getLayoutCssPath() + 'themes/' + color_ + ".min.css");
            $('.page-logo img').attr("src", Layout.getLayoutImgPath() + 'logo-' + color + '.png');
        };

        $('.theme-colors > li', panel).click(function () {
            var color = $(this).attr("data-theme");
            setColor(color);
            $('.theme-colors > li', panel).removeClass("active");
            $(this).addClass("active");
        });

        $('.theme-setting-top-menu-mode', panel).change(function(){
            var headerTopMenuMode = $('.theme-setting-top-menu-mode', panel).val();
            var headerMegaMenuMode = $('.theme-setting-mega-menu-mode', panel).val();            

            if (headerMegaMenuMode === "fixed") {
                alert("The top menu and mega menu can not be fixed at the same time.");
                $('.theme-setting-mega-menu-mode', panel).val("not-fixed");   
                headerTopMenuMode = 'not-fixed';
            }                
        });

        $('.theme-setting-mega-menu-mode', panel).change(function(){
            var headerTopMenuMode = $('.theme-setting-top-menu-mode', panel).val();
            var headerMegaMenuMode = $('.theme-setting-mega-menu-mode', panel).val();            

            if (headerTopMenuMode === "fixed") {
                alert("The top menu and mega menu can not be fixed at the same time.");
                $('.theme-setting-top-menu-mode', panel).val("not-fixed");   
                headerTopMenuMode = 'not-fixed';
            }                
        });

        $('.theme-setting', panel).change(setLayout);
    };

    // handle theme style
    var setThemeStyle = function(style) {
        var file = (style === 'rounded' ? 'components-rounded' : 'components');
        file = (App.isRTL() ? file + '-rtl' : file);

        $('#style_components').attr("href", App.getGlobalCssPath() + file + ".min.css");

        if (typeof Cookies !== "undefined") {
            Cookies.set('layout-style-option', style);
        }
    };

    return {

        //main function to initiate the theme
        init: function() {
            // handles style customer tool
            handleTheme();

            // handle layout style change
            $('.theme-panel .theme-setting-style').change(function() {
                 setThemeStyle($(this).val());
            });

            // set layout style from cookie
            if (typeof Cookies !== "undefined" && Cookies.get('layout-style-option') === 'rounded') {
                setThemeStyle(Cookies.get('layout-style-option'));
                $('.theme-panel .layout-style-option').val(Cookies.get('layout-style-option'));
            }             
        }
    };

}();

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {   
        Demo.init();
    });
} 