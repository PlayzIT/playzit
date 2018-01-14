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


				$favListQueryG = "INSERT into gamelist(`GListName`, `privat`, `descr`, `fk_user`, `favourite`) values(?, true, ?, ?, true);";
				if($result3=$mysqli->prepare($favListQueryG)){
				    $listname=$nickname."s Favoriten";
				    $descr = "automatisch erstellte Liste";
				    $result3->bind_param('ssi', $listname, $descr, $userID);
                    $result3->execute();
                    $result3->fetch();
                    $result3->close();
                }

                $favListQueryS = "INSERT into serieslist(`SListName`, `privat`, `descr`, `fk_user`, `favourite`) values(?, true, ?, ?, true);";
                if($result4=$mysqli->prepare($favListQueryS)){
                    $listname=$nickname."s Favoriten";
                    $descr = "automatisch erstellte Liste";
                    $result4->bind_param('ssi', $listname, $descr, $userID);
                    $result4->execute();
                    $result4->fetch();
                    $result4->close();
                }




/*
 *
 * CREATE TABLE IF NOT EXISTS serieslist(
  SL_ID INT NOT NULL AUTO_INCREMENT,
  SListName VARCHAR(20),
  privat BOOL,
  descr VARCHAR(100),
  fk_user INT NOT NULL,
  favourite BOOL,
  PRIMARY KEY(SL_ID),
  CONSTRAINT FK_userConsSList FOREIGN KEY (fk_user)
    REFERENCES user(user_id)
);
CREATE TABLE IF NOT EXISTS gamelist(
  GL_ID INT NOT NULL AUTO_INCREMENT,
  GListName VARCHAR(20),
  privat BOOL,
  descr VARCHAR(100),
  fk_user INT NOT NULL,
  favourite BOOL,
  PRIMARY KEY(GL_ID),
    CONSTRAINT FK_userConsGList FOREIGN KEY (fk_user)
    REFERENCES user(user_id) ON DELETE NO ACTION
);

 */







				echo true;
			}else{
				echo false;
			}
		}else{
			
			echo false;
		}
	}



