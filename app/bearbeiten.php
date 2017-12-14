<?php
	include_once "database_connection.php";
	
	$data = json_decode(file_get_contents("php://input"));
	

	if (count($data) > 0) {
		$updateTo = "";
		$whatToUpdate = "";
		
		if(property_exists($data, 'nickname')){
			$updateTo = mysqli_real_escape_string($mysqli, $data->nickname);
			$whatToUpdate = "nickname";
		}else if(property_exists($data, 'email')){
			$updateTo = mysqli_real_escape_string($mysqli, $data->email);
			$whatToUpdate = "email";
		}else if(property_exists($data, 'passwort')){
			$updateTo = password_hash(mysqli_real_escape_string($mysqli, $data->passwort), PASSWORD_BCRYPT);
			$whatToUpdate = "passwort";
		}
		
		/*$nickname = mysqli_real_escape_string($mysqli, $data->nickname);
		$email = mysqli_real_escape_string($mysqli, $data->email);
		$passwort = mysqli_real_escape_string($mysqli, $data->passwort);
		$btn_name = $data->btnName;*/
			$query = "UPDATE User SET $whatToUpdate = '$updateTo'";
			if (mysqli_query($mysqli, $query)) {
				echo 'Updated Successfully...';
			} else {
				echo 'Failed';
			}
	}
	?>
 