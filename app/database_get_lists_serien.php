<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 10.01.2018
 * Time: 14:43
 */

session_start();

require_once "database_connection.php";


$query = "select * from serieslist where fk_user=".$_SESSION['userID'];

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
    echo false;
}