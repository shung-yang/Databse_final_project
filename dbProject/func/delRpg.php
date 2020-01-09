<?php
	include_once "../db_conn.php";
	list($name,$website) = explode('|', $_POST["delrpg"]);
	echo "name = ".$name;
	echo "website = ".$website;

	$query = ('delete from rpg where Name = ? and Website = ?');
    $stmt = $db->prepare($query);
    $stmt->execute(array($name,$website));

    $query = ('update game set Resource_num = Resource_num - 1  where Name = ?');
    $stmt = $db->prepare($query);
    $stmt->execute(array($name));
    header("Location: ../delrpg.php");
?>