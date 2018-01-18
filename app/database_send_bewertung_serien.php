<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 02.01.2018
 * Time: 11:23
 */

session_start();
require_once "database_connection.php";

$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0) {

    $now = getdate();



    $dateTimeString = date("Y-m-d H:i:s");

    $query = "INSERT INTO seriesbew(`fk_user`, `fk_series`, `datum`) VALUES (" . $_SESSION['userID'] . "," . $data->serie . ",'" . $dateTimeString . "')";
    if($stmt_insert = $mysqli->prepare($query)){
        $stmt_insert->execute();
        $stmt_insert->fetch();
        $stmt_insert->close();
    }



    $select_query = "SELECT SB_ID FROM seriesbew where fk_user=".$_SESSION['userID']." AND fk_series=".$data->serie." AND datum='".$dateTimeString."';";

    $bewID = -1;

    if ($stmt = $mysqli->prepare($select_query)) {
        $stmt->execute();
        $stmt->bind_result($bewID);
        $stmt->fetch();
        $stmt->close();
    }

    $insert_query_schnitt = "INSERT INTO sBew_ent_cat(`fk_sbew`, `fk_cat`, `bewertungsgrad`) VALUES (".$bewID.", 7, ".$data->schnitt.")";
    $insert_query_kamera = "INSERT INTO sBew_ent_cat(`fk_sbew`, `fk_cat`, `bewertungsgrad`) VALUES (".$bewID.", 8, ".$data->kamera.")";
    $insert_query_darsteller = "INSERT INTO sBew_ent_cat(`fk_sbew`, `fk_cat`, `bewertungsgrad`) VALUES (".$bewID.", 9, ".$data->darsteller.")";
    $insert_query_story = "INSERT INTO sBew_ent_cat(`fk_sbew`, `fk_cat`, `bewertungsgrad`) VALUES (".$bewID.", 6, ".$data->story.")";
    $insert_query_effekte = "INSERT INTO sBew_ent_cat(`fk_sbew`, `fk_cat`, `bewertungsgrad`) VALUES (".$bewID.", 10, ".$data->effekte.")";
    $insert_query_audio = "INSERT INTO sBew_ent_cat(`fk_sbew`, `fk_cat`, `bewertungsgrad`) VALUES (".$bewID.", 3, ".$data->audio.")";
    $insert_query_genre = "INSERT INTO sBew_ent_cat(`fk_sbew`, `fk_cat`, `bewertungsgrad`) VALUES (".$bewID.", 11, ".$data->genre.")";

    //echo $data->schnitt . " " . $data->kamera . " " . $data->darsteller . " " . $data->story . " " . $data->effekte . " " . $data->audio . " " . $data->genre;

    echo $bewID;
    mysqli_query($mysqli, $insert_query_schnitt);
    mysqli_query($mysqli, $insert_query_kamera);
    mysqli_query($mysqli, $insert_query_darsteller);
    mysqli_query($mysqli, $insert_query_story);
    mysqli_query($mysqli, $insert_query_effekte);
    mysqli_query($mysqli, $insert_query_audio);
    mysqli_query($mysqli, $insert_query_genre);



    /*
     * (1,'grafik','games')
     * ,(2,'gameplay','games'),
     * (3,'audio','both'),
    (4,'steuerung','series'),
    (5,'charaktere','games')
    ,(6,'story','games'),
    (7,'schnitt','series')
    ,(8,'kamera','series'),
    (9,'darsteller','series')
    ,(10,'effekte','series'),
    (11,'genre','series')
     *
     */




    /*
        if (mysqli_num_rows($result) > 0) {
            echo "{success: true}";

        } else {
            echo "{success: false}";
        }*/
}


/*
CREATE TABLE IF NOT EXISTS gBew_ent_cat(
	fk_gbew INT REFERENCES gamebew(GB_ID),
    fk_cat INT REFERENCES categories(cat_ID),
    bewertungsgrad INT,
    PRIMARY KEY(fk_gbew,fk_cat),
	CONSTRAINT FK_gbewConsGBEC FOREIGN KEY (fk_gbew)
    REFERENCES gamebew(GB_ID),
	CONSTRAINT FK_catConsGBEC FOREIGN KEY (fk_cat)
    REFERENCES categories(cat_id)
);




CREATE TABLE IF NOT EXISTS gamebew(
  GB_ID INT NOT NULL AUTO_INCREMENT,
  fk_user INT,
  fk_game INT,
  datum DATETIME,
  PRIMARY KEY(GB_ID),
    CONSTRAINT FK_userConsGBew FOREIGN KEY (fk_user)
    REFERENCES user(user_id),
    CONSTRAINT FK_gameConsGBew FOREIGN KEY (fk_game)
    REFERENCES game(G_ID)
);




 */