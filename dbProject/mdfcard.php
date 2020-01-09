
<?php
  session_start();
?>

<html>
<head>
	<title>mdfrpg.php</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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
      /*background-color: DodgerBlue;*/ 
      display:inline-block;
      float:left;
      background-color: #ffffff;
      border: none; /* Remove borders */
      color: gray; /* White text */
      padding: 12px 12px; /* Some padding */
      margin-right:5px;
      /*font-size: 16px;*/ /* Set a font size */
      cursor: pointer; /* Mouse pointer on hover */
      height:70px;
      width:70px;
    }
    .chgbtn:hover{
      background-color: rgba(211,211,211,0.2);
      /*background-color: #d3d3d3;
      opacity: 0.7;*/
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
      			<li class="nav-item active">
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
  <div id ="icon" style="font-size: 0.5rem;">
    <button class="chgbtn"><i class="far fa-plus-square"><a class="nav-link ad_del_a" href="addsrc.php"></a></i></button>
    <button class="chgbtn"><i class="fas fa-trash-alt fa-5x"></i><a class="nav-link ad_del_a" href="delrpg.php"></a></button>
    <button class="chgbtn"><i class="far fa-edit fa-5x"></i><a class="nav-link ad_del_a" href="mdfrpg.php"></a></button>
  </div>
    
  <form id="mdfcardForm" action="func/mdfCard.php" method="POST">
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
    if(!isset($_SESSION['showCardSearch']) or $_SESSION['showCardSearch'] === False){
      $query = ('select * from card');
  }
    else if($_SESSION['showCardSearch'] === True){
      $query = ('select * from card where Name like "%'.$_SESSION['cardSearch'].'%"');
      $_SESSION['showCardSearch'] = False;
  }
    if(isset($_SESSION['mdfcard']) and !empty($_SESSION['mdfcard'])){
        echo "<script>alert('".$_SESSION['mdfcard']."');</script>";
        $_SESSION['mdfcard']="";
    }

    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    for($i=0; $i<count($result); $i++){
      echo"</tr>";
      echo"<th scope='row'><input class=\"gameRadio\" type=\"radio\" name=\"mdfgamegroup\" value=\"".$result[$i]['Name']."\" checked=\"\"><a class=\"radiohide\" style=\"margin-right:5px;\" href=\"#\"><span style=\"font-size: 4px;color:rgb(167,171,175);display:inline-block;\"><i class=\"far fa-save\"></i></span></a></th>";
      echo"<td>".$result[$i]['Name']."</td>";
      echo"<td>".$result[$i]['Website']."</td>";
      echo"<td>".$result[$i]['URL']."</td>";
      echo"<td>".$result[$i]['Resource']."</td>";
      echo"</tr>";
    }
    echo"</table>";
  ?>
  <input id="mdfwhichrsc" type="hidden" name="mdfwhichrsc" value="">
  <input id="oldurl" type="hidden" name="oldurl" value="">
  <input id="oldrsc" type="hidden" name="oldrsc" value="">
 </form>
 <script type="text/javascript">
  	var gameRadio = document.querySelectorAll(".gameRadio");
    var tr = document.querySelectorAll("tbody tr");
    var td = document.querySelectorAll("tbody td");
	  var a = document.querySelectorAll("tbody a");
	  lastclick = -1;
    var oldname;
    var oldwebsite;
    var oldurl;
    var oldrsc;

    for(i=0;i<tr.length;i++){
        (function(i){
          tr[i].addEventListener("click",function(){
          	if(lastclick > -1 && lastclick!= i){  
                gameRadio[lastclick].classList.remove("radiohide");
                a[lastclick].classList.add("radiohide");
                index = lastclick*4;
                td[index].innerHTML = oldname;
                td[index+1].innerHTML = oldwebsite;
                td[index+2].innerHTML = oldurl;
                td[index+3].innerHTML = oldrsc;

            }
            if(lastclick != i){
                gameRadio[i].checked = true;
                gameRadio[i].classList.add("radiohide");
                a[i].classList.remove("radiohide");
                index = i*4;
                oldname = td[index].textContent;
                td[index].innerHTML = "<input id=\"mdfname\" type=\"text\" name=\"mdfname\" value=\"" +td[index].textContent+ "\">";

                oldwebsite = td[index+1].textContent;
                td[index+1].innerHTML = "<input id=\"mdfwebsite\" type=\"text\" name=\"mdfwebsite\" value=\"" +td[index+1].textContent+ "\">";

                oldurl = td[index+2].textContent;
                td[index+2].innerHTML = "<input id=\"mdfurl\" type=\"text\" name=\"mdfurl\" value=\"" +td[index+2].textContent+ "\">";

                oldrsc = td[index+3].textContent;
                td[index+3].innerHTML = "<input id=\"mdfrsc\" type=\"text\" name=\"mdfrsc\" value=\"" +td[index+3].textContent+ "\">";
                lastclick = i;
            }
          });
        })(i);
    }

        for(k=0;k<a.length;k++){
        	(function(k){
           		a[k].addEventListener("click",function(){
              		//alert(oldname);
              		var tmp;
              		document.querySelector("#mdfwhichrsc").setAttribute("value",oldname+"|"+oldwebsite);
              		document.querySelector("#oldurl").setAttribute("value",oldurl);        		
              		document.querySelector("#oldrsc").setAttribute("value",oldrsc);
              		document.querySelector("#mdfcardForm").submit();
           		});
        	})(k);
       }
    
 </script>
</body>
</html>
</html>