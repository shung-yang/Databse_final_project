<?php
	include_once "../db_conn.php";
	
	echo  "delwhich = ".$_POST["delgame"];

	$query = ('delete from game where Name = ?');
    $stmt = $db->prepare($query);
    $stmt->execute(array($_POST["delgame"]));

    //foreigen key cascade
    /*$query = ('update game set Resource_num = Resource_num - 1  where Name = ?');
    $stmt = $db->prepare($query);
    $stmt->execute(array($name));*/
    header("Location: ../delgame.php");
?>