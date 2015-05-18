<?php
		header('Content-Type: application/json');
		require("../includes/db_connection.php");
		
		$state = FALSE;
		
		function line ($data){
			$line = $data .chr(13).chr(10);
			return ($line);
		}

		function send_response ($time, $temp1, $temp2, $temp3, $temp4)
		{
			echo line ("{"); // Start

			echo line (' "date_time": "'.$time.'",');
			echo line (' "temp1": "'.$temp1.'",');
			echo line (' "temp2": "'.$temp2.'",');
			echo line (' "temp3": "'.$temp3.'",');
			echo line (' "temp4": "'.$temp4.'"');
			

			echo line ("}"); // end
		
		}

		if (isset($_GET['date1']) && isset($_GET['date2'])){
			
			$tmp1 = $_GET['date1'];
			$tmp2 = $_GET['date2'];
			$date1 = substr($tmp1, 0, 10);
			$date1 = str_replace("/","-", $date1);
			$date2 = substr($tmp2, 0, 10);
			$date2 = str_replace("/","-", $date2);
			$sql = "SELECT * FROM tap_sensor WHERE SUBSTR(date_time,1,10) >= '{$date1}' AND SUBSTR(date_time,1,10) <= '{$date2}'";
			$state = TRUE;
		} else {
			$sql = "SELECT * FROM (SELECT * FROM tap_sensor ORDER BY date_time DESC LIMIT 100) sub ORDER BY date_time ASC";
			$state = TRUE;
		}
		
		if ($state){
			$temp_counter = 0;
			$result = $connection1->query($sql);
			$counter = $result->num_rows;
			
			echo line("[");
			while ($row = $result->fetch_object()){
				$temp_counter = $temp_counter + 1;
				$date_time = $row->date_time;
				$a = $row->highTempMax;			
				$b = $row->highTempMin;
				$c = $row->lowTempMax;			
				$d = $row->lowTempMin;
				send_response($date_time, $a, $b, $c,$d);
					
				if ($temp_counter < $counter){
					echo line(",");
				}
			}
				
			echo line ("]");
		}

?>

