<!DOCTYPE HTML>
<html>

<head>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	
</div>


	<script>
		var oldLength;
	var dps; 
	var dps1;
	window.onload = function () {
		var d;
		var dataLength = 20;
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


//console.log(d);

dps = [];
dps1 = [];
var myDataLength;
myDataLength = d.length;
var counter = 0;
counter = myDataLength;

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title :{
		text: "Temperature and Humidity"
	},
	axisY: {
		includeZero: false
	},      
	data: [{
		showInLegend: true, 
		legendText: "Temperature(°C)",
		type: "line",
		color: "red",
		dataPoints: dps
	},{
		showInLegend: true,
		legendText: "Humidity(%)",
		type: "line",
		color: "blue",
		dataPoints: dps1
	}]
	
});

if(myDataLength > dataLength)
{
	j = myDataLength - dataLength;
	
}
else
{
	j = 0;
}

oldLength = myDataLength;

for (j; j < counter; j++) {

	var t = parseInt(d[j]["Temp"],10);
	var q = parseInt(d[j]["Humidity"],10);
	

	dps.push({
		x: j,
		y: t
	});
	dps1.push({
		x: j,
		y: q
	});


}
chart.render();

var f = function(){


var updateInterval = 1000;


 var updateChart = function (count) {
 	//console.log(dps);
 	$.ajax({
 		type: 'POST',

 		url: 'data.php',
 		data:{"request":"h"},
 		dataType: 'json',
 		success: function(response)
 		{

 			d = (response);
 		}

 	});
	//var c = d.length;
	
	var myDataLength = d.length;
	
	if(myDataLength != oldLength)
	{	

		for (var i = dps.length; i > 0; i--) {

			dps.pop();
			dps1.pop();

		}
		
		oldLength = myDataLength;
		//dps = [];
		if(myDataLength > dataLength)
		{
			j = myDataLength - dataLength;

		}		
		else
		{
			j = 0;
		}

		oldLength = myDataLength;
		counter = myDataLength;
		for (j; j < counter; j++) {

			var t = parseInt(d[j]["Temp"],10);
			var q = parseInt(d[j]["Humidity"],10);
	

			dps.push({
				x: j,
				y: t
			});
			dps1.push({
				x: j,
				y: q
			});

		}
		chart.render();
		
	}
	
	
	chart.render();
	
	
};

updateChart();
setInterval(function(){updateChart()}, updateInterval);
};

setTimeout(function(){
 f();
}, 3000);
}
</script>
</head>
<body>

	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
