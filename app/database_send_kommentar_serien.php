<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 08.01.2018
 * Time: 09:48
 */

session_start();
require_once "database_connection.php";

$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0) {

    $now = getdate();



    $dateTimeString = date("Y-m-d H:i:s");


    $query = "INSERT INTO seriescomment(`fk_user`, `fk_serie`, `datum`, `content`) VALUES (" . $_SESSION['userID'] . "," . $data->series . ",'" . $dateTimeString . "','".$data->content."')";
    if ($stmt_insert = $mysqli->prepare($query)) {
        $stmt_insert->execute();
        $stmt_insert->fetch();
        $stmt_insert->close();
        echo json_encode("{success:true}");
    }else{
        echo json_encode("{success:false}");
    }



}/*
CREATE TABLE IF NOT EXISTS seriescomment(
    scommentID INT AUTO_INCREMENT NOT NULL,
  fk_user INT,
  fk_antwort INT,
  content VARCHAR(1000),
  fk_serie INT,
  datum DATETIME,
  PRIMARY KEY(scommentID),
  CONSTRAINT FK_userConsSComm FOREIGN KEY (fk_user)
    REFERENCES user(user_id),
  CONSTRAINT FK_antwortConsSComm FOREIGN KEY (fk_antwort)
    REFERENCES seriescomment(scommentID),
  CONSTRAINT FK_seriesConsSComm FOREIGN KEY (fk_serie)
    REFERENCES series(S_ID)
)*/