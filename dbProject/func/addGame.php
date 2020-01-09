<?php
include_once "../db_conn.php";
session_start();
if (isset($_POST["gameName"]) and isset($_POST["gameType"]) and isset($_POST["gameRating"])){
      if(!empty($_POST["gameName"]) and !empty($_POST["gameType"]) and !empty($_POST["gameRating"])){
      	echo $_POST["gameName"];
      	echo $_POST["gameType"];
      	echo $_POST["gameRating"];
      	//檢查該遊戲是否已存在
      	$query = ('select Name from game where Name = ?');
      	$stmt = $db->prepare($query);
      	$stmt->execute(array($_POST["gameName"]));
      	$result = $stmt->fetchAll();
      	echo "count = ".count($result);
      	if(count($result) == 0){
      		//insert
        	$query = ('insert into game values(?,?,?,?)');
        	$stmt = $db->prepare($query);
        	$stmt->execute(array($_POST["gameName"],$_POST["gameType"],$_POST["gameRating"],0));
        	$_SESSION['addgame'] = "成功新增遊戲";
        	//echo "success";
      	}
      	else{
      		$_SESSION['addgame'] = "該遊戲已存在";
      		//echo"already exist";
      	}
      }
      else{
        $_SESSION['addgame'] = "請確實填寫所有攔位";
      } 
}
header("Location: ../addgame.php");
?>