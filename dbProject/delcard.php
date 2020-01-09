
<html>
<head>
	<title>mdfdelgame.php</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
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
    .radiohide{
      display: none;
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
            <li class="nav-item">
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
  		<form id="fixsearch" class="form-inline" action="func/cardSearch.php" method="POST">
    		<input class="form-control mr-sm-2" type="search" name="cardSearch" placeholder="Search Card" aria-label="Search">
    		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  		</form>
	</nav>
  <form id="delcardForm" action="func/delCard.php" method="POST">
	<?php
    include_once "db_conn.php";
      echo "<table class='table table-striped table-dark'>
      <thead>
      <tr>
          <th scope='col's>#</th>
        <th scope='col'>Name</th>
        <th scope='col'>Website</th>
        <th scope='col'>URL</th>
        <th scope='col'>Resource</th>
      </tr>
      </thead>";
  ?>
  
  <?php
   if(!isset($_SESSION['showCardSearch']) or $_SESSION['showCardSearch'] === False){
      $query = ('select * from card');
  }
    else if($_SESSION['showCardSearch'] === True){
      $query = ('select * from card where Name like "%'.$_SESSION['cardSearch'].'%"');
      $_SESSION['showCardSearch'] = False;
  }
  
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll();
  for($i=0; $i<count($result); $i++){
    //echo"<th scope='row'>".$i."</th>";
    echo"<th scope='row'><input class=\"gameRadio\" type=\"radio\" name=\"mdfcard\" value=\"\" checked=\"\"><a class=\"radiohide\" style=\"margin-right:5px;\" href=\"#\"><span style=\"font-size: 4px;color:rgb(167,171,175);display:inline-block;\"><i class=\"far fa-trash-alt\"></i></span></a></th>";
    echo"<td>".$result[$i]['Name']."</td>";
    echo"<td>".$result[$i]['Website']."</td>";
    echo"<td>".$result[$i]['URL']."</td>";
    echo"<td>".$result[$i]['Resource']."</td>";
    echo"</tr>";
  }
  echo "</table>"
  ?>
  <input id="delwhichcard" type="hidden" name="delcard" value="">
  </form>


  <script type="text/javascript">
    var gameRadio = document.querySelectorAll(".gameRadio");
    var th = document.querySelectorAll("tbody th");
    var tr = document.querySelectorAll("tbody tr");
    var td = document.querySelectorAll("tbody td");
    var a = document.querySelectorAll("tbody a");
    var delcardform = document.querySelector("#delcardForm");
    var delcard = document.querySelector("#delwhichcard");
    lastclick = -1;
    
    for(i=0;i<tr.length;i++){
        (function(i){
          tr[i].addEventListener("click",function(){
            //alert(i);
              
              if(lastclick > -1 && lastclick!= i){
                  gameRadio[lastclick].classList.remove("radiohide");
                  a[lastclick].classList.add("radiohide");
                  gameRadio[lastclick].checked = false;
              }
              if(lastclick != i){
                 gameRadio[i].checked = true;
                 gameRadio[i].classList.add("radiohide");
                 a[i].classList.remove("radiohide");
                 lastclick = i;
              }
          });
        })(i);
    }
    
    for(j=0;j<a.length;j++){
        (function(j){
           a[j].addEventListener("click",function(){
              delcard.setAttribute("value",td[4*j].textContent+"|"+td[4*j+1].textContent);
              delcardform.submit();
           });
        })(j);
    }

  </script>
</body>
</html>