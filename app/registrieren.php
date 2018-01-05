<?php
	session_start();
	session_unset();
	
	include_once "database_connection.php";
	
	$data = json_decode(file_get_contents("php://input"));
	
	if (count($data) > 0) {
		$nickname = mysqli_real_escape_string($mysqli, $data->username);
		$passwort = password_hash(mysqli_real_escape_string($mysqli, $data->passwort), PASSWORD_BCRYPT);
		$email = mysqli_real_escape_string($mysqli, $data->email);
		$date = date("Y/m/d");
		
		$query = "SELECT * FROM user where nickname='$nickname' or email='$email'";
		$result = mysqli_query($mysqli, $query);
		
		if (mysqli_num_rows($result) === 0) {
			$query = "INSERT INTO user (`nickname`, `email`, `passwort`, `konto_erstellt_datum`) VALUES ('$nickname', '$email', '$passwort', '$date')";
			$result = mysqli_query($mysqli, $query);
			
			if($result2 = $mysqli->prepare("select user_id from user where nickname=? and email=?")) {
				$result2->bind_param('ss', $nickname, $email);
				$result2->execute();
				$result2->store_result();
				$result2->bind_result($userID);
				$result2->fetch();
				
				$_SESSION[ 'userID' ] = $userID;
				$_SESSION[ 'benutzername' ] = $nickname;
				
				echo true;
			}else{
				echo false;
			}
		}else{
			
			echo false;
		}
	}
?>