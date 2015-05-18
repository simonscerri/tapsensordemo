<?php
		header('Content-Type: application/json');
		require("../includes/db_connection.php");
		
		function line ($data){
			$line = $data .chr(13).chr(10);
			return ($line);
		}

		function send_response ($d1,$d2)
		{
			echo line ("{"); // Start

			echo line (' 	"date1": "'.$d1.'",');
			echo line (' 	"date2": "'.$d2.'"');
			echo line ("}"); // end
		
		}	


		
		$sql = "SELECT MIN(date_time) AS date1, MAX(date_time) AS date2 FROM tap_sensor";
		$result = $connection1->query ($sql);
		if ($result){
			$row = $result->fetch_object();
			$date1 = $row->date1;
			$date2 = $row->date2;
			$date1 = substr($date1, 0, 10);
			$date2 = substr($date2, 0, 10);
			
			//$date1 = str_replace("-", "/", $date1);
			//$date2 = str_replace("-", "/", $date2);
			send_response ( $date1, $date2);
		} else {
			$date1 = "";
			$date2 = "";
			send_response ($date1, $date2);
		}
					


?>