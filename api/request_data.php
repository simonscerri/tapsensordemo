<?php
		header('Content-Type: application/json');
		require("../includes/db_connection.php");
		
		function line ($data){
			$line = $data .chr(13).chr(10);
			return ($line);
		}

		function send_response ($temp1,$temp2, $temp3, $temp4)
		{
			echo line ("{"); // Start

			echo line (' 	"temp1": "'.$temp1.'",');
			echo line (' 	"temp2": "'.$temp2.'",');
			echo line (' 	"temp3": "'.$temp3.'",');
			echo line (' 	"temp4": "'.$temp4.'"');

			echo line ("}"); // end
		
		}	


		
		$sql = "SELECT * FROM tap_sensor WHERE date_time=(SELECT MAX(date_time) FROM tap_sensor)";
		$result = $connection1->query ($sql);
		if ($result){
			$row = $result->fetch_object();
			$highTempMax = $row->highTempMax;
			$highTempMin = $row->highTempMin;
			$lowTempMax = $row->lowTempMax;
			$lowTempMin = $row->lowTempMin;
			send_response ( $highTempMax, $highTempMin, $lowTempMax, $lowTempMin);
		} else {
			$highTempMax = 0;
			$highTempMin = 0;
			$lowTempMax = 0;
			$lowTempMin = 0;
			send_response ($highTempMax, $highTempMin, $lowTempMax, $lowTempMin);
		}
					


?>