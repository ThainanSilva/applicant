as

<script src="../js/jquery-3.1.0.min.js"></script>

<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

   <script src="http://static.fusioncharts.com/code/latest/fusioncharts.charts.js?cacheBust=82"></script>
      <script src="http://static.fusioncharts.com/code/latest/fusioncharts.js?cacheBust=82"></script>

<script src="https://cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"></script>


<script type="text/javascript" src="/path/to/jquery.tablesorter.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> 

<script>

FusionCharts.ready(function () {
    var revenueChart = new FusionCharts({
        type: 'doughnut2d',
        renderAt: 'chart-container',
        width: '450',
        height: '450',
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "caption": "Split of Revenue by Product Categories",
                "subCaption": "Last year",
                "numberPrefix": "$",
                "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000",
                "bgColor": "#ffffff",
                "showBorder": "0",
                "use3DLighting": "0",
                "showShadow": "0",
                "enableSmartLabels": "0",
                "startingAngle": "310",
                "showLabels": "0",
                "showPercentValues": "1",
                "showLegend": "1",
                "legendShadow": "0",
                "legendBorderAlpha": "0",
                "defaultCenterLabel": "Total revenue: $64.08K",
                "centerLabel": "Revenue from $label: $value",
                "centerLabelBold": "1",
                "showTooltip": "0",
                "decimals": "0",
                "captionFontSize": "14",
                "subcaptionFontSize": "14",
                "subcaptionFontBold": "0"
            },
            "data": [
                {
                    "label": "Food",
                    "value": "28504"
                },
                {
                    "label": "Apparels",
                    "value": "14633"
                },
                {
                    "label": "Electronics",
                    "value": "10507"
                },
                {
                    "label": "Household",
                    "value": "4910"
                }
            ]
        }
    }).render();
});
</script>


<!-- Doughnut chart example with:
# Center label in 2D chart
# Disabled tool-tips are disabled, but extended center label info on hover

-->
<div id="chart-container">FusionCharts will render here</div>
