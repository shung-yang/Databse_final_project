
<?php
	$user = 'root';
	$password = 'xampp';
	try{
		$db = new PDO('mysql:host=127.0.0.1;dbname=game_wiki;charset=utf8',$user,$password);
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
	}catch(PDOException $e){
		Print "ERROR!:" . $e->message();
		die();
	}
?>
