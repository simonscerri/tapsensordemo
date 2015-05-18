<?php
			
	//$ip = "";
	//$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			
	date_default_timezone_set('Europe/London');

	require("includes/db_connection.php");
	$debug = 1;
	$device = "";
	
	if (isset ($_POST["device"]))
	{
		$device = htmlentities ($_POST["device"]);
	}

	$data = "";
	if (isset ($_POST["data"]))
	{
		$data = htmlentities ($_POST["data"]);
	}
	
	$devCheck = "";
	if (isset ($_POST["devCheck"]))
	{
		$devCheck = htmlentities ($_POST["devCheck"]);
	}
	
	$rssi = "";
	if (isset ($_POST["rssi"]))
	{
		$rssi = htmlentities ($_POST["rssi"]);
	}

	
	if ($debug == 1)
	{
		if (isset ($_GET["device"]))
		{
			$device = htmlentities ($_GET["device"]);
		}

		if (isset ($_GET["data"]))
		{
			$data = htmlentities ($_GET["data"]);
		}

		if (isset ($_GET["devCheck"]))
		{
			$devCheck = htmlentities ($_GET["devCheck"]);
		}
		if (isset ($_GET["rssi"]))
		{
			$rssi = htmlentities ($_GET["rssi"]);
		}
	}


	if ($devCheck == "arQTeSt"){
		
		if ($device == "8554"){
	
			$date_time = date("YmdHis");
			$highTempMax = hexdec(substr($data, -20, 4));
			$highTempMin = hexdec(substr($data, -16, 4));
			$lowTempMax = hexdec(substr($data, -12, 4));
			$lowTempMin = hexdec(substr($data, -8, 4));
			$refV = hexdec(substr($data, -4));
			
			echo "high temp max :" . $highTempMax;
			echo "<br/>";
			echo "high temp min :" . $highTempMin;
			echo "<br/>";
			echo "low temp max :" . $lowTempMax;
			echo "<br/>";
			echo "low temp min :" . $lowTempMin;
			echo "<br/>";
			echo "ref :" . $refV;
			echo "<br/>";
			
			
			$highTempMax = round((3435/( log((103910000 /$highTempMax)-101574)))-273.15, 2);
			$highTempMin = round((3435/( log((103910000 /$highTempMin)-101574)))-273.15, 2);
			$lowTempMax = round((3435/( log((103910000 /$lowTempMax)-101574)))-273.15, 2);
			$lowTempMin = round((3435/( log((103910000 /$lowTempMin)-101574)))-273.15, 2);
			
			
			$sql = "insert into tap_sensor (date_time, device_id, rssi, highTempMax, highTempMin, lowTempMax, lowTempMin) VALUES ('$date_time', '$device', '$rssi', '$highTempMax', '$highTempMin', '$lowTempMax', '$lowTempMin')";
			$result = $connection1->query($sql);
			if (!$result){
				echo mysql_error();
			}
		}
	}
	

?>