<?php
  session_start();
?>

<html>
<head>
	<title>game.php</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <style type="text/css">
    #fixheight{
      padding-top: 0px;
      padding-bottom: 0px;
    }
    #fixsearch{
      margin-top: 10px;
      margin-bottom: 10px;
    }
    .chgbtn{
      display:inline-block;
      float:left;
      background-color: #ffffff;
      border: none; /* Remove borders */
      color: gray; /* White text */
      padding: 12px 12px; /* Some padding */
      margin-right:5px;
      cursor: pointer; /* Mouse pointer on hover */
      height:70px;
      width:70px;
    }
    .chgbtn:hover{
      background-color: rgba(211,211,211,0.2);
    }
    i{
      width:100%;
      height:100%;
      font-size:6em;
    }
    .ad_del_a{
      position:relative;
      padding:0px;
      top:-45px;
      height:50px;
      z-index:50;
    }
  </style>
</head>
<body>
	<nav id="fixheight" class="navbar navbar-expand-lg navbar-light bg-light">
  		<div class="collapse navbar-collapse" id="navbarNavDropdown">
    		<ul class="navbar-nav">
      			<li class="nav-item">
        			<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      			</li>
            <li class="nav-item active">
              <a class="nav-link" href="game.php">GAME</a>
            </li>
      			<li class="nav-item">
        			<a class="nav-link" href="fps.php">FPS</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="card.php">Card</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="rpg.php">RPG</a>
     	 		</li>
    		</ul>
  		</div>
  		<form id="fixsearch" class="form-inline" action="func/gameSearch.php" method="POST">
    		<input class="form-control mr-sm-2" type="search" name="gameSearch" placeholder="Search Game" aria-label="Search">
    		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  		</form>
	</nav>
  <div id ="icon" style="font-size: 0.5rem;">
    <button class="chgbtn"><i class="far fa-plus-square"><a class="nav-link ad_del_a" href="addgame.php"></a></i></button>
    <button class="chgbtn"><i class="fas fa-trash-alt fa-5x"></i><a class="nav-link ad_del_a" href="delgame.php"></a></button>
    <button class="chgbtn"><i class="far fa-edit fa-5x"></i><a class="nav-link ad_del_a" href="mdfgame.php"></a></button>
  </div>
  
	<?php
    include_once "db_conn.php";
      echo "<table class='table table-striped table-dark'>
      <thead>
      <tr>
          <th scope='col's>#</th>
        <th scope='col'>Name</th>
        <th scope='col'>Type</th>
        <th scope='col'>Rating</th>
        <th scope='col'>Resource_num</th>
      </tr>
      </thead>";

   if(!isset($_SESSION['showGAMESearch']) or $_SESSION['showGAMESearch'] === False){
      $query = ('select * from game order by Type');
   }
   else if($_SESSION['showGAMESearch'] === True){
      $query = ('select * from game where Name like "%'.$_SESSION['gameSearch'].'%"');
      $_SESSION['showGAMESearch'] = False;
   }
  
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll();
  for($i=0; $i<count($result); $i++){
    echo"</tr>";
    echo"<th scope='row'>".$i."</th>";
    echo"<td>".$result[$i]['Name']."</td>";
    echo"<td>".$result[$i]['Type']."</td>";
    echo"<td>".$result[$i]['Rating']."</td>";
    echo"<td>".$result[$i]['Resource_num']."</td>";
    echo"</tr>";
  }
  echo"</table>";
  ?>
</body>
</html>