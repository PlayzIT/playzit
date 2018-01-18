<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 10.01.2018
 * Time: 09:17
 **/


/**
 * INPUTS:
 *
 * listId
 * gameId
 * state
 *
 *
 */
session_start();
require_once "database_connection.php";

$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {

    $now = getdate();
    $dateTimeString = date("Y-m-d H:i:s");

    $query = "select favourite from gamelist where GL_ID = " . $data->listId . ";";

    if($data->state !== "game") {
        if ($result = mysqli_query($mysqli, $query)) {
            if (mysqli_num_rows($result) > 0) {
                $output = mysqli_fetch_array($result);

                if (!$output[0]) {
                    $statement['list'] = "DELETE FROM gamelist where GL_ID=" . $data->listId . ";";

                    $query = $statement[$data->state];

                    //echo $query;

                    if ($stmt = $mysqli->prepare($query)) {
                        $stmt->execute();
                        $stmt->fetch();
                        $stmt->close();
                        echo true;
                    } else {
                        echo false;
                    }
                } else {
                    echo 'istFavorit';
                }
            } else {
                echo "{success: false}";
            }
        }

    }else if ($data->state == "game") {
        $statement['game'] = "DELETE FROM gPartOfGL where (GList_ID=" . $data->listId . ") AND (Game_ID=" . $data->gameId . ");";

        $query = $statement[$data->state];

        //echo $query;

        if ($stmt = $mysqli->prepare($query)) {
            $stmt->execute();
            $stmt->fetch();
            $stmt->close();
            echo true;
        } else {
            echo false;
        }
    }


}else{
    echo false;
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