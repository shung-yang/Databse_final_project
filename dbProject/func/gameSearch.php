<?php
  include_once "../db_conn.php";
  session_start();
  //isset($_POST["rpgSearch"]) and 
  if (isset($_POST["gameSearch"]) and !empty($_POST["gameSearch"]))
	{
      $_SESSION['showGAMESearch'] = True;
      $_SESSION['gameSearch'] = $_POST["gameSearch"];
      //echo "ypoooooooo";
	} 
	else 
	{
      $_SESSION['showGAMESearch'] = False;   
      //echo "in else";
	}
  
    header("Location: ../game.php");
    //用session將一判定變數值更改，並於前頁加一if檢測此變數，看表格是要顯示全部還是search結果
?>