<?php
/**
 * Created by IntelliJ IDEA.
 * User: hofma
 * Date: 18.12.2017
 * Time: 12:23
 */
session_start();
require_once "database_connection.php";

$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0) {

    $now = getdate();



    $dateTimeString = date("Y-m-d H:i:s");
$content = htmlspecialchars($data->content);

    $query = "INSERT INTO gamecomment(`fk_user`, `fk_game`, `datum`, `content`) VALUES (" . $_SESSION['userID'] . "," . $data->game . ",'" . $dateTimeString . "','".$content."')";
    echo $query;
    if ($stmt_insert = $mysqli->prepare($query)) {
        $stmt_insert->execute();
        $stmt_insert->fetch();
        $stmt_insert->close();
        echo json_encode('{success: true}');
    }else{
        echo json_encode("{success: false}");
    }



}

/*
 * CREATE TABLE IF NOT EXISTS gamecomment(
  gcommentID INT AUTO_INCREMENT NOT NULL,
  fk_user INT,
  fk_antwort INT,
  content VARCHAR(1000),
  fk_game INT,
  datum DATETIME,
  PRIMARY KEY(gcommentID),
  CONSTRAINT FK_userConsGComm FOREIGN KEY (fk_user)
    REFERENCES user(user_id),
  CONSTRAINT FK_antwortConsGComm FOREIGN KEY (fk_antwort)
    REFERENCES gamecomment(gcommentID),
  CONSTRAINT FK_gameConsGComm FOREIGN KEY (fk_game)
    REFERENCES game(G_ID)
)engine=memory;

 */