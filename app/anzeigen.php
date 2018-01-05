<?php
	session_start();
	
	include_once "database_connection.php";
	
	//echo $_SESSION['benutzername'] . " " . $_SESSION['userID'];
	
	if(isset($_SESSION['benutzername']) && isset($_SESSION['userID'])) {
		
		$nickname = mysqli_real_escape_string($mysqli, $_SESSION['benutzername']);
		$userID = mysqli_real_escape_string($mysqli, $_SESSION['userID']);
		$output = array();
		
		$query = "SELECT * FROM User where nickname='$nickname' and user_id='$userID'";
		$result = mysqli_query($mysqli, $query);
		
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_array($result)) {
				$output[] = $row;
			}
			
			echo json_encode($output);
		}else{
			echo false;
		}
	}else{
		echo false;
	}
?>