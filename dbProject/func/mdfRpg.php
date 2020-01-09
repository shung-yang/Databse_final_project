<?php
	include_once "../db_conn.php";
	session_start();
	echo $_POST["mdfname"]."<br>";
	echo $_POST["mdfwebsite"]."<br>";
	echo $_POST["mdfurl"]."<br>";
	echo $_POST["mdfrsc"]."<br>";
	echo $_POST["oldurl"]."<br>";
	echo $_POST["oldrsc"]."<br>";
	echo $_POST["mdfwhichrsc"];
    $cantchg = false;
    
	list($oldname,$oldwebsite) = explode('|', $_POST["mdfwhichrsc"]);
	if($oldname != $_POST["mdfname"]){
		$query = ('select * from game where Name = ? and Type <> "RPG"');
        $stmt = $db->prepare($query);
        $stmt->execute(array($_POST["mdfname"]));
        $result = $stmt->fetchAll();
        if(count($result) != 0){
            $_SESSION['mdfrpg'] = "該遊戲已存在於其他類型的表格中";
            $cantchg = true;
        }
	}
	if($oldname != $_POST["mdfname"] || $oldwebsite != $_POST["mdfwebsite"]){
		$query = ('select * from rpg where Name = ? and Website = ?;');
    	$stmt = $db->prepare($query);
    	$stmt->execute(array($_POST["mdfname"],$_POST["mdfwebsite"]));
    	$result = $stmt->fetchAll();
    	if(count($result) != 0){
      	 $_SESSION['mdfrpg'] = "該遊戲資源已存在";
      	 $cantchg = true;
    	}
	}

	/*if($oldname != $_POST["mdfname"]){
		$query = ('select * from game where Name = ?');
        $stmt = $db->prepare($query);
        $stmt->execute(array($_POST["mdfname"]));
        $result = $stmt->fetchAll();
        if(count($result) != 0){
            $_SESSION['mdfrpg'] = "該遊戲已存在";

            header("Location: ../mdfrpg.php");
        }
	}*/
	if(!$cantchg){
	if($_POST["oldurl"] != $_POST["mdfurl"]){
		$query = ('update rpg set URL = ? where Name = ? and Website = ?;');
		$stmt = $db->prepare($query);
    	$stmt->execute(array($_POST["mdfurl"],$oldname,$oldwebsite));
	}

	if($_POST["oldrsc"] != $_POST["mdfrsc"]){
		$query = ('update rpg set Resource = ? where Name = ? and Website = ?;');
		$stmt = $db->prepare($query);
    	$stmt->execute(array($_POST["mdfrsc"],$oldname,$oldwebsite));
	}
	
	if($oldwebsite != $_POST["mdfwebsite"]){
		$query = ('update rpg set Website = ? where Name = ? and Website = ?;');
		$stmt = $db->prepare($query);
    	$stmt->execute(array($_POST["mdfwebsite"],$oldname,$oldwebsite));
	}
    
    if($oldname != $_POST["mdfname"]){
		

    	$query = ('update game set Resource_num = Resource_num - 1 where Name = ?;');
    	$stmt = $db->prepare($query);
    	$stmt->execute(array($oldname));

    	$query = ('select * from game where Name = ?');
        $stmt = $db->prepare($query);
        $stmt->execute(array($_POST["mdfname"]));
        $result = $stmt->fetchAll();
        if(count($result) != 0){
        	$query = ('update rpg set Name = ? where Name = ? and Website = ?;');
		    $stmt = $db->prepare($query);
    	    $stmt->execute(array($_POST["mdfname"],$oldname,$_POST["mdfwebsite"]));

        	$query = ('update game set Resource_num = Resource_num + 1 where Name = ?;');
    		$stmt = $db->prepare($query);
    		$stmt->execute(array($_POST["mdfname"]));
        }
        else{
        	$query = ('delete from rpg where Name = ? and Website = ?');
    		$stmt = $db->prepare($query);
    		$stmt->execute(array($oldname,$_POST["mdfwebsite"]));

    		$query = ('insert into rpg values(?,?,?,?)');
        	$stmt = $db->prepare($query);
        	$stmt->execute(array($_POST["mdfname"],$_POST["mdfwebsite"],$_POST["mdfurl"],$_POST["mdfrsc"]));

        }
	}
    }
    header("Location: ../mdfrpg.php");
    /*$query = ('select * from game where Name = ?;');
    $stmt = $db->prepare($query);
    $stmt->execute(array($_POST["mdfname"]));
    $result = $stmt->fetchAll();
    if(count($result) != 0){
       $_SESSION['mdfrpg'] = "該遊戲資源已存在";
       header("Location: ../mdfrpg.php");
    }*/

    ///if()
?>