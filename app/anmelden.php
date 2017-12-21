<?php
	session_start();
	if(isset($_SESSION['benutzername'])){
		unset($_SESSION['benutzername']);
		unset($_SESSION['userID']);
	}
	
	include_once "database_connection.php";
	
	$data = json_decode(file_get_contents("php://input"));
	
	if (count($data) > 0) {
		$nickname = mysqli_real_escape_string($mysqli, $data->username);
		$passwort = password_hash(mysqli_real_escape_string($mysqli, $data->passwort), PASSWORD_BCRYPT);
		
		$query = "SELECT * FROM User where nickname='$nickname' and passwort='$passwort'";
		$result = mysqli_query($mysqli, $query);
		
		if (mysqli_num_rows($result) > 0) {
			$_SESSION['benutzername'] = $nickname;
			$_SESSION['userID'] = $user_id;
			echo "{success: true}";
		}else{
			echo "{success: false}";
		}
	}
