<!DOCTYPE html>
<?php
	//This will redirect the user to the home page if they are logged out from inactivity or try to access a page they do not have authorization to access through the URL line. 
   session_start();
   if( !isset($_SESSION["name"]) && !isset($_SESSION["usernameToLoad"]) && !isset($_SESSION["passwordToLoad"]) ){
      header("Location: index.html"); 
   }
?>
<html lang="en">
<head>
	<!-- This section provides the assets we used with our page's header, such as the different colors and fonts imported from outside the basic library. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a responsive product landing page.">
    <title>Profile</title>
	
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">                                                                                                             
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">                                        
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">                                                                                                              
    <link rel="stylesheet" href="marketing.css">                                                                                     
	
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="marketing.css">

</head>
<body style="margin-left: 1em;">
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
    <?php
		//gets the user information from the current session 
       $name = $_SESSION["name"];
       $username = $_SESSION["usernameToLoad"];
       $password = $_SESSION["passwordToLoad"];
       $teamName = $_SESSION["teamName"];
       
	   //connects to the databse 
       $config = parse_ini_file("db.ini");
       $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
       $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
		//places player and team information to be displayed into variables 
       $dbh->beginTransaction();
       foreach($dbh->query("SELECT * FROM Team WHERE user = '$username' AND name = '$teamName'") as $row) {
          $player1 = $row[2];
          $player2 = $row[3];
          $player3 = $row[4];
          $player4 = $row[5];
          $player5 = $row[6];
          $goalie  = $row[7];
          $wins    = $row[8];
          $losses  = $row[9];
          $ties    = $row[10];
       }
       $dbh->commit();
    ?>

    </br></br>
	<!-- displays the team name --> 
    <h1 name="teamName" align="center"><?php echo $teamName?></h3>
	<!-- displays the team owner's name --> 
    <h2 name="owner" align="center">Team Owner: <?php echo $name?></h2>

	<!-- displays the current statistics for the team --> 
    <h2>Current Record:</h2>

    <table class="pure-table pure-table-horizontal">
      <thead>
        <tr>
          <th>Wins</th>
          <th>Losses</th>
          <th>Ties</th>
        </tr>
      </thead>
    <tbody>
    <?php
       foreach($dbh->query("SELECT * FROM Team WHERE user = '$username' AND name = '$teamName'") as $row) {
          echo "<tr>";
			echo "<td name='wins'>".$row[8]."</td>";
			echo "<td name='losses'>".$row[9]."</td>";
			echo "<td name='ties'>".$row[10]."</td>";
          echo "</tr>";
       }
    ?>
    </tbody>
    </table>
       </br> 
          <h2>Current Roster:</h2>
	     <table class="pure-table pure-table-horizontal">
                <thead>
                  <tr>
                    <th>Player</th>
                    <th> </th>
                    <th> </th>
		    <th> </th>
                    <th> </th>
		    <th>Goalie</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
					 //lists the active roster, or a link to the draft page 
                     foreach($dbh->query("SELECT * FROM Team WHERE user = '$username' AND name = '$teamName'") as $row) {
                        echo "<tr>";

						if($row[2] === NULL){
                           echo '<td><a href="draft.php">[Draft Player]</a></td>';
                        } else {
							echo "<td name='p1'>".$row[2]."</td>";
                        }

						if($row[3] === NULL){
                           echo '<td><a href="draft.php">[Draft Player]</a></td>';
                        } else {
                           echo "<td name='p2'>".$row[3]."</td>";
                        }

						if($row[4] === NULL){
                           echo '<td><a href="draft.php">[Draft Player]</a></td>';
                        } else {
                           echo "<td name='p3'>".$row[4]."</td>";
                        }

						if($row[5] === NULL){
                           echo '<td><a href="draft.php">[Draft Player]</a></td>';
                        } else {
                           echo "<td name='p4'>".$row[5]."</td>";
                        }

						if($row[6] === NULL){
                           echo '<td><a href="draft.php">[Draft Player]</a></td>';
                        } else {
                           echo "<td name='p5'>".$row[6]."</td>";
                        }

						if($row[7] === NULL){
                           echo '<td><a href="draft.php">[Draft Goalie]</a></td>';
                        } else {
                           echo "<td name='p6'>".$row[7]."</td>";
                        }
						echo "</tr>";
                  }
                  ?>
                </tbody>
             </table>     
</body>

<style>
  h1 {
  font-size: 4em;
  }
</style>
</html>
