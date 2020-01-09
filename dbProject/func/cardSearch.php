<?php
  include_once "../db_conn.php";
  session_start();
  //isset($_POST["rpgSearch"]) and 
  if (isset($_POST["cardSearch"]) and !empty($_POST["cardSearch"]))
	{
      $_SESSION['showCardSearch'] = True;
      $_SESSION['cardSearch'] = $_POST["cardSearch"];
      //echo "ypoooooooo";
	} 
	else 
	{
      $_SESSION['showCardSearch'] = False;   
      //echo "in else";
	}
  
    header("Location: ../card.php");
    //用session將一判定變數值更改，並於前頁加一if檢測此變數，看表格是要顯示全部還是search結果
?>