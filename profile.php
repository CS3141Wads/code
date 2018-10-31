<!DOCTYPE html>
<?php
  session_start();
 ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a responsive product landing page.">
    <title>Profile</title>
    
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-old-ie-min.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
    <!--<![endif]-->
    
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    
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
			<li class="pure-menu-item"><a href="profile.php" class="pure-menu-link">Profile</a></li>
			<li class="pure-menu-item"><a href="draft.php" class="pure-menu-link">Draft</a></li>
			<li class="pure-menu-item"><a href="logout.php" class="pure-menu-link">Logout</a></li>
        </ul>
    </div>
</div>

      <?php
         $name = $_SESSION["name"];
         $username = $_SESSION["usernameToLoad"];
         $password = $_SESSION["passwordToLoad"];
         $teamName = $_SESSION["teamName"];

         $config = parse_ini_file("db.ini");
         $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
         $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

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

<div style=margin-left: 1em;>
	  
      <h1 name="teamName" align="center"><?php echo $teamName?></h3>

      <font name="owner" size="5"><u>Team Owner:</u> <?php echo $name?></font></br></br>

      <font size="5"><u>Current Record:</u></font></br>
        <font name="wins" size="5">&nbsp;&nbsp;&nbsp;<?php echo $wins?> wins</font></br>
        <font name="losses" size="5">&nbsp;&nbsp;&nbsp;<?php echo $losses?> losses</font></br>
        <font name="ties" size="5">&nbsp;&nbsp;&nbsp;<?php echo $ties?> ties</font></br></br>

      <font size="5"><u>Current Roster:</u></font></br>
        <?php
          $dbh->beginTransaction();
          foreach($dbh->query("SELECT * FROM draftedPlayer where name = '$player1' or name = '$player2' or name = '$player3' or name = '$player4' or name = '$player5'") as $row) {
            echo "Player: $row[0]<br>";
          }

          foreach($dbh->query("SELECT * FROM draftedGoalie where name = '$goalie'") as $row) {
            echo "Goalie: $row[0]<br>";
          }
         ?>

   </div>

   </body>

   <style>
    h1 {
      font-size: 4em;
    }
   </style>
</html>
