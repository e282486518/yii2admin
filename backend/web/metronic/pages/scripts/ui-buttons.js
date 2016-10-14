var UIButtons = function () {

    var handleButtons = function () {
        $('.demo-loading-btn').click(function () {
            var btn = $(this)
            btn.button('loading')
            setTimeout(function () {
                btn.button('reset')
            }, 3000)
        });

        Ladda.bind( '.mt-ladda-btn', { timeout: 2000 } );
        Ladda.bind( '.mt-ladda-btn.mt-progress-demo ', {
                callback: function( instance ) {
                    var progress = 0;
                    var interval = setInterval( function() {
                        progress = Math.min( progress + Math.random() * 0.1, 1 );
                        instance.setProgress( progress );

                        if( progress === 1 ) {
                            instance.stop();
                            clearInterval( interval );
                        }
                    }, 200 );
                }
            } );
    }

    return {
        //main function to initiate the module
        init: function () {
            handleButtons();
        }

    };

}();

jQuery(document).ready(function() {    
   UIButtons.init();
});