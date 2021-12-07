<!DOCTYPE HTML>
<html lang ="en">
 <head>  
  <meta charset="utf-8">
  <title>Temperature Example</title>
  <script src ="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src ="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
    <div id ="container" style="width:550px; height:400px; margin:0 auto"></div>
    <script language = "JavaScript">
        $(document).ready(function()){
            let title = {
                text: 'Monthly Average Temperature'
            };
            let subtitle={
                text: 'Source: WorldClimate.com'
            };
            let xAxis=xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            };
            let  yAxis: {
                title: {
                    text: 'Temperature (°C)'
                },
                plotLines:[{
                    value:0,
                    width:1,
                    color:'#808080'
                }]
            };
            let tooltip={
                valueSuffix: '\xB0C'
            };
            let legend={
                layout: 'vertical',
                align:'right',
                verticalAlign:'middle',
                borderWidth:0
            };
            let series = [{
                name: 'Tokyo',
                data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
                }, 
                {
                name: 'London',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
                }
                {
                name: 'London',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
                }
                {
                name: 'London',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
                }
            ];
            let json ={};
            json.title=title;
            json.subtitle=subtitle;
            json.xAxis=xAxis;
            json.yAxis=yAxis;
            json.tooltip=tooltip;
            json.legend=legend;
            json.series=series;

            $('#container').highcharts(json);
        });
        </script>
    </body>
</html>
 
