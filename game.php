<!DOCTYPE html>
<html lang="en">
<?php
  // starts a session which passes data from other webpages to this one
  session_start();
  //checks if the user is logged in and if not it redirects the user to the homepage 
  if( !isset($_SESSION["name"]) && !isset($_SESSION["usernameToLoad"]) && !isset($_SESSION["passwordToLoad"]) ){
			 header("Location: index.html"); 
  }
 ?>
<head>
	<!-- imports the CSS style into the webpage --> 
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

<!-- creates the top menu for the webpage which links to the profile, draft, game, and logout pages -->
<div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="profile.php">Fantasy Broomball</a>

        <ul class="pure-menu-list">
			<li class="pure-menu-item"><a name="profileB" href="profile.php" class="pure-menu-link">Profile</a></li>
			<li class="pure-menu-item"><a name="draftB" href="draft.php" class="pure-menu-link">Draft</a></li>
			<li class="pure-menu-item"><a name="gameB" href="game.php" class="pure-menu-link">Gameplay</a></li>
			<li class="pure-menu-item"><a name="logoutB" href="logout.php" class="pure-menu-link">Logout</a></li>
        </ul>
    </div>
</div>

</br></br>

<div class="pure-g">
	<div class="pure-u-1-4">
		<div style="margin-left: 1em;">
			<!-- creates a table of the rankings of the current users' teams -->
			<h2>Rankings</h2>
			<table class="pure-table pure-table-horizontal">
				<thead>
					<tr>
						<th>Team</th>
						<th>Score</th>
					</tr>
				</thead>
				<tbody>
					<?php
					//gets the user's information from the current session 
					$name = $_SESSION["name"];
					$username = $_SESSION["usernameToLoad"];
					$password = $_SESSION["passwordToLoad"];
					$teamName = $_SESSION["teamName"];
					
					//initializes the database connection 
					$config = parse_ini_file("db.ini");
					$dbh = new PDO($config['dsn'], $config['username'], $config['password']);
					$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				
					//gets the top team team names and scores from the database to display  
					foreach($dbh->query("select name, currentScore from Team order by currentScore desc limit 10") as $row) {
						echo "<tr>"; 
						echo "<td name='t1'>".$row[0]."</td>";  
						echo "<td name='s1'>".$row[1]."</td>";
						echo "</tr>"; 
					}
					?>
				</tbody>
			</table>
		</div>
	</div> 
	<div class="pure-u-3-5">
		<!-- creates a table that displays all the games the user's team has played in -->
		<h2>Game History</h2>
		<table class="pure-table pure-table-horizontal">
			<thead>
				<tr>
					<th>Date</th>
					<th>Team</th>
					<th>Score</th>
					<th>Team</th>
					<th>Score</th>
					<th>Winner</th>
				</tr>
			</thead>
			<tbody>
				<?php
					//gets the date, team names, team scores, and the winner from the database to be displayed 
					foreach($dbh->query("select data, team1, team1score, team2, team2score, winner from game where team1='$teamName' or team2='$teamName' order by data desc") as $row) {
						echo "<tr>";
						echo "<td name='date'>".$row[0]."</td>";
						echo "<td>".$row[1]."</td>";
						echo "<td>".$row[2]."</td>";
						echo "<td>".$row[3]."</td>";
						echo "<td>".$row[4]."</td>";
						echo "<td name='win'>".$row[5]."</td>"; 
						echo "</tr>"; 
					}
				?>
			</tbody>
		</table>
	</div>
	<div class="pure-u-3-20">
		</br>
		<div style="margin-left: 1em;">
			<!-- button that links to the webpage that displayed the team's most recent game results --> 
			<form action="gameResults.php" method="post">
				<button type="submit" name="playGame" value="play" class="pure-button pure-button-primary">See Results</button>
			</form>
		</div>
	<div> 
</div>

</html>
