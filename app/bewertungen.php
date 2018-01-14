<?php
// The request is a JSON request.
// We must read the input.
// $_POST or $_GET will not work!

	require_once "database_connection.php";

	$data = json_decode(file_get_contents("php://input"));

	// perform query or whatever you wish, sample:
	if (count($data) > 0) {

		$id = mysqli_real_escape_string($mysqli, $data->id);
		$typ = mysqli_real_escape_string($mysqli, $data->typ);
		$query = "";
		if ($typ === "game") {
			$query =
			"select user.nickname, gamebew.fk_game, gBew_ent_cat.bewertungsgrad, categories.cat_name from gamebew
            	join gBew_ent_cat on (gBew_ent_cat.fk_gbew = gamebew.GB_ID)
                join categories on (categories.cat_ID = gBew_ent_cat.fk_cat)
                join user on (gamebew.fk_user = user.user_id)
                where gamebew.fk_game = '$id'";
		} else {
			$query ="select user.nickname, seriesbew.fk_series, sBew_ent_cat.bewertungsgrad, categories.cat_name from seriesbew
            	join sBew_ent_cat on (sBew_ent_cat.fk_sbew = seriesbew.SB_ID)
                join categories on (categories.cat_ID = sBew_ent_cat.fk_cat)
                join user on (seriesbew.fk_user = user.user_id)
                where seriesbew.fk_series = '$id'";
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