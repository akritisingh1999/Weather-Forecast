<?php
	if(isset($_GET["city"]))
	{
		$error = "";
		$city= str_replace('  ',' ',$_GET["city"]);
		$header = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
		if($header[0]== "HTTP/1.1 404 Not Found")
		{
			$error= "Invalid City. Do enter the first letter Capital";
		}
		else 
		{
	    	$forecastpage= file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
			$firstarray = explode('<span class="read-more-small"><span class="read-more-content">The Long-range 10 day forecast also includes detail for '.$city.' weather today.', $forecastpage);
			$final = explode("for local outdoor activities.",$firstarray[1]);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Weather</title>
	<link rel="stylesheet" type="text/css" href="projects/Weather App/weather.css">
</head>
<body>
<div id="container">
	<h1>Know Your Weather</h1>
	<h3>Enter Your City</h3>
	<form method="get">
		<input type="text" name="city"placeholder="Ex. Delhi, Mumbai">
		<br>
		<button>Submit</button>
	</form>
	<?php
		if(isset($error))
		{
			echo '<p id="wrong">'.$error.'</p>';
		}
		if(isset($final[0]))
		{
			echo '<p id="output">'.$final[0].'</p>';
		}
	?>
</div>
</body>
<script type="text/javascript" src="projects/Weather App/weather.js"></script>
</html>