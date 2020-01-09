<?php
  include_once "../db_conn.php";
  session_start();
  //isset($_POST["rpgSearch"]) and 
  if (isset($_POST["fpsSearch"]) and !empty($_POST["fpsSearch"]))
	{
      $_SESSION['showFPSSearch'] = True;
      $_SESSION['fpsSearch'] = $_POST["fpsSearch"];
      //echo "ypoooooooo";
	} 
	else 
	{
      $_SESSION['showFPSSearch'] = False;   
      //echo "in else";
	}
  
    header("Location: ../fps.php");
    //用session將一判定變數值更改，並於前頁加一if檢測此變數，看表格是要顯示全部還是search結果
?>