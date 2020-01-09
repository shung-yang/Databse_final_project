<?php
include_once "../db_conn.php";
session_start();
if (isset($_POST["srcgame"]) and isset($_POST["gameType"]) and isset($_POST["websiteName"]) and isset($_POST["url"]) and isset($_POST["resource"])){
      if(!empty($_POST["srcgame"]) and !empty($_POST["gameType"]) and !empty($_POST["websiteName"]) and !empty($_POST["url"]) and !empty($_POST["resource"])){
      	echo $_POST["srcgame"];
      	echo $_POST["gameType"];
      	echo $_POST["websiteName"];
        echo $_POST["url"];
        echo $_POST["resource"];
        echo strtolower($_POST["gameType"]);

      	//檢查該遊戲資源是否已存在
      	$query = ('select Name from '.strtolower($_POST["gameType"]).' where Name = ? and Website = ?;');
      	$stmt = $db->prepare($query);
      	$stmt->execute(array($_POST["srcgame"],$_POST["websiteName"]));
      	$result = $stmt->fetchAll();
      	echo "count = ".count($result);

      	if(count($result) == 0){
          $query = ('select Name from game where Name = ? and Type <> ?');
          $stmt = $db->prepare($query);
          $stmt->execute(array($_POST["srcgame"],$_POST["gameType"]));
          $result2 = $stmt->fetchAll();
          if(count($result2) == 0){
              //insert
              $query = ('insert into '.strtolower($_POST["gameType"]).' values(?,?,?,?)');
              $stmt = $db->prepare($query);
              $stmt->execute(array($_POST["srcgame"],$_POST["websiteName"],$_POST["url"],$_POST["resource"]));
              $_SESSION['addsrc'] = "成功新增遊戲資源";
              //echo "success";
          }
          else{
              $_SESSION['addsrc'] = "該遊戲已存在其他遊戲類型";
          }
      	}
      	else{
      		$_SESSION['addsrc'] = "該遊戲資源已存在";
          //echo "fail";
      	}
     
     } 
     else{
        $_SESSION['addsrc'] = "請確實填寫所有攔位";
     }
}

header("Location: ../addsrc.php");
?>