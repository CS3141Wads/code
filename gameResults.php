<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  if( !isset($_SESSION["name"]) && !isset($_SESSION["usernameToLoad"]) && !isset($_SESSION["passwordToLoad"]) ){
			 header("Location: index.html"); 
  }
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
$name = $_SESSION["name"];
$username = $_SESSION["usernameToLoad"];
$teamName = $_SESSION["teamName"];

$config = parse_ini_file("db.ini");
$dbh = new PDO($config['dsn'], $config['username'], $config['password']);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$q = $dbh->query("select team1, team1score, team2, team2score from game where team1='$teamName' or team2='$teamName' order by data desc limit 1"); 
$row = $q->fetch(); 
$team1 = $row[0];
$team1score = $row[1]; 
$team2 = $row[2]; 
$team2score = $row[3]; 
?>
<div class="pure-g">
	<div class="pure-u-1-2">
		<div style="margin-left: 1em;">
			<?php
				echo "<h2 name='t1'>".$team1."</h2>"; 
				echo "<h3 name='s1'>Score: ".$team1score."</h3>"; 
			?>
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
	
	<div class="pure-u-1-2">
		<?php
			echo "<h2 name='t2'>".$team2."</h2>"; 
			echo "<h3 name='s2'>Score: ".$team2score."</h3>"; 
		?>
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



									   





