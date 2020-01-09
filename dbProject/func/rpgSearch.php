<?php
  include_once "../db_conn.php";
  session_start();
  //isset($_POST["rpgSearch"]) and 
  if (isset($_POST["rpgSearch"]) and !empty($_POST["rpgSearch"]))
	{
      $_SESSION['showRPGSearch'] = True;
      $_SESSION['rpgSearch'] = $_POST["rpgSearch"];
      //echo "ypoooooooo";
	} 
	else 
	{
      $_SESSION['showRPGSearch'] = False;   
      //echo "in else";
	}
  
  header("Location: ../rpg.php");
?>