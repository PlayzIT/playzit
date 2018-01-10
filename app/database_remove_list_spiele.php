<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 10.01.2018
 * Time: 09:17
 **/

session_start();
require_once "database_connection.php";

$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0) {

    $now = getdate();



    $dateTimeString = date("Y-m-d H:i:s");

    $query = "INSERT INTO gamebew(`fk_user`, `fk_game`, `datum`) VALUES (" . $_SESSION['userID'] . "," . $data->game . ",'" . $dateTimeString . "')";
    if($stmt_insert = $mysqli->prepare($query)){
        $stmt_insert->execute();
        $stmt_insert->fetch();
        $stmt_insert->close();
    }



    $select_query = "SELECT GB_ID FROM gamebew where fk_user=".$_SESSION['userID']." AND fk_game=".$data->game." AND datum='".$dateTimeString."'";

    $bewID = -1;

    if ($stmt = $mysqli->prepare($select_query)) {
        $stmt->execute();
        $stmt->bind_result($bewID);
        $stmt->fetch();
        $stmt->close();
    }

    $insert_query_grafik = "INSERT INTO gBew_ent_cat(`fk_gbew`, `fk_cat`, `bewertungsgrad`) VALUES (".$bewID.", 1, ".$data->grafik.")";
    $insert_query_gameplay = "INSERT INTO gBew_ent_cat(`fk_gbew`, `fk_cat`, `bewertungsgrad`) VALUES (".$bewID.", 2, ".$data->gameplay.")";
    $insert_query_audio = "INSERT INTO gBew_ent_cat(`fk_gbew`, `fk_cat`, `bewertungsgrad`) VALUES (".$bewID.", 3, ".$data->audio.")";
    $insert_query_steuerung = "INSERT INTO gBew_ent_cat(`fk_gbew`, `fk_cat`, `bewertungsgrad`) VALUES (".$bewID.", 4, ".$data->steuerung.")";
    $insert_query_charaktere = "INSERT INTO gBew_ent_cat(`fk_gbew`, `fk_cat`, `bewertungsgrad`) VALUES (".$bewID.", 5, ".$data->charaktere.")";
    $insert_query_story = "INSERT INTO gBew_ent_cat(`fk_gbew`, `fk_cat`, `bewertungsgrad`) VALUES (".$bewID.", 6, ".$data->story.")";

    mysqli_query($mysqli, $insert_query_grafik);
    mysqli_query($mysqli, $insert_query_gameplay);
    mysqli_query($mysqli, $insert_query_audio);
    mysqli_query($mysqli, $insert_query_steuerung);
    mysqli_query($mysqli, $insert_query_charaktere);
    mysqli_query($mysqli, $insert_query_story);




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