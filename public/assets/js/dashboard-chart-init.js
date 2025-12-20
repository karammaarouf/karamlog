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
                left: -10,
                top: -25,
                right: -60,
                bottom: -40,
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
