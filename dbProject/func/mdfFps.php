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
		$query = ('select * from game where Name = ? and Type <> "FPS"');
        $stmt = $db->prepare($query);
        $stmt->execute(array($_POST["mdfname"]));
        $result = $stmt->fetchAll();
        if(count($result) != 0){
            $_SESSION['mdffps'] = "該遊戲已存在於其他類型的表格中";
            $cantchg = true;
        }
	}
	if($oldname != $_POST["mdfname"] || $oldwebsite != $_POST["mdfwebsite"]){
		$query = ('select * from fps where Name = ? and Website = ?;');
    	$stmt = $db->prepare($query);
    	$stmt->execute(array($_POST["mdfname"],$_POST["mdfwebsite"]));
    	$result = $stmt->fetchAll();
    	if(count($result) != 0){
      	 $_SESSION['mdffps'] = "該遊戲資源已存在";
      	 $cantchg = true;
    	}
	}

	
	if(!$cantchg){
	if($_POST["oldurl"] != $_POST["mdfurl"]){
		$query = ('update fps set URL = ? where Name = ? and Website = ?;');
		$stmt = $db->prepare($query);
    	$stmt->execute(array($_POST["mdfurl"],$oldname,$oldwebsite));
	}

	if($_POST["oldrsc"] != $_POST["mdfrsc"]){
		$query = ('update fps set Resource = ? where Name = ? and Website = ?;');
		$stmt = $db->prepare($query);
    	$stmt->execute(array($_POST["mdfrsc"],$oldname,$oldwebsite));
	}
	
	if($oldwebsite != $_POST["mdfwebsite"]){
		$query = ('update fps set Website = ? where Name = ? and Website = ?;');
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
        	$query = ('update fps set Name = ? where Name = ? and Website = ?;');
		    $stmt = $db->prepare($query);
    	    $stmt->execute(array($_POST["mdfname"],$oldname,$_POST["mdfwebsite"]));

        	$query = ('update game set Resource_num = Resource_num + 1 where Name = ?;');
    		$stmt = $db->prepare($query);
    		$stmt->execute(array($_POST["mdfname"]));
        }
        else{
        	$query = ('delete from fps where Name = ? and Website = ?');
    		$stmt = $db->prepare($query);
    		$stmt->execute(array($oldname,$_POST["mdfwebsite"]));

    		$query = ('insert into fps values(?,?,?,?)');
        	$stmt = $db->prepare($query);
        	$stmt->execute(array($_POST["mdfname"],$_POST["mdfwebsite"],$_POST["mdfurl"],$_POST["mdfrsc"]));

        }
	}
    }
    header("Location: ../mdffps.php");

    ///if()
?>