define([
    "jQuery",
    "jQueryUI",
	"bootstrap", 
    "highchart",
    "sidebar",
    "datatables",
    "datatablesBootstrap",
	], function (
    $,
    jQueryUI,
	bootstrap, 
    highchart,
    sidebar ,
    datatables,
    datatablesBootstrap
	) {
    return {  
        table:null,
        init: function () { 
        	App.initFunc(); 
            App.initEvent(); 
            console.log("LOADED");
            
            
            $(".loadingpage").hide();
        }, 
        
        initEvent : function(){   
          Highcharts.chart('usercount', { 
            title: {
                text: 'Total Permintaan Konservasi Perbulan'
            },
 
            yAxis: {
                title: {
                    text: 'Persentase'
                }
            },

            xAxis: {
                accessibility: {
                    rangeDescription: 'Terbaru'
                }
            }, 
            series: [{
                name: 'Total Permintaan',
                data: [1, 2]
            } ],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });
                      

        } 
	}
});