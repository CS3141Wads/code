<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  if( !isset($_SESSION["name"]) && !isset($_SESSION["usernameToLoad"]) && !isset($_SESSION["passwordToLoad"]) ){
			 header("Location: index.html"); 
  }
?>
<head>
    <script>
        function simulateGame() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "simulateGame.php");
            xmlhttp.send();
            alert("Players and goalies have been assigned points!");
        }

        function makeMatches() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "makeMatches.php");
            xmlhttp.send();
            alert("Games have been created and simulated!");
        }
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a responsive product landing page.">
    <title>Gameplay</title>
    
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-old-ie-min.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
    <!--<![endif]-->
    
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
    
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/layouts/marketing-old-ie.css">
        <![endif]-->
        <!--[if gt IE 8]><!-->
            <link rel="stylesheet" href="marketing.css">
        <!--<![endif]-->
</head>
<body>
<div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed"> 
        <a class="pure-menu-heading" href="profile.php">Fantasy Broomball</a>
		<ul class="pure-menu-list">
			<li class="pure-menu-item"><a name="logoutB" href="logout.php" class="pure-menu-link">Logout</a></li>
        </ul>
    </div> 
</div>
</br></br></br>
<div style="margin-left: 1em;">
	<button type="submit" name="simGame" class="pure-button pure-button-primary" onclick="simulateGame()">Simulate Game</button></br></br>
	<button type="submit" name="matchMaker" class="pure-button pure-button-primary" onclick="makeMatches()">Make Matches</button></br></br>
	<form class="pure-form pure-form-stacked" action="createDraftOrder.php" method="post">
		<button type="submit" name="startDraft" class="pure-button pure-button-primary">Start Draft</button></br></br>
	</form>
</div> 
</body>
</html>
