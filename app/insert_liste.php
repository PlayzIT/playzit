<?php

session_start();
require_once "database_connection.php";

if(isset($_SESSION['benutzername']) && isset($_SESSION['userID'])) {
    $data = json_decode(file_get_contents("php://input"));
    
    //json_encode(intval($data->aktuelleListe[0]->id));

    if (count($data) > 0) {
        $aktuelleListe = $data->aktuelleListe;
        $name = mysqli_real_escape_string($mysqli, $data->name);
        $privat = $data->privat == "1" ? "true" : "false";
        $description = mysqli_real_escape_string($mysqli, $data->beschreibung);
        $favourite = $data->favourite == "1" ? "true" : "false";
        $userID = intval($_SESSION[ 'userID' ]);
        $SL_or_GL_ID = 0;

        $query = $data->typ == "game" ?
            "INSERT INTO gamelist (`GListName`, `privat`, `descr`, `fk_user`, `favourite`) VALUES ('$name', $privat, '$description', $userID, $favourite)"
            :
            "INSERT INTO serieslist (`SListName`, `privat`, `descr`, `fk_user`, `favourite`) VALUES ('$name', $privat, '$description', $userID, $favourite)";

        if ($result = $mysqli->query($query)){
            $SL_or_GL_ID = $mysqli->insert_id;
            $successful = true;

            for($i = 0; $i < count($aktuelleListe); $i++) {
                $aktuelleSerie = intval($data->aktuelleListe[$i]->id);
                $query = $data->typ == "game" ?
                    "INSERT INTO gPartOfGL (`Game_ID`, `GList_ID`) VALUES ($aktuelleSerie, $SL_or_GL_ID)"
                    :
                    "INSERT INTO sPartOfSL (`Series_ID`, `SList_ID`) VALUES ($aktuelleSerie, $SL_or_GL_ID)";
                if(!$mysqli->query($query)){
                    $successful = false;
                    break;
                }
            }

            echo $successful;
        }

    }
}else{
    echo false;
}
