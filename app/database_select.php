<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 14.12.2017
 * Time: 14:51
 */

session_start();
require_once "database_connection.php";

$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0) {


    //$query = $data->query;
    $query = $data->query;
    $result = mysqli_query($mysqli, $query);


    if (mysqli_num_rows($result) > 0) {
        //echo $result;
        //echo "success: true";

        $output = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                array_push($output, $row);
            }

            echo json_encode($output);
        }

    } else {
        echo "{success: false}";
    }
}