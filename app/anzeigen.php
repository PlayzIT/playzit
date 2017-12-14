<?php
	
	include_once "database_connection.php";
	
	$data    = json_decode(file_get_contents("php://input"));
	
	if (count($data) > 0) {
		$nickname = mysqli_real_escape_string($mysqli, $data->nickname);
		$output = array();
		$query = "SELECT * FROM User where nickname='$nickname'";
		
		$result = mysqli_query($mysqli, $query);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_array($result)) {
				$output[] = $row;
			}
			echo json_encode($output);
		}
	}
		?>