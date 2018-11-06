<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
 ?>
<head>
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
        <a class="pure-menu-heading" href="">Fantasy Broomball</a>

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
	<div class="pure-u-1-2" style="margin-left: 1em;"> 
		<h2>Player Results</h2>
		<table class="pure-table pure-table-horizontal">
			<thead>
				<tr>
					<th>Player</th>
					<th>Goals</th>
					<th>Assists</th>
					<th>Points</th>
					<th>Penalty Min</th>
					<th>Score</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$name = $_SESSION["name"];
				$username = $_SESSION["usernameToLoad"];
				$teamName = $_SESSION["teamName"];

				$config = parse_ini_file("db.ini");
				$dbh = new PDO($config['dsn'], $config['username'], $config['password']);
				$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			
				foreach ($dbh->query("select d.name, d.goals, d.assists, d.points, d.penaltyMinutes, d.currentScore 
									  from draftedPlayer as d, User where d.draftedTeam = User.teamName and User.username = '".$username."'") as $row ) {
					echo "<tr>"; 
					echo "<td name='pn'>".$row[0]."</td>"; 
					echo "<td name='go'>".$row[1]."</td>";
					echo "<td name='as'>".$row[2]."</td>";
					echo "<td name='po'>".$row[3]."</td>";
					echo "<td name='pm'>".$row[4]."</td>";
					echo "<td name='cs'>".$row[5]."</td>";
					echo "</tr>"; 					  
				}
			?>
			</tbody>
		</table></br>

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
				foreach($dbh->query("select d.name, d.penaltyMinutes, d.goalieMinutes, d.goalsAgainst, d.saves, d.currentScore 
									 from draftedGoalie as d, User where d.draftedTeam = User.teamName and User.userName = '".$username."'") as $row ) {
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
	<div class="pure-u-1-2">
		<h2>Game Results</h2>
		<table class="pure-table pure-table-horizontal">
			<thead>
				<tr>
					<th>Team</th>
					<th>Score</th>
					<th>Team</th>
					<th>Score</th>
					<th>Winner</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($dbh->query("select team1, team1score, team2, team2score, winner from game where team1='$teamName' or team2='$teamName' order by data desc limit 1") as $row) {
						echo "<tr>";
						echo "<td>".$row[0]."</td>";
						echo "<td>".$row[1]."</td>";
						echo "<td>".$row[2]."</td>";
						echo "<td>".$row[3]."</td>";
						echo "<td name='win'>".$row[4]."</td>"; 
						echo "</tr>"; 
					}
				?>
			</tbody>
		</table>
	</div>
</div> 

</html>



									   





