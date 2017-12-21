<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 21.12.2017
 * Time: 13:26
 */

/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 18.12.2017
 * Time: 12:11
 */

session_start();
$data = json_decode(file_get_contents("php://input"));

$_SESSION['benutzername'] = "peter";
echo json_encode($_SESSION['benutzername']);