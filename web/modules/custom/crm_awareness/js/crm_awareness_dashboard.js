
var $ = jQuery.noConflict();

$(document).ready(function(){
	
	   $("body.page-awareness-dashboard .views-exposed-form .views-exposed-widgets .views-exposed-widget > label").click(function() {
                        $(this).next().toggle(300);
                        var bgImg = $(this).css('background-image');
                        if(bgImg.indexOf('icon-close.png') != -1 ){
                            $(this).css('background-image', 'url("/sites/all/themes/crm/images/icon-expand.png")');
                        }else{
                            $(this).css('background-image', 'url("/sites/all/themes/crm/images/icon-close.png")');
                        }
                    });

                    Highcharts.chart('container-compre-meaning', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: 0,
                            plotShadow: false
                        },
                        title: {
                            text: 'Meaning<br>of<br>SEA',
                            align: 'center',
                            verticalAlign: 'middle',
                            y: 40
                        },
                        tooltip: {
                            pointFormat: '<b>{point.percentage:.1f}%</b>'
                        },
                        legend: {
                            align: 'right',
                            x: -30,
                            verticalAlign: 'top',
                            y: 25,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                            borderColor: '#CCC',
                            borderWidth: 1,
                            shadow: false
                        },
                        plotOptions: {
                            pie: {
                                startAngle: -90,
                                endAngle: 90,
                                center: ['50%', '75%'],
                                showInLegend: true,
                                dataLabels: {
                                    enabled: false
                                },
                            }
                        },
                        credits:{
                            enabled: false,
                        },
                        series: [{
                            type: 'pie',
                            innerSize: '50%',
                            data: drupalSettings.crm_awareness_dashboard.rows_compre_meaning
                        }]
                    });

                    Highcharts.chart('container-compre-risk', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: 0,
                            plotShadow: false
                        },
                        title: {
                            text: 'Risk and<br>Consequences<br>of SEA',
                            align: 'center',
                            verticalAlign: 'middle',
                            y: 40
                        },
                        tooltip: {
                            pointFormat: '<b>{point.percentage:.1f}%</b>'
                        },
                        legend: {
                            align: 'right',
                            x: -30,
                            verticalAlign: 'top',
                            y: 25,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                            borderColor: '#CCC',
                            borderWidth: 1,
                            shadow: false
                        },
                        plotOptions: {
                            pie: {
                                startAngle: -90,
                                endAngle: 90,
                                center: ['50%', '75%'],
                                showInLegend: true,
                                dataLabels: {
                                    enabled: false
                                },
                            }
                        },
                        credits:{
                            enabled: false,
                        },
                        series: [{
                            type: 'pie',
                            innerSize: '50%',
                            data: drupalSettings.crm_awareness_dashboard.rows_compre_risk
                        }]
                    });

                    Highcharts.chart('container-compre-refugee', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: 0,
                            plotShadow: false
                        },
                        title: {
                            text: 'Refugee Rights<br>in Regard<br>to SEA',
                            align: 'center',
                            verticalAlign: 'middle',
                            y: 40
                        },
                        tooltip: {
                            pointFormat: '<b>{point.percentage:.1f}%</b>'
                        },
                        legend: {
                            align: 'right',
                            x: -30,
                            verticalAlign: 'top',
                            y: 25,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                            borderColor: '#CCC',
                            borderWidth: 1,
                            shadow: false
                        },
                        plotOptions: {
                            pie: {
                                startAngle: -90,
                                endAngle: 90,
                                center: ['50%', '75%'],
                                showInLegend: true,
                                dataLabels: {
                                    enabled: false
                                },
                            }
                        },
                        credits:{
                            enabled: false,
                        },
                        series: [{
                            type: 'pie',
                            innerSize: '50%',
                            data: drupalSettings.crm_awareness_dashboard.rows_compre_refugee
                        }]
                    });

                    Highcharts.chart('container-compre-complaint', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: 0,
                            plotShadow: false
                        },
                        title: {
                            text: 'How to<br>file a<br>Complaint',
                            align: 'center',
                            verticalAlign: 'middle',
                            y: 40
                        },
                        tooltip: {
                            pointFormat: '<b>{point.percentage:.1f}%</b>'
                        },
                        legend: {
                            align: 'right',
                            x: -30,
                            verticalAlign: 'top',
                            y: 25,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                            borderColor: '#CCC',
                            borderWidth: 1,
                            shadow: false
                        },
                        plotOptions: {
                            pie: {
                                startAngle: -90,
                                endAngle: 90,
                                center: ['50%', '75%'],
                                showInLegend: true,
                                dataLabels: {
                                    enabled: false
                                },
                            }
                        },
                        credits:{
                            enabled: false,
                        },
                        series: [{
                            type: 'pie',
                            innerSize: '50%',
                            data: drupalSettings.crm_awareness_dashboard.rows_compre_complaint
                        }]
                    });


                    Highcharts.chart('container-issues-camp', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Number of responses by Camp'
                        },
                        xAxis: {
                            type: 'category',
                            labels: {
                                rotation: 45,
                            }
                        },
                        yAxis: {
                            title: {
                                text: '# of issues'
                            }
                        },
                        credits: {
                            enabled: false
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: {
                            pointFormat: 'Count: <b>{point.y}</b>'
                        },
                        series: [{
                            name: 'Type',
                            data: drupalSettings.crm_awareness_dashboard.rows_issues_camp
                        }]
                    });

                    Highcharts.chart('container-issues-sector', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Number of responses by Sector'
                        },
                        xAxis: {
                            type: 'category',
                            labels: {
                                rotation: 45,
                            }
                        },
                        yAxis: {
                            title: {
                                text: '# of issues'
                            }
                        },
                        credits: {
                            enabled: false
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: {
                            pointFormat: 'Count: <b>{point.y}</b>'
                        },
                        series: [{
                            name: 'Type',
                            data: drupalSettings.crm_awareness_dashboard.rows_issues_sector
                        }]
                    });



  });	
/*
(function ($) {
    Drupal.behaviors.crm_awareness = {
        attach: function (context, settings) {
            $(document).ready(function(){
                if('crm' == settings.ajaxPageState.theme) {
                    //make clickable filters
                    $("body.page-awareness-dashboard .views-exposed-form .views-exposed-widgets .views-exposed-widget > label").click(function() {
                        $(this).next().toggle(300);
                        var bgImg = $(this).css('background-image');
                        if(bgImg.indexOf('icon-close.png') != -1 ){
                            $(this).css('background-image', 'url("/sites/all/themes/crm/images/icon-expand.png")');
                        }else{
                            $(this).css('background-image', 'url("/sites/all/themes/crm/images/icon-close.png")');
                        }
                    });

                    Highcharts.chart('container-compre-meaning', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: 0,
                            plotShadow: false
                        },
                        title: {
                            text: 'Meaning<br>of<br>SEA',
                            align: 'center',
                            verticalAlign: 'middle',
                            y: 40
                        },
                        tooltip: {
                            pointFormat: '<b>{point.percentage:.1f}%</b>'
                        },
                        legend: {
                            align: 'right',
                            x: -30,
                            verticalAlign: 'top',
                            y: 25,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                            borderColor: '#CCC',
                            borderWidth: 1,
                            shadow: false
                        },
                        plotOptions: {
                            pie: {
                                startAngle: -90,
                                endAngle: 90,
                                center: ['50%', '75%'],
                                showInLegend: true,
                                dataLabels: {
                                    enabled: false
                                },
                            }
                        },
                        credits:{
                            enabled: false,
                        },
                        series: [{
                            type: 'pie',
                            innerSize: '50%',
                            data: settings.crm_awareness_dashboard.rows_compre_meaning
                        }]
                    });

                    Highcharts.chart('container-compre-risk', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: 0,
                            plotShadow: false
                        },
                        title: {
                            text: 'Risk and<br>Consequences<br>of SEA',
                            align: 'center',
                            verticalAlign: 'middle',
                            y: 40
                        },
                        tooltip: {
                            pointFormat: '<b>{point.percentage:.1f}%</b>'
                        },
                        legend: {
                            align: 'right',
                            x: -30,
                            verticalAlign: 'top',
                            y: 25,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                            borderColor: '#CCC',
                            borderWidth: 1,
                            shadow: false
                        },
                        plotOptions: {
                            pie: {
                                startAngle: -90,
                                endAngle: 90,
                                center: ['50%', '75%'],
                                showInLegend: true,
                                dataLabels: {
                                    enabled: false
                                },
                            }
                        },
                        credits:{
                            enabled: false,
                        },
                        series: [{
                            type: 'pie',
                            innerSize: '50%',
                            data: settings.crm_awareness_dashboard.rows_compre_risk
                        }]
                    });

                    Highcharts.chart('container-compre-refugee', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: 0,
                            plotShadow: false
                        },
                        title: {
                            text: 'Refugee Rights<br>in Regard<br>to SEA',
                            align: 'center',
                            verticalAlign: 'middle',
                            y: 40
                        },
                        tooltip: {
                            pointFormat: '<b>{point.percentage:.1f}%</b>'
                        },
                        legend: {
                            align: 'right',
                            x: -30,
                            verticalAlign: 'top',
                            y: 25,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                            borderColor: '#CCC',
                            borderWidth: 1,
                            shadow: false
                        },
                        plotOptions: {
                            pie: {
                                startAngle: -90,
                                endAngle: 90,
                                center: ['50%', '75%'],
                                showInLegend: true,
                                dataLabels: {
                                    enabled: false
                                },
                            }
                        },
                        credits:{
                            enabled: false,
                        },
                        series: [{
                            type: 'pie',
                            innerSize: '50%',
                            data: settings.crm_awareness_dashboard.rows_compre_refugee
                        }]
                    });

                    Highcharts.chart('container-compre-complaint', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: 0,
                            plotShadow: false
                        },
                        title: {
                            text: 'How to<br>file a<br>Complaint',
                            align: 'center',
                            verticalAlign: 'middle',
                            y: 40
                        },
                        tooltip: {
                            pointFormat: '<b>{point.percentage:.1f}%</b>'
                        },
                        legend: {
                            align: 'right',
                            x: -30,
                            verticalAlign: 'top',
                            y: 25,
                            floating: true,
                            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                            borderColor: '#CCC',
                            borderWidth: 1,
                            shadow: false
                        },
                        plotOptions: {
                            pie: {
                                startAngle: -90,
                                endAngle: 90,
                                center: ['50%', '75%'],
                                showInLegend: true,
                                dataLabels: {
                                    enabled: false
                                },
                            }
                        },
                        credits:{
                            enabled: false,
                        },
                        series: [{
                            type: 'pie',
                            innerSize: '50%',
                            data: settings.crm_awareness_dashboard.rows_compre_complaint
                        }]
                    });


                    Highcharts.chart('container-issues-camp', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Number of responses by Camp'
                        },
                        xAxis: {
                            type: 'category',
                            labels: {
                                rotation: 45,
                            }
                        },
                        yAxis: {
                            title: {
                                text: '# of issues'
                            }
                        },
                        credits: {
                            enabled: false
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: {
                            pointFormat: 'Count: <b>{point.y}</b>'
                        },
                        series: [{
                            name: 'Type',
                            data: settings.crm_awareness_dashboard.rows_issues_camp
                        }]
                    });

                    Highcharts.chart('container-issues-sector', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'Number of responses by Sector'
                        },
                        xAxis: {
                            type: 'category',
                            labels: {
                                rotation: 45,
                            }
                        },
                        yAxis: {
                            title: {
                                text: '# of issues'
                            }
                        },
                        credits: {
                            enabled: false
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: {
                            pointFormat: 'Count: <b>{point.y}</b>'
                        },
                        series: [{
                            name: 'Type',
                            data: settings.crm_awareness_dashboard.rows_issues_sector
                        }]
                    });



                }
            });
        }
    };
}(jQuery));
*/
