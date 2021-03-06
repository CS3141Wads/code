<!DOCTYPE html>
<html lang="en">
<?php
  //starts a session which passes data from other webpages to this one
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
<?php
//gets the user's information from the current session 
$name = $_SESSION["name"];
$username = $_SESSION["usernameToLoad"];
$teamName = $_SESSION["teamName"];

//connects to the database 
$config = parse_ini_file("db.ini");
$dbh = new PDO($config['dsn'], $config['username'], $config['password']);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//gets the two team names and scores from the database for the most recent game played 
$q = $dbh->query("select team1, team2 from game where team1='$teamName' or team2='$teamName' order by data desc limit 1"); 
$row = $q->fetch(); 
$team1 = $row[0]; 
$team2 = $row[1]; 
$q = $dbh->query("select currentScore from Team where name='$team1'"); 
$row = $q->fetch();
$team1score = $row[0]; 
$q = $dbh->query("select currentScore from Team where name='$team2'"); 
$row = $q->fetch();
$team2score = $row[0]; 
?>
<div class="pure-g">
	<!-- creates the lefthand column --> 
	<div class="pure-u-1-2">
		<div style="margin-left: 1em;">
			<?php
				//displays the first team's name and score 
				echo "<h2 name='t1'>".$team1."</h2>"; 
				echo "<h3 name='s1'>Score: ".$team1score."</h3>"; 
			?>
			<!-- creates a table to display each player's stats --> 
			<table class="pure-table pure-table-horizontal">
				<thead>
					<tr>
						<th>Player</th>
						<th>Goals</th>
						<th>Assists</th>
						<th>Penalty Min</th>
						<th>Score</th>
					</tr>
				</thead>
				<tbody> 
				<?php
					//gets the player's name, goals, assists, penalty minutes, and current score for their most recent game from the database 
					foreach ($dbh->query("select name, goals, assists, penaltyMinutes, currentScore from draftedPlayer where draftedTeam = '".$team1."'") as $row ) {
						echo "<tr>"; 
						echo "<td name='pn'>".$row[0]."</td>"; 
						echo "<td name='go'>".$row[1]."</td>";
						echo "<td name='as'>".$row[2]."</td>";
						echo "<td name='pm'>".$row[3]."</td>";
						echo "<td name='cs'>".$row[4]."</td>";
						echo "</tr>"; 					  
					}
				?>
				</tbody>
			</table></br>
			
			<!-- creates a table to display the goalie's stats --> 
			<table class="pure-table pure-table-horizontal">
				<thead>
					<tr>
						<th>Goalie</th>
						<th>Penalty Min</th>
						<th>Goalie Min</th>
						<th>Goals Against</th>
						<th>Saves</th>
						<th>Score</th>
					</tr>
				</thead>
				<tbody>
				<?php
					//gets the name, penalty minutes, goalie minutes, goalies against, saves, and current score for the goalie's most recent game from the database 
					foreach($dbh->query("select name, penaltyMinutes, goalieMinutes, goalsAgainst, saves, currentScore from draftedGoalie where draftedTeam = '".$team1."'") as $row ) {
						echo "<tr>"; 
						echo "<td name='gn'>".$row[0]."</td>"; 
						echo "<td name='pm'>".$row[1]."</td>";
						echo "<td name='gm'>".$row[2]."</td>";
						echo "<td name='ga'>".$row[3]."</td>";
						echo "<td name='sa'>".$row[4]."</td>";
						echo "<td name='cs'>".$row[5]."</td>";
						echo "</tr>"; 					  
					}
				?>
				</tbody>
			</table>
		</div>
	</div>
	
	<!-- creates the righthand column --> 
	<div class="pure-u-1-2">
		<?php
			//displays the second team's name and score 
			echo "<h2 name='t2'>".$team2."</h2>"; 
			echo "<h3 name='s2'>Score: ".$team2score."</h3>"; 
		?>
		<!-- creates a table to display each player's stats --> 
		<table class="pure-table pure-table-horizontal">
			<thead>
				<tr>
					<th>Player</th>
					<th>Goals</th>
					<th>Assists</th>
					<th>Penalty Min</th>
					<th>Score</th>
				</tr>
			</thead>
			<tbody>
				<?php
					//gets the player's name, goals, assists, penalty minutes, and current score for their most recent game from the database 
					foreach ($dbh->query("select name, goals, assists, penaltyMinutes, currentScore from draftedPlayer where draftedTeam = '".$team2."'") as $row ) {
						echo "<tr>"; 
						echo "<td name='pn2'>".$row[0]."</td>"; 
						echo "<td name='go2'>".$row[1]."</td>";
						echo "<td name='as2'>".$row[2]."</td>";
						echo "<td name='pm2'>".$row[3]."</td>";
						echo "<td name='cs2'>".$row[4]."</td>";
						echo "</tr>"; 					  
					}
				?>
			</tbody>
		</table></br>
		
		<!-- creates a table to display the goalie's stats -->
		<table class="pure-table pure-table-horizontal">
				<thead>
					<tr>
						<th>Goalie</th>
						<th>Penalty Min</th>
						<th>Goalie Min</th>
						<th>Goals Against</th>
						<th>Saves</th>
						<th>Score</th>
					</tr>
				</thead>
				<tbody>
				<?php
					//gets the name, penalty minutes, goalie minutes, goalies against, saves, and current score for the goalie's most recent game from the database 
					foreach($dbh->query("select name, penaltyMinutes, goalieMinutes, goalsAgainst, saves, currentScore from draftedGoalie where draftedTeam = '".$team2."'") as $row ) {
						echo "<tr>"; 
						echo "<td name='gn2'>".$row[0]."</td>"; 
						echo "<td name='pm2'>".$row[1]."</td>";
						echo "<td name='gm2'>".$row[2]."</td>";
						echo "<td name='ga2'>".$row[3]."</td>";
						echo "<td name='sa2'>".$row[4]."</td>";
						echo "<td name='cs2'>".$row[5]."</td>";
						echo "</tr>"; 					  
					}
				?>
				</tbody>
			</table>
	</div>
</div> 


</html>



									   





