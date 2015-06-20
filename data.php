<!doctype html>
<html>
	<head>
		<title>Bar Chart</title>
		<script src="src/Chart.js"></script>
	</head>


	<body>
		<div style="width: 100%">
			<canvas id="canvas" height="450" width="600"></canvas>
		</div>
 

	<script>
	var randomScalingFactor =   function(){ return Math.round(Math.random()*100)};

	var barChartData = {
		labels : ["Followers","friends","statuses count"],
		datasets : [
			{
				fillColor : "rgba(0,0,220,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(220,220,220,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : [<?php echo $_SESSION['followers'];?>,<?php echo $_SESSION['friendz'];?>, <?php echo $_SESSION['statuses_count'];?>]
			}
		]

	}
	 
	var ctx = document.getElementById("canvas").getContext("2d");
	window.myBar = new Chart(ctx).Bar(barChartData, {
	responsive : true
	});
	</script>
	</body>
</html>
