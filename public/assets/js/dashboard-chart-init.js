function initDashboardChart(selector, chartData, categories, color) {
    "use strict";
    var optionslinechart = {
        chart: {
            toolbar: {
                show: false,
            },
            height: 200,
            type: "area",
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: 3,
            curve: "smooth",
        },
        xaxis: {
            show: false,
            type: "datetime",
            categories: categories,
            labels: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
        },
        yaxis: {
            labels: {
                show: false,
            },
        },
        grid: {
            show: false,
            padding: {
                left: 0,
                top: 0,
                right: 0,
                bottom: 0,
            },
        },
        fill: {
            opacity: 0.2,
        },
        colors: [color || AdmiroAdminConfig.primary],
        series: [{
            data: chartData,
        }, ],
        tooltip: {
            x: {
                format: "dd/MM/yy HH:mm",
            },
        },
        responsive: [{
            breakpoint: 576,
            options: {
                chart: {
                    height: 100,
                }
            }
        }]
    };

    var chartlinechart = new ApexCharts(
        document.querySelector(selector),
        optionslinechart
    );

    chartlinechart.render();
}

function initMonthlyHistoryChart(selector, series, categories) {
    "use strict";
    var options = {
        series: series,
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: categories,
        },
        yaxis: {
            title: {
                text: 'Count'
            }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val
                }
            }
        },
        colors: [AdmiroAdminConfig.primary, AdmiroAdminConfig.secondary, '#51bb25']
    };

    var chart = new ApexCharts(document.querySelector(selector), options);
    chart.render();
}

if (typeof monthlyHistoryData !== 'undefined') {
    initMonthlyHistoryChart("#chart-widget4", monthlyHistoryData.series, monthlyHistoryData.categories);
}
