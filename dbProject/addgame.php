<?php
  session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>addgame.php</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	
  <style type="text/css">
  
 
  input{
    background-color: #212121;
    font-size:18px;
    color: #FFFFFF;
    outline: none; /*after click no border*/
    padding:10px 10px 10px 5px;
    display:block;
    /*width:300px;*/
    width:350px;
    border:none;
    border-bottom:1.5px solid #383838;
  }
  input:focus{
    border-bottom:1.7px solid #4286f4;
  }
  .inputattr{
    font-size:18px;
    display: inline-block;
    color: #FFFFFF;
    opacity: 0.7;
    /*margin-right: 30px; */
    margin-right: 200px;
  }
  .wrapper{
    background-color: #212121;
    height: auto;
    min-height: 100%;
    margin: 0px auto;
    /*overflow: hidden;*/
    /*width : 100%;*/
  }
  .drop{
    color: #FFFFFF;
    opacity: 0.5;
    background: rgba(0,0,0,0);
    border:none;
    box-shadow: none;
    border-bottom:1.9px solid rgb(78,78,78);
  }
  #typedrop:focus{
    opacity: 1;
    box-shadow: none;
    background-color: rgba(0,0,0,0);
    border-bottom:2px solid #4286f4;
  }
  #ratingdrop:focus{
    opacity: 1;
    box-shadow: none;
    background-color: rgba(0,0,0,0);
    border-bottom:2px solid #4286f4;
  }

  span{
    display: inline-block;
    min-width: 88px;
  }

  #addGamebtn{
    color:#FFFFFF;
    opacity: 0.7;
    background-color: rgba(0,0,0,0);
    border-width:1.5px;
    border-radius: 12px;
    border-color: rgba(255,255,255,0.7);
    margin-top: 60px;
    margin-left: 30%;
  }
  #addGamebtn:hover{
    background-color: #85979b;
  }

  body, html {
    height:  100%;
    margin:  0px auto;
    padding: 0px auto;
  }
  .container{
    padding-top: 115px;
    padding-left: 17%;
  }
  </style>
</head>
<body>
<!--   navbar   -->
<nav id="fixheight" class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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
  </nav>
<!-- content -->
<div class = "wrapper">
  <div class="container">
    <!--Name textbox-->
    <form action="func/addGame.php" method="POST">
      <div class="inputattr" style="display:inline-block;">Name</div>
      
      <div style="display:inline-block;">
          <input type="text" name="gameName" placeholder="Game Name" >
      </div>
      
     
    <!--type dropdown-->
    <div id="mydrop" class="dropdown" style="font-size:20px;margin-top:48px;">
      <div class="inputattr" style="margin-right: 210px;">Type</div>
      <button id="typedrop" type="button" class="btn btn-secondary dropdown-toggle drop" id="dropdownMenuButton" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">Choose one from RPG,FPS,Card<span></span>
      </button>
      <input type="hidden" name="gameType" value="">
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">RPG</a>
        <a class="dropdown-item" href="#">FPS</a>
        <a class="dropdown-item" href="#">CARD</a>
      </div>
    </div>

    <!--rating dropdown-->
    <div id="ratingdp" class="dropdown" style="margin-top:52px;">
      <div class="inputattr" style="margin-right: 196px;">Rating</div>
      <button id="ratingdrop" class="btn btn-secondary dropdown-toggle drop" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        From 0 ~ 5<span style="display:inline-block;min-width:233px;"></span>  
      </button>
      <input type="hidden" name="gameRating" value="">
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#">0</a>
        <a class="dropdown-item" href="#">1</a>
        <a class="dropdown-item" href="#">2</a>
        <a class="dropdown-item" href="#">3</a>
        <a class="dropdown-item" href="#">4</a>
        <a class="dropdown-item" href="#">5</a>
      </div>
    </div>
    <button id="addGamebtn" type="submit" name="submit" class="btn btn-light">Submit</button>
    </form> 
  </div><!-- container -->
  <?php
     if(isset($_SESSION['addgame']) and !empty($_SESSION['addgame'])){
        echo "<script>alert('".$_SESSION['addgame']."');</script>";
        $_SESSION['addgame']="";
     }
  ?>
  <script type="text/javascript">
    var typeDropmenu = document.querySelector("#typedrop");
    var dropitem = document.querySelectorAll("#mydrop .dropdown-item");
    var gametype = document.querySelector("#mydrop input");

    var ratingdropbtn = document.querySelector("#ratingdrop");
    var ratingDropitem = document.querySelectorAll("#ratingdp .dropdown-item");
    var gamerating = document.querySelector("#ratingdp input");

    for(i=0;i<dropitem.length;i++){
      (function(i){
        dropitem[i].addEventListener("click",function(){
          gametype.setAttribute("value",this.textContent);
          typeDropmenu.innerHTML = this.textContent + "<span style=\"width:285px;\"></span>";
        });
      })(i);
    }
    for(i=0;i<ratingDropitem.length;i++){
      (function(i){
        ratingDropitem[i].addEventListener("click",function(){
          gamerating.setAttribute("value",this.textContent);
          ratingdropbtn.innerHTML = this.textContent + "<span style=\"width:306px;\"></span>";
        });
      })(i);
    }
  </script>

</div>
</body>
</html>