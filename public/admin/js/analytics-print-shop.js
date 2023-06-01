$(function () {
    ("use strict");

    // Doughnat Chart (Segmentasi Analitik Produk dan Jasa)
    var doughnutPieData = {
        datasets: [
            {
                data: [30, 40, 30],
                backgroundColor: [
                    "rgba(255, 99, 132, 0.5)",
                    "rgba(54, 162, 235, 0.5)",
                    "rgba(255, 206, 86, 0.5)",
                    "rgba(75, 192, 192, 0.5)",
                    "rgba(153, 102, 255, 0.5)",
                    "rgba(255, 159, 64, 0.5)",
                ],
                borderColor: [
                    "rgba(255,99,132,1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)",
                ],
            },
        ],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: ["Product", "Service", "Other"],
    };

    var doughnutPieOptions = {
        responsive: true,
        animation: {
            animateScale: true,
            animateRotate: true,
        },
    };

    if ($("#doughnutChart").length) {
        var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
        var doughnutChart = new Chart(doughnutChartCanvas, {
            type: "doughnut",
            data: doughnutPieData,
            options: doughnutPieOptions,
        });
    }

    if ($("#browserTrafficChart").length) {
        var doughnutChartCanvas = $("#browserTrafficChart")
            .get(0)
            .getContext("2d");
        var doughnutChart = new Chart(doughnutChartCanvas, {
            type: "doughnut",
            data: browserTrafficData,
            options: doughnutPieOptions,
        });
    }

    // Bar Chart (Analitik Penjualan Produk dan Jasa Perbulan dalam kurun waktu satu tahun sekarang)
    var data = {
        labels: ["2013", "2014", "2014", "2015", "2016", "2017"],
        datasets: [
            {
                label: "# of Votes",
                data: [10, 19, 3, 5, 2, 3],
                backgroundColor: [
                    "rgba(255, 99, 132, 0.2)",
                    "rgba(54, 162, 235, 0.2)",
                    "rgba(255, 206, 86, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                    "rgba(153, 102, 255, 0.2)",
                    "rgba(255, 159, 64, 0.2)",
                ],
                borderColor: [
                    "rgba(255,99,132,1)",
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)",
                ],
                borderWidth: 1,
                fill: false,
            },
        ],
    };

    var options = {
        scales: {
            yAxes: [
                {
                    ticks: {
                        beginAtZero: true,
                    },
                },
            ],
        },
        legend: {
            display: false,
        },
        elements: {
            point: {
                radius: 0,
            },
        },
    };

    // Get context with jQuery - using jQuery's .get() method.
    if ($("#barChart").length) {
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var barChart = new Chart(barChartCanvas, {
            type: "bar",
            data: data,
            options: options,
        });
    }
});
