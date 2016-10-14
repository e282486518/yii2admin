var BootstrapTable = function () {

    var TableTransform = function () {
         var $table_transform = $('#table-transform');
        $('#transform').click(function () {
            $table_transform.bootstrapTable();
        });
        $('#destroy').click(function () {
            $table_transform.bootstrapTable('destroy');
        });
    }

    var TableStyle = function () {
        var $table_style = $('#table-style');
       // $table_style.bootstrapTable();

        $('#hover, #striped, #condensed').click(function () {
            var classes = 'table';

            if ($('#hover').prop('checked')) {
                classes += ' table-hover';
            }
            if ($('#condensed').prop('checked')) {
                classes += ' table-condensed';
            }
            $('#table-style').bootstrapTable('destroy')
                .bootstrapTable({
                    classes: classes,
                    striped: $('#striped').prop('checked')
                });
        });

        function rowStyle(row, index) {
            var bs_classes = ['active', 'success', 'info', 'warning', 'danger'];

            if (index % 2 === 0 && index / 2 < bs_classes.length) {
                return {
                    classes: bs_classes[index / 2]
                };
            }
            return {};
        }
    }

    return {

        //main function to initiate the module
        init: function () {

            TableTransform();
            TableStyle();
        }

    };

}();

jQuery(document).ready(function() {
    BootstrapTable.init();
});