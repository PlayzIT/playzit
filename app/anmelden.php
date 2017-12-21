<?php
	session_start();
	if(isset($_SESSION['benutzername'])){
		unset($_SESSION['benutzername']);
		unset($_SESSION['userID']);
	}
	
	include_once "database_connection.php";
	
	$data = json_decode(file_get_contents("php://input"));
	
	if (count($data) > 0) {
	    $username=$data->username;
	    $password=$data->passwort;

		$nickname = mysqli_real_escape_string($mysqli, $username);
		$passwort = mysqli_real_escape_string($mysqli, $password);
		
		$query = "SELECT passwort, user_id FROM User where nickname='$nickname'";

        if ($stmt = $mysqli->prepare($query)) {
            $stmt->execute();
            $stmt->bind_result($hash, $user_id);
            $stmt->fetch();
            $stmt->close();
        }





		if (password_verify($passwort, $hash)) {
			$_SESSION['benutzername'] = $nickname;
			$_SESSION['userID'] = $user_id;
			echo true;
		}else{
			echo false;
		}
	}
