<?php
	
	include_once "database_connection.php";
	
	$data = json_decode(file_get_contents("php://input"));
	
	if (count($data) > 0) {
		$nickname = mysqli_real_escape_string($mysqli, $data->username);
		$passwort = password_hash(mysqli_real_escape_string($mysqli, $data->passwort), PASSWORD_BCRYPT);
		$email = mysqli_real_escape_string($mysqli, $data->email);
		
		$query = "SELECT * FROM User where nickname='$nickname' or email='$email'";
		$result = mysqli_query($mysqli, $query);
		
		if (mysqli_num_rows($result) === 0) {
			$query = "INSERT INTO User VALUES ('$nickname', '$email', '$passwort', date('Y-m-d'))";
			$result = mysqli_query($mysqli, $query);
			
			echo "{'success': true}";
		}else{
			echo "{'success': false}";
		}
	}