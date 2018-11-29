<!DOCTYPE html>
<html lang="en">
<?php
  // starts a session which grabs data passed from other webpages
  session_start();
  // checks if a user is logged in and redirects them to the home page if they aren't 
  if( !isset($_SESSION["name"]) && !isset($_SESSION["usernameToLoad"]) && !isset($_SESSION["passwordToLoad"]) ){
			 header("Location: index.html"); 
  }
?>
<head>
    <script>
	    <!-- calls the simulate game procedure in the database when the simulate game button is pressed --> 
        function simulateGame() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "simulateGame.php");
            xmlhttp.send();
            alert("Players and goalies have been assigned points!");
        }
        <!-- calls the match maker procedure in the database when the make matches button is pressed --> 
        function makeMatches() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "makeMatches.php");
            xmlhttp.send();
            alert("Games have been created and simulated!");
        }
    </script>

	<!-- imports the CSS style --> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a responsive product landing page.">
    <title>Gameplay</title>
    
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
    <link rel="stylesheet" href="marketing.css">
</head>
<body>
<div class="header">
	<!-- creates the top menu for the webpage which links to the profile page and the logout page --> 
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed"> 
        <a class="pure-menu-heading" href="profile.php">Fantasy Broomball</a>
		<ul class="pure-menu-list">
			<li class="pure-menu-item"><a name="logoutB" href="logout.php" class="pure-menu-link">Logout</a></li>
        </ul>
    </div> 
</div>
</br></br></br>
<div style="margin-left: 1em;">
	<!-- button to call the simulate game procedure --> 
	<button type="submit" name="simGame" class="pure-button pure-button-primary" onclick="simulateGame()">Simulate Game</button></br></br>
	<!-- button to call the match maker procedure --> 
	<button type="submit" name="matchMaker" class="pure-button pure-button-primary" onclick="makeMatches()">Make Matches</button></br></br>
	<!-- button to start the draft --> 
	<form class="pure-form pure-form-stacked" action="createDraftOrder.php" method="post">
		<button type="submit" name="startDraft" class="pure-button pure-button-primary">Start Draft</button></br></br>
	</form>
</div> 
</body>
</html>
