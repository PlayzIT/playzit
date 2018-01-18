<?php
// The request is a JSON request.
// We must read the input.
// $_POST or $_GET will not work!

	include_once "database_connection.php";
	
	$data = json_decode(file_get_contents("php://input"));
	
	// perform query or whatever you wish, sample:
	if (count($data) > 0) {
		
		$suche = mysqli_real_escape_string($mysqli, $data->suche);
		$typ = mysqli_real_escape_string($mysqli, $data->typ);
		
		if ($typ === "game") {
			$query = "SELECT * FROM game WHERE G_Name like '$suche' group by G_Name";
		} else {
			$query = "SELECT * FROM series WHERE S_Name LIKE '$suche' group by S_Name";
		}
		
		
		$output = array();
		
		$result = $mysqli->query($query);
	
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_array($result)) {
				$output[] = $row;
			}
			echo json_encode($output);
		}
	}
	
	/*

// Static array for this demo
	$values = array('php', 'web', 'angularjs', 'js','mysql');

// Check if the keywords are in our array
	if(in_array($objData->data, $values)) {
		echo 'I have found what you\'re looking for!';
	}
	else {
		echo 'Sorry, no match!';
	}*/