<?php

			require("includes/db_connection.php");
			
			$sql = "SELECT * FROM (SELECT * FROM tap_sensor ORDER BY date_time DESC) sub ORDER BY date_time ASC";
			$result = $connection1->query($sql);
			
			$filename = "data_report_export.csv";

			$fp = fopen($filename, "w");
			
			$line = "";
			$comma = "";
			$line .= $comma . '"Date - Time"';
			
			$comma = ",";
			$line .= $comma . '"Hot Max"';
			
			$comma = ",";
			$line .= $comma . '"Hot Min"';
		
			$comma = ",";
			$line .= $comma . '"Cold Max"';
		
			$comma = ",";
			$line .= $comma . '"Cold Min"';
		
			
			$line .= "\n";
			fputs($fp, $line);
			
			$line = "";
			$comma = "";
			while ($row = $result->fetch_object()){
				$line = "";
				$comma = "";
				$line .= $comma . '"' .  $row->date_time . '"';
				
				$comma = ",";
				$line .= $comma . '"' .  $row->highTempMax . '"';
				
				$comma = ",";
				$line .= $comma . '"' .   $row->highTempMin . '"';
				
				$comma = ",";
				$line .= $comma . '"' .  $row->lowTempMax . '"';
				
				$comma = ",";
				$line .= $comma . '"' .   $row->lowTempMin . '"';
			
				$line .= "\n";
				fputs($fp, $line);
			}
		
			fclose($fp);
			
			header("Content-Disposition: attachment; filename=$filename");
			header("Content-Disposition: attachment; filename=$filename");
			readfile($filename);
			unlink($filename);
			
			
		
	
	
	
	

?>
