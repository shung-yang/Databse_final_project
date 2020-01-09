<?php
  session_start();
?>
<html>
<head>
	<title>mdfgame.php</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   <script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
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
  		<form id="fixsearch" class="form-inline" action="func/gameSearch.php" method="POST">
    		<input class="form-control mr-sm-2" type="search" name="gameSearch" placeholder="Search Game" aria-label="Search">
    		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  		</form>
	</nav>
  <form id="mdfgameForm" action="func/mdfGame.php" method="POST">
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
  ?>
  
  <?php
   if(!isset($_SESSION['showGAMESearch']) or $_SESSION['showGAMESearch'] === False){
      $query = ('select * from game order by Type');
   }
   else if($_SESSION['showGAMESearch'] === True){
      $query = ('select * from game where Name like "%'.$_SESSION['gameSearch'].'%"');
      $_SESSION['showGAMESearch'] = False;
   }
   if(isset($_SESSION['mdfgame']) and !empty($_SESSION['mdfgame'])){
        echo "<script>alert('".$_SESSION['mdfgame']."');</script>";
        $_SESSION['mdfgame']="";
   }
  
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll();
  for($i=0; $i<count($result); $i++){
    //echo"<th scope='row'>".$i."</th>";
    echo"<th scope='row'><input class=\"gameRadio\" type=\"radio\" name=\"mdfgamegroup\" value=\"".$result[$i]['Name']."\" checked=\"\"><a class=\"radiohide\" style=\"margin-right:5px;\" href=\"#\"><span style=\"font-size: 4px;color:rgb(167,171,175);display:inline-block;\"><i class=\"far fa-save\"></i></span></a></th>";
    echo"<td>".$result[$i]['Name']."</td>";
    echo"<td>".$result[$i]['Type']."</td>";
    echo"<td>".$result[$i]['Rating']."</td>";
    echo"<td>".$result[$i]['Resource_num']."</td>";
    echo"</tr>";
  }
  echo "</table>";
  ?>
  <input id="mdfwhichgame" type="hidden" name="mdfwhichgame" value="">
  <input id="mdftype" type="hidden" name="mdftype" value="">
  <input id="mdfrating" type="hidden" name="mdfrating" value="">
  </form>
 
   
  <script type="text/javascript">
    var th = document.querySelectorAll("tbody th");
    var gameRadio = document.querySelectorAll(".gameRadio");
    var tr = document.querySelectorAll("tbody tr");
    var td = document.querySelectorAll("tbody td");
    var a = document.querySelectorAll("tbody a"); ///dropdwon has a too
    var mdfwhichgame = document.querySelector("#mdfwhichgame");
    var mdfgame = document.querySelector("#mdfgame");
    lastclick = -1;
    var oldname;
    var oldtype;
    var oldrating;

    var typeDropitem;
    var typedropbtn;
    for(i=0;i<tr.length;i++){
        (function(i){
          tr[i].addEventListener("click",function(){
            //alert(i);
            //upadte
              //回復上一個未更改的項目
              if(lastclick > -1 && lastclick!= i){  
                gameRadio[lastclick].classList.remove("radiohide");
                a[lastclick].classList.add("radiohide");
                index = lastclick*4;
                td[index].innerHTML = oldname;
                td[index+1].innerHTML = oldtype;
                td[index+2].innerHTML = oldrating;
              }
              if(lastclick != i){
                gameRadio[i].checked = true;
                gameRadio[i].classList.add("radiohide");
                a[i].classList.remove("radiohide");
                index = i*4;
                oldname = td[index].textContent;
                oldtype = td[index+1].textContent;
                oldrating = td[index+2].textContent;
                td[index].innerHTML = "<input id=\"mdfgame\" type=\"text\" name=\"mdfgame\"" + index + "\" value=\"" +td[index].textContent+ "\">";
                //type dropdown list
                td[index+1].innerHTML = "<div id=\"typedrop\" class=\"dropdown\"><button id=\"typedropbtn\"class=\"btn btn-secondary dropdown-toggle btn-light\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">"+oldtype+"</button><div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\"><a class=\"dropdown-item\" href=\"#\">RPG</a><a class=\"dropdown-item\" href=\"#\">FPS</a><a class=\"dropdown-item\" href=\"#\">CARD</a></div></div>";
                typeDropitem = document.querySelectorAll("#typedrop .dropdown-item");        
                typedropbtn = document.querySelector("#typedropbtn");
                document.querySelector("#mdftype").setAttribute("value","");
                for(m=0;m<3;m++){
                  (function(m){
                    typeDropitem[m].addEventListener("click",function(){
                      document.querySelector("#mdftype").setAttribute("value",oldtype+"|"+this.textContent);
                      typedropbtn.textContent = this.textContent;
                    });
                  })(m);
                 }
                //rating dropdown list
                td[index+2].innerHTML = "<div id=\"ratingdrop\" class=\"dropdown\"><button id=\"ratingdropbtn\"class=\"btn btn-secondary dropdown-toggle btn-light\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">"+oldrating+"</button><div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\"><a class=\"dropdown-item\" href=\"#\">0</a><a class=\"dropdown-item\" href=\"#\">1</a><a class=\"dropdown-item\" href=\"#\">2</a><a class=\"dropdown-item\" href=\"#\">3</a><a class=\"dropdown-item\" href=\"#\">4</a><a class=\"dropdown-item\" href=\"#\">5</a></div></div>";
                ratingDropitem = document.querySelectorAll("#ratingdrop .dropdown-item");        
                ratingdropbtn = document.querySelector("#ratingdropbtn");
                document.querySelector("#mdfrating").setAttribute("value","");
                for(p=0;p<6;p++){
                  (function(p){
                    ratingDropitem[p].addEventListener("click",function(){
                      document.querySelector("#mdfrating").setAttribute("value",oldrating+"|"+this.textContent);
                      ratingdropbtn.textContent = this.textContent;
                    });
                  })(p);
                 }
              }
              lastclick = i;
          });
        })(i);
    }

    for(k=0;k<a.length;k++){
        (function(k){
           a[k].addEventListener("click",function(){
              //alert(oldname);
              mdfwhichgame.setAttribute("value",oldname);//+"|"+td[4*k+1].textContent);
              document.querySelector("#mdfgameForm").submit();
           });
        })(k);
    }
   
  </script>
</body>
</html>