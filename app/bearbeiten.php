<?php
	session_start();
	
	include_once "database_connection.php";
	
	$data = json_decode(file_get_contents("php://input"));
	
	/*Falls irgendein Knecht glaubt, diese Seite manuell aufrufen zu müssen, auch wenn er nicht
	angemeldet ist, dann kommt er nicht durch*/
	if (count($data) > 0 && isset($_SESSION['userID'])) {
		$whatToUpdate = mysqli_real_escape_string($mysqli, $data->whatToUpdate);
		$updateTo = $whatToUpdate !== "passwort" ? mysqli_real_escape_string($mysqli, $data->eingabe) :
					password_hash(mysqli_real_escape_string($mysqli, $data->eingabe), PASSWORD_BCRYPT);
		$userID = $_SESSION['userID'];
		
		/*Falls was geupdatet werden soll, ein Passwort ist, darf nicht überprüft werden, ob es schon
		existiert, weil das Passwort nicht unique ist (wäre auch komplett be*****rt, wenn es das wäre)*/
		if($whatToUpdate !== "passwort") {
			
			$query = "SELECT * from User WHERE $whatToUpdate = '$updateTo'";
			
			//Falls der Benutzername nicht existiert, darf der User diesen annehmen
			if (mysqli_num_rows(mysqli_query($mysqli, $query)) == 0) {
				$query = "UPDATE User SET $whatToUpdate = '$updateTo' where user_id = $userID";
				if ($whatToUpdate === trim("nickname")) {
					$_SESSION[ 'benutzername' ] = $updateTo;
				}
				echo mysqli_query($mysqli, $query) ? 1 : 0;
			} else {
				echo 0;
			}
		
		//Das wird ausgeführt, wenn der Benutzer sein Passwort bearbeiten möchte.
		}else{
			$query = "UPDATE User SET passwort = '$updateTo' where user_id = $userID";
			echo mysqli_query($mysqli, $query) ? 1 : 0;
		}
		
	}else{
		echo 0;
	}
?>
 