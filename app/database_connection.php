<?php
	$mysqli = new mysqli('localhost', 'root', '', 'pit');
	if ($mysqli->connect_error) {
		echo 'Fehler bei der Verbindung: ' . mysqli_connect_error();
		exit();
	}
	if (!$mysqli->set_charset('utf8')) {
		echo 'Fehler beim Laden von UTF8 ' . $mysqli->error;
	}
?>