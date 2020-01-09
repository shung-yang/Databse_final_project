<?php
	include_once "../db_conn.php";
	session_start();
	echo $_POST["mdfgame"];
	echo $_POST["mdftype"];
	echo $_POST["mdfwhichgame"];

	//檢查更改後的name是否已存在
    if($_POST["mdfgame"] != $_POST["mdfwhichgame"]){
        
        $query = ('select * from game where Name = ?');
        $stmt = $db->prepare($query);
        $stmt->execute(array($_POST["mdfgame"]));
        $result = $stmt->fetchAll();
        if(count($result) != 0){
            $_SESSION['mdfgame'] = "該遊戲已存在";
            header("Location: ../mdfgame.php");
        }
    }

    //有改到type
    if(!empty($_POST["mdftype"])){
        list($oldtype,$newtype) = explode('|', $_POST["mdftype"]);
        if ($oldtype != $newtype){
            
            //insert oldsrc into newtype
            $query = ('select * from '.strtolower($oldtype).' where Name = ?');
            $stmt = $db->prepare($query);
            $stmt->execute(array($_POST["mdfwhichgame"]));
            $result = $stmt->fetchAll();
            
            for($i=0; $i<count($result); $i++){
                 $query = ('insert into '.strtolower($newtype).' values(?,?,?,?)');
                $stmt = $db->prepare($query);
                $stmt->execute(array($_POST["mdfwhichgame"],$result[$i]['Website'],$result[$i]['URL'],$result[$i]['Resource']));
            }

             //insert trigger 會自動增加resource num，所以要扣掉多增加的部分
             $query = ('update game set Resource_num = Resource_num - '.count($result).' where Name = ?');
             $stmt = $db->prepare($query);
             $stmt->execute(array($_POST["mdfwhichgame"]));
             //delete from original
            $query = ('delete from '.strtolower($oldtype).' where Name = ?');
            $stmt = $db->prepare($query);
            $stmt->execute(array($_POST["mdfwhichgame"]));
            //update game relation
            $query = ('update game set Type = "'.$newtype.'" where Name = ?');
            $stmt = $db->prepare($query);
            $stmt->execute(array($_POST["mdfwhichgame"])); 
        }
    }

    //有改到Rating
    if(!empty($_POST["mdfrating"])){
        list($oldrating,$newrating) = explode('|', $_POST["mdfrating"]);
        if(!empty($_POST["mdfrating"]) && $oldrating != $newrating){
            $query = ('update game set Rating = '.$newrating.' where Name = ?');
            $stmt = $db->prepare($query);
            $stmt->execute(array($_POST["mdfwhichgame"]));
        }
    }

	//有改到name
	if($_POST["mdfgame"] != $_POST["mdfwhichgame"]){
			//update 
			$query = ('update game set Name = ? where Name = ?');
    		$stmt = $db->prepare($query);
    		$stmt->execute(array($_POST["mdfgame"],$_POST["mdfwhichgame"]));
    		//$_SESSION['mdfgame'] = "已更新";
    }
    
    

	header("Location: ../mdfgame.php");
?>