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

    $now = getdate();
    $dateTimeString = date("Y-m-d H:i:s");


    $statement['list']="DELETE FROM serieslist where SL_ID=".$data->listId.";";
    $statement['series']="DELETE FROM sPartOfSL where (SList_ID=".$data->listId.") AND (Series_ID=".$data->seriesId.");";

    $query=$statement[$data->state];



    if($stmt = $mysqli->prepare($query)){
        $stmt->execute();
        $stmt->fetch();
        $stmt->close();
        echo json_encode("{success: true}");
    }



}
