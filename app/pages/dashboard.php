


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
  <div class="panel-heading">Acessos de Hoje </div>
  <div class="panel-body">
      <canvas id="Linechart" ></canvas>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.js"></script>

<script>
$(document).ready(function(){
    
    

        $.ajaxSetup({
          timeout: 6000, //time in miliseconds
          error:function(xhr){
            noConnection();
        }});
        

        
        $.ajax({
          method: "POST",
          url: "../api/dashboard.php",
          data:{json: '[{"function":"DashBarReport"}]'}
        })
        .done(function( data ){
 console.log(data)


          if(data === undefined){

          }else{

 

datalabels = JSON.parse(data);

    console.log(datalabels.labels)
    console.log(datalabels.data)
    
    
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
                    beginAtZero:true
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
                    beginAtZero:true
                }
            }]
        }
    }
})} 


var dataLine = {
    labels: ["Segunda - 23", "Terça - 24", "Quarta - 25", "Quinta - 26", "Sexta - 27"],
    datasets: [
        {
            label: "Acessos da semana",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 1,
            pointHitRadius: 10,
            data: [65, 59, 80, 81, 56],
            spanGaps: false,
        }
    ]
}


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






})
});
    
</script>   