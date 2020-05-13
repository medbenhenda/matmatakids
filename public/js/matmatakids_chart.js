jQuery(document).ready(function () {
        // Handler for .load() called.
    var path = '/statsdash';
    var labels = [];
    var values = [];
    var bg_colors = [];
    $.ajax({
        url: path,
        type: "GET",
        dataType: "json",
        async: true,
        success: function (data) {
            labels = data.month.labels;
            values = data.month.values;
            bg_colors = data.month.background_color;
            Chart.platform.disableCSSInjection = true;
            let ctx = document.getElementById('myChart');
            let myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: '# Nombre de dons par mois',
                        data: values,
                        backgroundColor: bg_colors,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            let labelsp = data.project.labels;
            let valuesp = data.project.values;
            let bg_colorsp = data.month.background_color;

            let pdata = {
                datasets: [{
                    data: valuesp,
                    backgroundColor: bg_colorsp,
                    borderWidth: 0,
                    hoverBackgroundColor: ["#96b7b9","#718283","#5c6b6d"]
                }],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: labelsp
            };

            let ctx2 = document.getElementById('myChart2');
            var myDoughnutChart = new Chart(ctx2, {
                type: 'doughnut',
                data: pdata,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)'

                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            });

        }
    })





});