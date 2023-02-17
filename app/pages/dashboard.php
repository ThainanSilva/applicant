


<!-- Doughnut chart example with:
# Center label in 2D chart
# Disabled tool-tips are disabled, but extended center label info on hover

-->
<div class="panel panel-default  dashwindow" >
    <div class="panel-heading">Acessos de Hoje </div>
    <div class="panel-body">
        <canvas id="myChart" ></canvas>
    </div>
</div>

<div class="panel panel-default  dashwindowPie" >
    <div class="panel-heading">Acessos de Hoje </div>
    <div class="panel-body">
        <canvas id="piechart" ></canvas>
    </div>
</div>
<div class="panel panel-default  dashwindow" >
    <div class="panel-heading">Acessos por perfil Hoje </div>
    <div class="panel-body">
        <div id="AcessosPorPerfil" ></div>
    </div>
</div>

 
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> 
<script>
    $(document).ready(function () {



        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function (xhr) {
                noConnection();
            }});



        $.ajax({
            method: "POST",
            url: "../api/dashboard.php",
            data: {json: '[{"function":"DashBarReport"}]'}
        })
                .done(function (data) {
                     console.log(data);


                    if (data === undefined) {

                    } else {

 

                        datalabels =  jQuery.parseJSON(data) ;

 
                        //***********************************************************************
                        
                           var colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#546E7A', '#26a69a', '#D10CE8'];
        var options = {
            chart: {
                height: 350,
                type: 'bar',
                events: {
                    click: function(chart, w, e) {
                        console.log(chart, w, e )
                    }
                },
            },
            colors: colors,
            plotOptions: {
                bar: {
                    columnWidth: '35%',
                    distributed: true
                }
            },
            dataLabels: {
                enabled: false,
            },
            series: [{
                data: datalabels.data
            }],
            xaxis: {
                categories: datalabels.labels,
                labels: {
                    style: {
                        colors: colors,
                        fontSize: '14px'
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#AcessosPorPerfil"),
            options
        );

        chart.render();
                        //************************************************************************
                        
                        /*
                        
                         var dataLine = {
                        labels: datalabels.LineDash,
                        datasets: [{
                                label: 'Acessos de Hoje',
                                data:  data,
                                fill: true,
                                lineTension: 0.1,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]



                    };


                    var ctx = document.getElementById("Linechart");
                    var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: dataLine,
                        options: {
                            scales: {
                                yAxes: [{
                                        stacked: true
                                    }]
                            }
                        }
                    });


                        var ctx = document.getElementById("myChart");
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: datalabels.labels,
                                datasets: [{
                                        label: 'Acessos de Hoje',
                                        data: datalabels.data,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 159, 64, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255,99,132,1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 159, 64, 1)'
                                        ],
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


                        var ctx = document.getElementById("piechart");
                        var myChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: datalabels.labels,
                                datasets: [{
                                        label: 'Acessos de Hoje',
                                        data: datalabels.data,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 159, 64, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255,99,132,1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 159, 64, 1)'
                                        ],
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
                        });*/
                    };
    });
});
</script>   