<?php
	require("includes/db_connection.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>View list</title>
</head>

<body>
	<table border=1>
		<tr>
			<th align="left" width="200">Timestamp </th>
			<th align="left" width="100">High Temp Max</th>
			<th align="left" width="100">High Temp Min</th>
			<th align="left" width="100">Low Temp Max</th>
			<th align="left" width="100">Low Temp Min</th>
		</tr>
		<?php
			$sql = "SELECT * FROM tap_sensor";
			$result = $connection1->query($sql);
			while ($row = $result->fetch_object()){
				echo "<tr>";
					echo "<td>" . $row->date_time . "</td>";
					echo "<td>" . $row->highTempMax . "</td>";
					echo "<td>" . $row->highTempMin . "</td>";
					echo "<td>" . $row->lowTempMax . "</td>";
					echo "<td>" . $row->lowTempMin . "</td>";
				echo "</tr>";
			}
		?>
	<table>

</body>

</html>
