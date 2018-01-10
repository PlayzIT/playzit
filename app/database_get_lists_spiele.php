<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 08.01.2018
 * Time: 12:22
 */
require_once "database_connection.php";

session_start();
$query = "select * from gamelist where fk_user=".$_SESSION['userID'].";";
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