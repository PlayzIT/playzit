<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 10.01.2018
 * Time: 09:33
 */


/**
 * INPUTS:
 *
 * listId
 * seriesId
 * state
 *
 *
 */
session_start();
require_once "database_connection.php";

$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0) {
##
    $now = getdate();
    $dateTimeString = date("Y-m-d H:i:s");

    $query = "select favourite from serieslist where SL_ID = " . $data->listId . ";";

    if($data->state !== "series") {
        if ($result = mysqli_query($mysqli, $query)) {
            if (mysqli_num_rows($result) > 0) {
                $output = mysqli_fetch_array($result);

                if (!$output[0]) {
                    $statement['list'] = "DELETE FROM serieslist where SL_ID=" . $data->listId . ";";

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
    }else if($data->state == "series"){
        $statement['series'] = "DELETE FROM sPartOfSL where (SList_ID=" . $data->listId . ") AND (Series_ID=" . $data->seriesId . ");";

        $query = $statement[$data->state];

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
