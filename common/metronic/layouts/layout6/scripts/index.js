var Index = function () {

	var handleColumnLine = function() {
		var chart = AmCharts.makeChart("columnLine", {
		  "type": "serial",
		  "addClassNames": true,
		  "theme": "light",
		  "path": "../../assets/global/plugins/amcharts/ammap/images/",
		  "autoMargins": false,
		  "marginLeft": 30,
		  "marginRight": 8,
		  "marginTop": 10,
		  "marginBottom": 26,
		  "balloon": {
		    "adjustBorderColor": false,
		    "horizontalPadding": 10,
		    "verticalPadding": 8,
		    "color": "#ffffff"
		  },

		  "dataProvider": [{
		    "year": 2009,
		    "income": 23.5,
		    "expenses": 21.1
		  }, {
		    "year": 2010,
		    "income": 26.2,
		    "expenses": 30.5
		  }, {
		    "year": 2011,
		    "income": 30.1,
		    "expenses": 34.9
		  }, {
		    "year": 2012,
		    "income": 29.5,
		    "expenses": 31.1
		  }, {
		    "year": 2013,
		    "income": 30.6,
		    "expenses": 28.2,
		  }, {
		    "year": 2014,
		    "income": 34.1,
		    "expenses": 32.9,
		    "dashLengthColumn": 5,
		    "alpha": 0.2,
		    "additional": "(projection)"
		  }],
		  "valueAxes": [{
		    "axisAlpha": 0,
		    "position": "left"
		  }],
		  "startDuration": 1,
		  "graphs": [{
		    "alphaField": "alpha",
		    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
		    "fillAlphas": 1,
		    "title": "Income",
		    "type": "column",
		    "valueField": "income",
		    "dashLengthField": "dashLengthColumn"
		  }, {
		    "id": "graph2",
		    "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
		    "bullet": "round",
		    "lineThickness": 3,
		    "bulletSize": 7,
		    "bulletBorderAlpha": 1,
		    "bulletColor": "#FFFFFF",
		    "useLineColorForBulletBorder": true,
		    "bulletBorderThickness": 3,
		    "fillAlphas": 0,
		    "lineAlpha": 1,
		    "title": "Expenses",
		    "valueField": "expenses"
		  }],
		  "categoryField": "year",
		  "categoryAxis": {
		    "gridPosition": "start",
		    "axisAlpha": 0,
		    "tickLength": 0
		  },
		  "export": {
		    "enabled": true
		  }
		});
	}

	var handleAnimatedPieChart = function() {
		var chart = AmCharts.makeChart( "animated-pie-chart", {
		  "type": "pie",
		  "theme": "light",
		  "path": "../../assets/global/plugins/amcharts/ammap/images/",
		  "dataProvider": [ {
		    "country": "Lithuania",
		    "value": 260
		  }, {
		    "country": "Ireland",
		    "value": 201
		  }, {
		    "country": "Germany",
		    "value": 65
		  }, {
		    "country": "Australia",
		    "value": 39
		  }, {
		    "country": "UK",
		    "value": 19
		  }, {
		    "country": "Latvia",
		    "value": 10
		  } ],
		  "valueField": "value",
		  "titleField": "country",
		  "outlineAlpha": 0.4,
		  "depth3D": 15,
		  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
		  "angle": 30,
		  "export": {
		    "enabled": true
		  }
		} );
		jQuery( '.chart-input' ).off().on( 'input change', function() {
		  var property = jQuery( this ).data( 'property' );
		  var target = chart;
		  var value = Number( this.value );
		  chart.startDuration = 0;

		  if ( property == 'innerRadius' ) {
		    value += "%";
		  }

		  target[ property ] = value;
		  chart.validateNow();
		} );
	}

	var handleMorrisCharts = function() {
        if (Morris.EventEmitter) {
            // Use Morris.Area instead of Morris.Line
            dashboardMainChart = Morris.Area({
                element: 'sales_statistics',
                padding: 0,
                behaveLikeLine: false,
                gridEnabled: false,
                gridLineColor: false,
                axes: false,
                fillOpacity: 1,
                data: [{
                    period: '2011 Q1',
                    sales: 1400,
                    profit: 400
                }, {
                    period: '2011 Q2',
                    sales: 1100,
                    profit: 600
                }, {
                    period: '2011 Q3',
                    sales: 1600,
                    profit: 500
                }, {
                    period: '2011 Q4',
                    sales: 1200,
                    profit: 400
                }, {
                    period: '2012 Q1',
                    sales: 1550,
                    profit: 800
                }],
                lineColors: ['#399a8c', '#92e9dc'],
                xkey: 'period',
                ykeys: ['sales', 'profit'],
                labels: ['Sales', 'Profit'],
                pointSize: 0,
                lineWidth: 0,
                hideHover: 'auto',
                resize: true
            });

        }
    }

	var handleSparklineCharts = function() {
        $("#sparkline_bar").sparkline([8, 9, 10, 11, 10, 10, 12, 10, 10, 11, 9, 12, 11], {
            type: 'bar',
            width: '100',
            barWidth: 6,
            height: '45',
            barColor: '#F36A5B',
            negBarColor: '#e02222'
        });

        $("#sparkline_bar2").sparkline([9, 11, 12, 13, 12, 13, 10, 14, 13, 11, 11, 12, 11], {
            type: 'bar',
            width: '100',
            barWidth: 6,
            height: '45',
            barColor: '#5C9BD1',
            negBarColor: '#e02222'
        });
    }

    return {

        //main function
        init: function () {
            handleColumnLine();
            handleAnimatedPieChart();
            handleSparklineCharts();
            handleMorrisCharts();
        }

    };

}();

jQuery(document).ready(function() {    
   Index.init(); // init metronic core componets
});