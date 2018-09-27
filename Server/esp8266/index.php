<!DOCTYPE html>
<html>

<style>


    </style>

<head>

    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
   
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">  
    <link rel="stylesheet" href="css/gauge.css">
   
  
    <script type='text/javascript' src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"> </script>
    
     
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/knockout/3.4.2/knockout-min.js'></script>
   
    <script type='text/javascript' src="GaugeMeter.js">


</head>








<body style="background-color: red">
<?php include 'graph.php'; ?>

    
  
    <div class="header container h-100 d-flex justify-content-center" style="width: 100%">
        <a href="#default" class="logo ">Smart Agriculture Self-Study 2018</a>
    </div> 
    
    <div class="card justify-content-center" style="padding: 25px;margin-top: 50px;min-height: 100px; overflow: hidden; display: inline-block; width: 100%;
    justify-content: center;
    align-items: center;">

        
        <div class="card" style="width:200px; float: left; margin:25px; display: inline-block;">
            <div class="GaugeMeter" id="Temperature" data-bind="gaugeValue: Percent" data-append="°C" data-size=200 data-theme="Blue-Green-Red" data-width=15 data-style="Arch" data-label="Temperature" data-animationstep="1" data-animate_gauge_colors="1"></div>
        </div> 


        <div class="card" style="width:200px;float: left;margin:25px; display: inline-block;">
            <div class="GaugeMeter" id="Humidity" data-bind="gaugeValue: Percent" data-append="%" data-size=200 data-theme="Blue" data-width=15 data-style="Arch" data-label="Humidity" data-animationstep="1" data-animate_gauge_colors="1"></div>
        </div>           

        <div class="card" style="width:200px; float: left; margin:25px; display: inline-block;">
            <div class="GaugeMeter" id="Sunlight" data-bind="gaugeValue: Percent" data-append="LUX" data-size=200 data-color=#2C94E0 data-width=15 data-style="Arch" data-label="Sunlight" data-animationstep="1" data-animate_gauge_colors="1"></div>
        </div> 

        <div class="card" style="width:200px; float: left; margin:25px; display: inline-block;">
            <div class="GaugeMeter" id="Moisture" data-bind="gaugeValue: Percent" data-append="%" data-size=200 data-theme="Red-Gold-Green" data-width=15 data-style="Arch" data-label="Moisture" data-animationstep="1" data-animate_gauge_colors="1"></div>
        </div> 

         <div class="card" style="width:200px; float: left; margin:25px; display: inline-block;">
            <div class="GaugeMeter" id="Moisture" data-bind="gaugeValue: Percent" data-append="%" data-size=200 data-theme="Red-Gold-Green" data-width=15 data-style="Arch" data-label="Water Level" data-animationstep="1" data-animate_gauge_colors="1"></div>
        </div> 
        </div>
    </div>    

<div class="card" style="padding: 50px;margin-top: 50px">
    <div id="chartContainer" style="height: 500px; width:100%; align-items: center;"></div>
    
</div>


    <div class="card" style="padding: 50px;margin-top: 50px">
    <H1 style="font-size: 50px; font-color:gray; text-align: center;"> Collected Data </H1>
    <div class="card" style="padding: 50px;margin-top: 50px">
        <div id="tableHolder"></div>
    </div>
    </div>




</body>

</html>



<script type="text/javascript">


        var c_t = 0;
        var c_h = 0;

        $(document).ready(function () {
            refreshTable();
            $(".GaugeMeter").gaugeMeter();
            $.ajax({
			type: 'POST',
			async: false,
			url: 'data.php',
			data:{"request":"h"},
			dataType: 'json',
			success: function(response)
			{

				d = response;
			}

        });
        
        c_t = d[d.length-1]["Temp"];
        c_h = d[d.length-1]["Humidity"];
        $("#Temperature").gaugeMeter({percent:c_t});
        $("#Humidity").gaugeMeter({percent:c_h});
           
        console.log(c_t);
          

        });

        function refreshTable() {
            
            $(".GaugeMeter").gaugeMeter();
            $.ajax({
			type: 'POST',
			async: false,
			url: 'data.php',
			data:{"request":"h"},
			dataType: 'json',
			success: function(response)
			{

				d = response;
			}

        });

  c_t = d[d.length-1]["Temp"];
        c_h = d[d.length-1]["Humidity"];








            $("#Temperature").gaugeMeter({percent:c_t});
            $("#Humidity").gaugeMeter({percent:c_h});
           
            $('#tableHolder').load('table.php', function () {
                setTimeout(refreshTable, 5000);
            });
        }
</script>



